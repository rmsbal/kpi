<?php
namespace Kanboard\Plugin\KPI\Service;

use Kanboard\Core\Base;

class DashboardService extends Base
{
    public function getProjectStats($projectId)
    {
        $completed = $this->db->table('tasks')
            ->eq('project_id', $projectId)
            ->eq('is_active', 0)
            ->count();

        $open = $this->db->table('tasks')
            ->eq('project_id', $projectId)
            ->eq('is_active', 1)
            ->count();

        $overdue = $this->db->table('tasks')
            ->eq('project_id', $projectId)
            ->eq('is_active', 1)
            ->lt('date_due', time())
            ->count();

        $total = $completed + $open;

        $progress = $total > 0
            ? round(($completed / $total) * 100, 1)
            : 0;

        return [
            'completed' => $completed,
            'open'      => $open,
            'overdue'   => $overdue,
            'total'     => $total,
            'progress'  => $progress,
        ];
    }

    public function getProjectTable(int $projectId, ?string $status = null): array
    {
        $sql = "
        SELECT
            t.*,
            u.username AS assignee_name,
            c.title AS column_name,
            co.comment_count
        FROM tasks t
        LEFT JOIN users u
            ON u.id = t.owner_id
        LEFT JOIN columns c
            ON c.id = t.column_id
       LEFT JOIN (
            SELECT task_id, COUNT(*) AS comment_count
            FROM comments
            GROUP BY task_id
        ) co ON co.task_id = t.id
        WHERE t.project_id = ?
        ";

        $params = [$projectId];

        switch ($status) {

            case 'completed':
                $sql .= " AND t.is_active = 0";
                break;

            case 'open':
                $sql .= " AND t.is_active = 1";
                break;

            case 'overdue':
                $sql .= "
                AND t.is_active = 1
                AND t.date_due > 0
                AND t.date_due < ?
            ";
                $params[]  = time();
                break;

            default:
                return [];
        }

        $sql .= " ORDER BY t.date_creation DESC";

        return $this->db->execute($sql, $params)->fetchAll();
    }

    public function getTaskStatusChart($projectId)
    {
        $stats = $this->getProjectStats($projectId);

        return [
            $stats['completed'],
            $stats['open'],
            $stats['overdue'],
        ];
    }

    public function getKpiStats($projectId)
    {
        // Get KPI status counts
        $counts = $this->db
            ->table('kpi_definition')
            ->columns('status', 'COUNT(*) AS total')
            ->eq('project_id', $projectId)
            ->groupBy('status')
            ->findAll();

        $kpiStats = [
            'done'    => 0,
            'ongoing' => 0,
            'pending' => 0,
            'kpiProg' => 0,
        ];

        $total_kpi = 0;

        foreach ($counts as $row) {

            $count      = (int) $row['total'];
            $total_kpi += $count;

            switch (strtoupper($row['status'])) {

                case 'DONE':
                    $kpiStats['done'] = $count;
                    break;

                case 'ONGOING':
                    $kpiStats['ongoing'] = $count;
                    break;

                case 'PENDING':
                    $kpiStats['pending'] = $count;
                    break;
            }
        }

        // Calculate overall progress
        if ($total_kpi > 0) {
            $kpiStats['kpiProg'] = round(($kpiStats['done'] / $total_kpi) * 100, 2);
        }

        return $kpiStats;
    }

    public function getTaskTrend($projectId)
    {
        $tasks = $this->db
            ->table('tasks')
            ->columns(
                'date_creation',
                'date_completed'
            )
            ->eq('project_id', $projectId)
            ->orderBy('date_creation')
            ->findAll();

        $months = [];

        foreach ($tasks as $task) {

            // Group by the month the task was created
            $month = date('Y-m', $task['date_creation']);

            if (! isset($months[$month])) {
                $months[$month] = [
                    'total'     => 0,
                    'completed' => 0,
                ];
            }

            // Total tasks created this month
            $months[$month]['total']++;

            // Task is completed
            if (
                ! empty($task['date_completed']) &&
                $task['date_completed'] > 0
            ) {
                $months[$month]['completed']++;
            }
        }

        $result = [
            'labels'     => [],
            'total'      => [],
            'completed'  => [],
            'percentage' => [],
        ];

        foreach ($months as $month => $values) {

            $total     = $values['total'];
            $completed = $values['completed'];

            $percentage = $total > 0
                ? round(($completed / $total) * 100, 2)
                : 0;

            $result['labels'][] = date(
                'M Y',
                strtotime($month . '-01')
            );

            $result['total'][]      = $total;
            $result['completed'][]  = $completed;
            $result['percentage'][] = $percentage;
        }

        return $result;
    }
}
