<?php

namespace Kanboard\Plugin\KPI\Service;

use Kanboard\Core\Base;

class MetricsCollector extends Base
{
    public function completedTasks($userId)
    {
        return $this->db
            ->table('tasks')
            ->eq('owner_id', $userId)
            ->eq('is_active', 0)
            ->count();
    }

    public function overdueTasks($userId)
    {
        return $this->db
            ->table('tasks')
            ->eq('owner_id', $userId)
            ->eq('is_active', 1)
            ->lt('date_due', time())
            ->count();
    }

    public function openTasks($userId)
    {
        return $this->db
            ->table('tasks')
            ->eq('owner_id', $userId)
            ->eq('is_active', 1)
            ->count();
    }
}