<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Packing_list_model extends CI_Model
{
    public function rows()
    {
        return $this->db->query("SELECT pl.*, so.so_no, c.company_name FROM packing_lists pl LEFT JOIN sales_orders so ON so.id=pl.sales_order_id LEFT JOIN customers c ON c.id=so.customer_id ORDER BY pl.id DESC")->result_array();
    }

    public function get($id)
    {
        return $this->db->get_where('packing_lists', ['id' => $id])->row_array();
    }

    public function update_row($id, $data)
    {
        return $this->db->where('id', $id)->update('packing_lists', $data);
    }
}
