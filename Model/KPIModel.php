<?php
namespace Kanboard\Plugin\KPI\Model;

use Kanboard\Core\Base;

class KPIModel extends Base
{
    const TABLE = 'kpi_definition';

    public function getAll($project_id)
    {
        return $this->db->table(self::TABLE)
            ->eq('project_id', $project_id)
            ->asc('title')
            ->findAll();
    }

    public function getByTaskId($taskId)
    {
        return $this->db
            ->table(self::TABLE)
            ->eq('task_id', $taskId)
            ->findOne();
    }

    public function update($taskId, $kpiId, $points)
    {
        return $this->db
            ->table(self::TABLE)
            ->eq('id', (int) $kpiId)
            ->update([
                'task_id' => (int) $taskId,
                'task_point' => (float) $points,
            ]);
    }

    public function deleteByTaskId($taskId)
    {
        return $this->db
            ->table('kpi_task')
            ->eq('task_id', (int) $taskId)
            ->remove();
    }
}
