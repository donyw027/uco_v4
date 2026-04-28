<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fee_slip_model extends CI_Model
{
    protected $table = 'fee_slips';

    public function rows()
    {
        return $this->db->order_by('id', 'DESC')->get($this->table)->result_array();
    }

    public function get($id)
    {
        return $this->db->get_where($this->table, ['id' => (int)$id])->row_array();
    }

    public function next_slip_no()
    {
        $prefix = 'SLIP-UCO/' . date('Ym') . '/';

        // Project ini memakai CI_DB minimal, jadi jangan pakai $this->db->like().
        $row = $this->db->query(
            "SELECT slip_no FROM {$this->table} WHERE slip_no LIKE ? ORDER BY slip_no DESC LIMIT 1",
            [$prefix . '%']
        )->row_array();

        $next = 1;
        if ($row && !empty($row['slip_no'])) {
            $last = (int)substr($row['slip_no'], -3);
            $next = $last + 1;
        }
        return $prefix . str_pad((string)$next, 3, '0', STR_PAD_LEFT);
    }

    public function calculate_take_home($data)
    {
        $gross = (float)($data['gross_fee'] ?? 0);
        $capital = (float)($data['capital_contribution'] ?? 0);
        $deduction = (float)($data['deduction_amount'] ?? 0);
        $tax = (float)($data['tax_amount'] ?? 0);
        return $gross - $capital - $deduction - $tax;
    }

    public function save($data, $id = null)
    {
        $data['take_home_pay'] = $this->calculate_take_home($data);

        if ($id) {
            $this->db->where('id', (int)$id)->update($this->table, $data);
            return (int)$id;
        }
        $this->db->insert($this->table, $data);
        return (int)$this->db->insert_id();
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, ['id' => (int)$id]);
    }
}
