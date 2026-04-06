<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function stats()
    {
        return [
            'products' => (int)$this->db->where('is_active', 1)->count_all_results('products'),
            'customers' => (int)$this->db->where('is_active', 1)->count_all_results('customers'),
            'suppliers' => (int)$this->db->count_all('suppliers'),
            'sales_orders' => (int)$this->db->count_all('sales_orders'),
            'shipped_so' => (int)$this->db->where('status', 'SHIPPED')->count_all_results('sales_orders'),
            'stock_items' => (int)$this->db->query("SELECT COUNT(*) total FROM (SELECT product_id FROM stock_movements GROUP BY product_id HAVING SUM(qty_in-qty_out) > 0) x")->row()->total,
            'draft_so' => (int)$this->db->where('status', 'DRAFT')->count_all_results('sales_orders'),
            'confirmed_so' => (int)$this->db->where('status', 'CONFIRMED')->count_all_results('sales_orders'),
        ];
    }

    public function monthly_revenue()
    {
        $row = $this->db->query("SELECT COALESCE(SUM(total_amount),0) AS total FROM invoices WHERE DATE_FORMAT(invoice_date,'%Y-%m') = DATE_FORMAT(CURDATE(),'%Y-%m')")->row_array();
        return (float)($row['total'] ?? 0);
    }

    public function yearly_revenue()
    {
        $row = $this->db->query("SELECT COALESCE(SUM(total_amount),0) AS total FROM invoices WHERE YEAR(invoice_date) = YEAR(CURDATE())")->row_array();
        return (float)($row['total'] ?? 0);
    }

    public function operational_summary()
    {
        return [
            'packing_lists' => (int)$this->db->count_all('packing_lists'),
            'invoices' => (int)$this->db->count_all('invoices'),
            'movements' => (int)$this->db->count_all('stock_movements'),
            'warehouses' => (int)$this->db->count_all('warehouses'),
        ];
    }

    public function recent_so()
    {
        return $this->db->query("SELECT so.id, so.so_no, so.order_date, so.status, c.company_name, so.total_amount FROM sales_orders so LEFT JOIN customers c ON c.id=so.customer_id ORDER BY so.id DESC LIMIT 8")->result_array();
    }

    public function low_stock()
    {
        return $this->db->query("SELECT p.code, p.product_name, COALESCE(SUM(sm.qty_in-sm.qty_out),0) AS stock, u.uom_name
            FROM products p
            LEFT JOIN stock_movements sm ON sm.product_id=p.id
            LEFT JOIN uoms u ON u.id=p.uom_id
            WHERE p.is_active=1
            GROUP BY p.id
            HAVING stock <= 100
            ORDER BY stock ASC, p.product_name ASC
            LIMIT 8")->result_array();
    }

    public function sales_status_breakdown()
    {
        $rows = $this->db->query("SELECT status, COUNT(*) AS total FROM sales_orders GROUP BY status")->result_array();
        $result = ['DRAFT' => 0, 'CONFIRMED' => 0, 'SHIPPED' => 0];
        foreach ($rows as $row) {
            $result[$row['status']] = (int)$row['total'];
        }
        return $result;
    }
}
