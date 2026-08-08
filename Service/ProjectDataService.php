<?php
namespace Kanboard\Plugin\KPI\Service;

use Kanboard\Core\Base;

class ProjectDataService extends Base
{
    public function getProjectIdByTaskId($taskId)
    {
        $task = $this->db
            ->table('tasks')
            ->columns('project_id')
            ->eq('id', $taskId)
            ->findOne();

        return $task['project_id'];
    }
}
