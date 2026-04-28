<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manual_inquiry_model extends CI_Model
{
    public function rows()
    {
        return $this->db->order_by('id', 'DESC')->get('manual_inquiries')->result_array();
    }

    public function get($id)
    {
        return $this->db->get_where('manual_inquiries', ['id' => $id])->row_array();
    }

    public function items($manual_inquiry_id)
    {
        return $this->db->order_by('id', 'ASC')
            ->get_where('manual_inquiry_items', ['manual_inquiry_id' => $manual_inquiry_id])
            ->result_array();
    }

    public function create($header, $items)
    {
        $this->db->trans_begin();

        $this->db->insert('manual_inquiries', $header);
        $id = $this->db->insert_id();

        foreach ($items as $it) {
            if (trim($it['description']) === '') {
                continue;
            }
            $it['manual_inquiry_id'] = $id;
            $this->db->insert('manual_inquiry_items', $it);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        }

        $this->db->trans_commit();
        return $id;
    }

    public function update($id, $header, $items)
    {
        $id = (int)$id;
        $this->db->trans_begin();
        $this->db->where('id', $id)->update('manual_inquiries', $header);
        $this->db->delete('manual_inquiry_items', ['manual_inquiry_id' => $id]);
        foreach ((array)$items as $it) {
            if (trim((string)$it['description']) === '') continue;
            $it['manual_inquiry_id'] = $id;
            $this->db->insert('manual_inquiry_items', $it);
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        }
        $this->db->trans_commit();
        return $id;
    }

}
