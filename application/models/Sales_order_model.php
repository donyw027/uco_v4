<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_order_model extends CI_Model
{
    public function next_doc_no($type, $prefix)
    {
        $ym = date('Ym');
        $row = $this->db->get_where('document_sequences', ['doc_type' => $type, 'yyyymm' => $ym], 1)->row_array();
        if ($row) {
            $num = (int)$row['last_number'] + 1;
            $this->db->where('id', $row['id'])->update('document_sequences', ['last_number' => $num]);
        } else {
            $num = 1;
            $this->db->insert('document_sequences', ['doc_type' => $type, 'yyyymm' => $ym, 'last_number' => $num]);
        }
        return sprintf('%s/%s/%04d', $prefix, $ym, $num);
    }

    public function reference_data()
    {
        return [
            'customers' => $this->db->order_by('company_name','ASC')->get_where('customers', ['is_active' => 1])->result_array(),
            'currencies' => $this->db->order_by('currency_code','ASC')->get('currencies')->result_array(),
            'incoterms' => $this->db->order_by('incoterm_code','ASC')->get('incoterms')->result_array(),
            'payment_terms' => $this->db->order_by('term_name','ASC')->get('payment_terms')->result_array(),
            'products' => $this->db->query("SELECT p.*, u.uom_name FROM products p LEFT JOIN uoms u ON u.id=p.uom_id WHERE p.is_active=1 ORDER BY p.product_name ASC")->result_array(),
            'warehouses' => $this->db->order_by('warehouse_name','ASC')->get_where('warehouses', ['is_active' => 1])->result_array(),
        ];
    }

    public function rows()
    {
        return $this->db->query("SELECT so.*, c.company_name, cur.currency_code, w.warehouse_name FROM sales_orders so LEFT JOIN customers c ON c.id=so.customer_id LEFT JOIN currencies cur ON cur.id=so.currency_id LEFT JOIN warehouses w ON w.id=so.warehouse_id ORDER BY so.id DESC")->result_array();
    }

    public function create($header, $items)
    {
        $this->db->trans_begin();
        $header['so_no'] = $this->next_doc_no('SO', 'SO-UCO');
        $header['status'] = 'DRAFT';
        $header['total_amount'] = 0;
        $this->db->insert('sales_orders', $header);
        $so_id = $this->db->insert_id();
        $total = 0;
        foreach ($items as $it) {
            if (empty($it['product_id']) || (float)$it['qty'] <= 0) continue;
            $it['sales_order_id'] = $so_id;
            $it['amount'] = (float)$it['qty'] * (float)$it['unit_price'];
            $total += $it['amount'];
            $this->db->insert('sales_order_items', $it);
        }
        $this->db->where('id', $so_id)->update('sales_orders', ['total_amount' => $total]);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        }
        $this->db->trans_commit();
        return true;
    }

    public function confirm($id)
    {
        return $this->db->where('id', $id)->where('status', 'DRAFT')->update('sales_orders', ['status' => 'CONFIRMED']);
    }

    public function get($id)
    {
        return $this->db->query("SELECT so.*, c.company_name, cur.currency_code, w.warehouse_name FROM sales_orders so LEFT JOIN customers c ON c.id=so.customer_id LEFT JOIN currencies cur ON cur.id=so.currency_id LEFT JOIN warehouses w ON w.id=so.warehouse_id WHERE so.id=?", [$id])->row_array();
    }

    public function items($so_id)
    {
        return $this->db->query("SELECT soi.*, p.product_name, p.nw_unit, p.gw_unit, p.cbm_unit, p.package_unit FROM sales_order_items soi LEFT JOIN products p ON p.id=soi.product_id WHERE soi.sales_order_id=? ORDER BY soi.id ASC", [$so_id])->result_array();
    }

    public function delete($id)
    {
        $this->db->trans_begin();
        $this->db->delete('sales_order_items', ['sales_order_id' => $id]);
        $this->db->delete('sales_orders', ['id' => $id]);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        }
        $this->db->trans_commit();
        return true;
    }
}
