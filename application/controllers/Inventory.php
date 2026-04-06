<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->require_login();
        $this->load->model('Inventory_model', 'inv');
    }

    public function stock()
    {
        $data['page_title'] = 'Stock Overview';
        $data['warehouse_id'] = (int)($this->input->get('warehouse_id') ?: 1);
        $data['warehouses'] = $this->inv->warehouses();
        $data['rows'] = $this->inv->stock_overview($data['warehouse_id']);
        $this->render('admin/inventory/stock', $data);
    }

    public function movements()
    {
        if ($this->input->method() === 'post') {
            $warehouse_id = (int)$this->input->post('warehouse_id');
            $product_id = (int)$this->input->post('product_id');
            $movement_type = $this->input->post('movement_type', true) ?: 'IN';
            $qty = (float)$this->input->post('qty');
            $qty_in = in_array($movement_type, ['IN','OPENING','ADJUSTMENT']) ? $qty : 0;
            $qty_out = in_array($movement_type, ['OUT','SHIP']) ? $qty : 0;
            if ($qty_out > 0 && $this->inv->warehouse_stock($product_id, $warehouse_id) < $qty_out) {
                $this->session->set_flashdata('error', 'Stok tidak cukup untuk transaksi ini.');
            } else {
                $this->inv->create_stock_movement($warehouse_id, $product_id, $this->input->post('movement_date') ?: date('Y-m-d'), $movement_type, $qty_in, $qty_out, $this->input->post('reference_no', true), $this->input->post('notes', true), $this->user['id'] ?? null);
                $this->session->set_flashdata('success', 'Stock movement berhasil disimpan.');
            }
            redirect('inventory/movements');
        }
        $data['page_title'] = 'Stock Movements';
        $data['warehouses'] = $this->inv->warehouses();
        $data['products'] = $this->inv->products_active();
        $data['rows'] = $this->inv->movements();
        $this->render('admin/inventory/movements', $data);
    }
}
