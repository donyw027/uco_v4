<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_model extends CI_Model
{
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
