<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company_model extends CI_Model
{
    public function signers()
    {
        $sql = "
        SELECT 
            id,
            nama,
            position,
            role,
            is_active
        FROM users
        WHERE is_active = 1
        ORDER BY nama ASC
    ";

        return $this->db->query($sql)->result_array();
    }

    public function signer($id)
    {
        if (!$id) return null;

        $sql = "
        SELECT 
            id,
            nama,
            position,
            role
        FROM users
        WHERE id = ?
          AND is_active = 1
        LIMIT 1
    ";

        return $this->db->query($sql, [(int)$id])->row_array();
    }

    public function latest()
    {
        return $this->db->order_by('id', 'DESC')->get('company_profile', 1)->row_array();
    }

    public function save($data)
    {
        $row = $this->latest();
        if ($row) {
            return $this->db->where('id', $row['id'])->update('company_profile', $data);
        }
        return $this->db->insert('company_profile', $data);
    }
}
