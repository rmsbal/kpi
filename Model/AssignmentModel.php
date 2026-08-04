<?php

namespace Kanboard\Plugin\KPI\Model;

use Kanboard\Core\Base;

class AssignmentModel extends Base
{
    const TABLE = 'kpi_assignment';

    public function getAll()
    {
        return $this->db->table(self::TABLE)
            ->findAll();
    }

    public function getByUser($userId)
    {
        return $this->db
            ->table(self::TABLE)
            ->eq('user_id', $userId)
            ->findAll();
    }

    public function create(array $values)
    {
        $values['created_at'] = time();
        $values['updated_at'] = time();

        return $this->db
            ->table(self::TABLE)
            ->insert($values);
    }

    public function remove($id)
    {
        return $this->db
            ->table(self::TABLE)
            ->eq('id', $id)
            ->remove();
    }
}