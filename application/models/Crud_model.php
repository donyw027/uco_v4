<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud_model extends CI_Model
{
    public function all($table, $orderBy = 'id DESC')
    {
        $this->db->order_by($orderBy);
        return $this->db->get($table)->result_array();
    }

    public function get($table, $id)
    {
        return $this->db->get_where($table, ['id' => (int)$id])->row_array();
    }

    public function insert($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    public function update($table, $id, $data)
    {
        return $this->db->where('id', (int)$id)->update($table, $data);
    }

    public function delete($table, $id)
    {
        return $this->db->delete($table, ['id' => (int)$id]);
    }
}
