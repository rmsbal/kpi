<?php

namespace Kanboard\Plugin\KPI\Model;

use Kanboard\Core\Base;

class KPIModel extends Base
{
    const TABLE = 'kpi_definition';

    public function getAll()
    {
        return $this->db->table(self::TABLE)
            ->asc('name')
            ->findAll();
    }

    public function get($id)
    {
        return $this->db->table(self::TABLE)
            ->eq('id', $id)
            ->findOne();
    }

    public function create(array $values)
    {
        $values['created_at'] = time();
        $values['updated_at'] = time();

        return $this->db->table(self::TABLE)->insert($values);
    }

    public function update($id, array $values)
    {
        $values['updated_at'] = time();

        return $this->db->table(self::TABLE)
            ->eq('id', $id)
            ->update($values);
    }

    public function remove($id)
    {
        return $this->db->table(self::TABLE)
            ->eq('id', $id)
            ->remove();
    }
}