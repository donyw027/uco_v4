<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manual_invoice_model extends CI_Model
{
    public function rows()
    {
        return $this->db
            ->order_by('id', 'DESC')
            ->get('manual_invoices')
            ->result_array();
    }

    public function get($id)
    {
        return $this->db->get_where('manual_invoices', ['id' => $id])->row_array();
    }

    public function items($manual_invoice_id)
    {
        return $this->db
            ->order_by('id', 'ASC')
            ->get_where('manual_invoice_items', ['manual_invoice_id' => $manual_invoice_id])
            ->result_array();
    }

    public function create($header, $items)
    {
        $this->db->trans_begin();

        $this->db->insert('manual_invoices', $header);
        $invoice_id = $this->db->insert_id();

        $total = 0;
        foreach ($items as $it) {
            if (trim($it['description']) === '' || (float)$it['qty'] <= 0) {
                continue;
            }

            $it['manual_invoice_id'] = $invoice_id;
            $it['amount'] = (float)$it['qty'] * (float)$it['unit_price'];
            $total += $it['amount'];

            $this->db->insert('manual_invoice_items', $it);
        }

        $this->db->where('id', $invoice_id)->update('manual_invoices', [
            'total_amount' => $total
        ]);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        }

        $this->db->trans_commit();
        return $invoice_id;
    }
}
