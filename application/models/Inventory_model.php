<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_model extends CI_Model
{
    public function warehouses()
    {
        return $this->db->order_by('warehouse_name', 'ASC')->get_where('warehouses', ['is_active' => 1])->result_array();
    }

    public function products_active()
    {
        return $this->db->query("SELECT p.*, u.uom_name FROM products p LEFT JOIN uoms u ON u.id=p.uom_id WHERE p.is_active=1 ORDER BY p.product_name ASC")->result_array();
    }

    public function warehouse_stock($product_id, $warehouse_id = null)
    {
        $sql = "SELECT COALESCE(SUM(qty_in - qty_out),0) AS stock FROM stock_movements WHERE product_id=?";
        $params = [$product_id];
        if ($warehouse_id !== null) {
            $sql .= " AND warehouse_id=?";
            $params[] = $warehouse_id;
        }
        $row = $this->db->query($sql, $params)->row_array();
        return (float)($row['stock'] ?? 0);
    }

    public function create_stock_movement($warehouse_id, $product_id, $movement_date, $movement_type, $qty_in, $qty_out, $reference_no = '', $notes = '', $created_by = null)
    {
        $balance_after = $this->warehouse_stock($product_id, $warehouse_id) + $qty_in - $qty_out;
        return $this->db->insert('stock_movements', [
            'warehouse_id' => $warehouse_id,
            'product_id' => $product_id,
            'movement_date' => $movement_date,
            'movement_type' => $movement_type,
            'qty_in' => $qty_in,
            'qty_out' => $qty_out,
            'balance_after' => $balance_after,
            'reference_no' => $reference_no,
            'notes' => $notes,
            'created_by' => $created_by,
        ]);
    }

    public function stock_overview($warehouse_id)
    {
        return $this->db->query("SELECT p.id, p.code, p.product_name, u.uom_name,
            COALESCE(SUM(CASE WHEN sm.warehouse_id=? THEN sm.qty_in-sm.qty_out ELSE 0 END),0) AS stock
            FROM products p
            LEFT JOIN uoms u ON u.id=p.uom_id
            LEFT JOIN stock_movements sm ON sm.product_id=p.id
            WHERE p.is_active=1
            GROUP BY p.id
            ORDER BY p.product_name ASC", [$warehouse_id])->result_array();
    }

    public function movements()
    {
        return $this->db->query("SELECT sm.*, w.warehouse_name, p.product_name, p.code, u.uom_name, us.nama
            FROM stock_movements sm
            LEFT JOIN warehouses w ON w.id=sm.warehouse_id
            LEFT JOIN products p ON p.id=sm.product_id
            LEFT JOIN uoms u ON u.id=p.uom_id
            LEFT JOIN users us ON us.id=sm.created_by
            ORDER BY sm.id DESC LIMIT 100")->result_array();
    }
}
