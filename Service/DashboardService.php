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
}
