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