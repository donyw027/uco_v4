<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inquiry_message_model extends CI_Model
{
    protected $table = 'inquiry_messages';

    public function create($data)
    {
        $payload = [
            'full_name'  => trim((string)($data['full_name'] ?? '')),
            'email'      => trim((string)($data['email'] ?? '')),
            'phone'      => trim((string)($data['phone'] ?? '')),
            'subject'    => trim((string)($data['subject'] ?? '')),
            'message'    => trim((string)($data['message'] ?? '')),
            'status'     => 'new',
            'ip_address' => $this->input->ip_address(),
            'user_agent' => substr((string)$this->input->user_agent(), 0, 255),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->insert($this->table, $payload);
        return (int)$this->db->insert_id();
    }

    public function rows($status = null, $keyword = null)
    {
        if ($status !== null && $status !== '') {
            $this->db->where('status', $status);
        }

        if ($keyword !== null && trim($keyword) !== '') {
            $keyword = trim($keyword);
            $this->db->group_start();
            $this->db->like('full_name', $keyword);
            $this->db->or_like('email', $keyword);
            $this->db->or_like('phone', $keyword);
            $this->db->or_like('subject', $keyword);
            $this->db->or_like('message', $keyword);
            $this->db->group_end();
        }

        $this->db->order_by('created_at', 'DESC');
        return $this->db->get($this->table)->result_array();
    }

    public function get($id)
    {
        return $this->db->get_where($this->table, ['id' => (int)$id])->row_array();
    }

    public function update_status($id, $status)
    {
        $allowed = ['new', 'read', 'replied', 'archived'];
        if (!in_array($status, $allowed, true)) {
            $status = 'read';
        }

        return $this->db->where('id', (int)$id)->update($this->table, [
            'status' => $status,
        ]);
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, ['id' => (int)$id]);
    }

    public function unread_count()
    {
        return (int)$this->db->where('status', 'new')->count_all_results($this->table);
    }
}
