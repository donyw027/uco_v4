<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_model extends CI_Model
{
    public function rows()
    {
        return $this->db->query("SELECT inv.*, so.so_no, c.company_name FROM invoices inv LEFT JOIN sales_orders so ON so.id=inv.sales_order_id LEFT JOIN customers c ON c.id=so.customer_id ORDER BY inv.id DESC")->result_array();
    }

    public function get($id)
    {
        return $this->db->get_where('invoices', ['id' => $id])->row_array();
    }

    public function update_row($id, $data)
    {
        return $this->db->where('id', $id)->update('invoices', $data);
    }
}
