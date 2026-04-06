<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->require_login();
        $this->load->model('Sales_order_model', 'so');
        $this->load->model('Packing_list_model', 'pl');
        $this->load->model('Invoice_model', 'inv');
        $this->load->model('Inventory_model', 'inventory');
        $this->load->model('Company_model', 'company');
    }

    public function sales_orders()
    {
        if ($this->input->method() === 'post') {
            if ($this->input->post('action') === 'delete') {
                $this->so->delete($this->input->post('id'));
                $this->session->set_flashdata('success', 'Sales Order dihapus.');
                redirect('transactions/sales-orders');
            }
            $header = [
                'order_date' => $this->input->post('order_date') ?: date('Y-m-d'),
                'customer_id' => (int)$this->input->post('customer_id'),
                'currency_id' => (int)$this->input->post('currency_id'),
                'incoterm_id' => (int)$this->input->post('incoterm_id'),
                'payment_term_id' => (int)$this->input->post('payment_term_id'),
                'warehouse_id' => (int)$this->input->post('warehouse_id'),
                'destination_port' => $this->input->post('destination_port', true),
                'remarks' => $this->input->post('remarks', true),
                'created_by' => $this->user['id'] ?? null,
            ];
            $items = [];
            foreach ((array)$this->input->post('product_id') as $i => $pid) {
                $items[] = [
                    'product_id' => (int)$pid,
                    'description' => $this->input->post('description')[$i] ?? '',
                    'qty' => (float)($this->input->post('qty')[$i] ?? 0),
                    'unit_price' => (float)($this->input->post('unit_price')[$i] ?? 0),
                ];
            }
            $this->so->create($header, $items);
            $this->session->set_flashdata('success', 'Sales Order berhasil dibuat.');
            redirect('transactions/sales-orders');
        }

        if ($this->input->get('confirm')) {
            $this->so->confirm((int)$this->input->get('confirm'));
            $this->session->set_flashdata('success', 'Sales Order dikonfirmasi.');
            redirect('transactions/sales-orders');
        }

        if ($this->input->get('ship')) {
            $so_id = (int)$this->input->get('ship');
            $so = $this->so->get($so_id);
            $items = $this->so->items($so_id);
            $error = null;
            foreach ($items as $it) {
                if ($this->inventory->warehouse_stock($it['product_id'], $so['warehouse_id']) < (float)$it['qty']) {
                    $error = 'Stok untuk '.$it['product_name'].' tidak cukup.';
                    break;
                }
            }
            if ($error) {
                $this->session->set_flashdata('error', $error);
            } else {
                foreach ($items as $it) {
                    $this->inventory->create_stock_movement($so['warehouse_id'], $it['product_id'], date('Y-m-d H:i:s'), 'SHIP', 0, (float)$it['qty'], $so['so_no'], 'Auto shipment from sales order', $this->user['id'] ?? null);
                }
                $this->db->where('id', $so_id)->update('sales_orders', ['status' => 'SHIPPED']);
                $this->session->set_flashdata('success', 'Sales Order berhasil di-ship dan stok gudang sudah berkurang.');
            }
            redirect('transactions/sales-orders');
        }

        if ($this->input->get('generate_pl')) {
            $so_id = (int)$this->input->get('generate_pl');
            $pl_no = $this->so->next_doc_no('PL', 'PL-UCO');
            $this->db->insert('packing_lists', ['sales_order_id' => $so_id, 'pl_no' => $pl_no, 'pl_date' => date('Y-m-d'), 'marks_numbers' => '', 'total_packages' => 0, 'gross_weight' => 0, 'net_weight' => 0, 'cbm' => 0]);
            $pl_id = $this->db->insert_id();
            $total_packages = 0;
            $total_gross_weight = 0;
            $total_net_weight = 0;
            $total_cbm = 0;
            foreach ($this->so->items($so_id) as $it) {
                $qty = (float)$it['qty'];
                $package_count = $qty * (float)($it['package_unit'] ?? 0);
                $net_weight = $qty * (float)($it['nw_unit'] ?? 0);
                $gross_weight = $qty * (float)($it['gw_unit'] ?? 0);
                $cbm = $qty * (float)($it['cbm_unit'] ?? 0);
                $this->db->insert('packing_list_items', ['packing_list_id' => $pl_id, 'sales_order_item_id' => $it['id'], 'package_count' => $package_count, 'qty' => $qty, 'net_weight' => $net_weight, 'gross_weight' => $gross_weight, 'cbm' => $cbm]);
                $total_packages += $package_count;
                $total_gross_weight += $gross_weight;
                $total_net_weight += $net_weight;
                $total_cbm += $cbm;
            }
            $this->db->where('id', $pl_id)->update('packing_lists', [
                'total_packages' => $total_packages,
                'gross_weight' => $total_gross_weight,
                'net_weight' => $total_net_weight,
                'cbm' => $total_cbm,
            ]);
            $this->session->set_flashdata('success', 'Packing List berhasil digenerate.');
            redirect('transactions/packing-lists');
        }

        if ($this->input->get('generate_inv')) {
            $so_id = (int)$this->input->get('generate_inv');
            $so = $this->so->get($so_id);
            $invoice_no = $this->so->next_doc_no('INV', 'INV-UCO');
            $this->db->insert('invoices', ['sales_order_id' => $so_id, 'invoice_no' => $invoice_no, 'invoice_date' => date('Y-m-d'), 'notes' => '', 'total_amount' => $so['total_amount']]);
            $inv_id = $this->db->insert_id();
            foreach ($this->so->items($so_id) as $it) {
                $this->db->insert('invoice_items', ['invoice_id' => $inv_id, 'sales_order_item_id' => $it['id'], 'qty' => $it['qty'], 'unit_price' => $it['unit_price'], 'amount' => $it['amount']]);
            }
            $this->session->set_flashdata('success', 'Invoice berhasil digenerate.');
            redirect('transactions/invoices');
        }

        $data = $this->so->reference_data();
        $data['page_title'] = 'Sales Orders';
        $data['rows'] = $this->so->rows();
        $this->render('admin/transactions/sales_orders', $data);
    }

    public function so_detail($id)
    {
        $data['so'] = $this->so->get($id);
        $data['items'] = $this->so->items($id);
        $this->load->view('admin/transactions/so_detail', $data);
    }

    public function packing_lists()
    {
        if ($this->input->method() === 'post') {
            $this->pl->update_row($this->input->post('id'), [
                'pl_date' => $this->input->post('pl_date'),
                'marks_numbers' => $this->input->post('marks_numbers', true),
                'total_packages' => (float)$this->input->post('total_packages'),
                'gross_weight' => (float)$this->input->post('gross_weight'),
                'net_weight' => (float)$this->input->post('net_weight'),
                'cbm' => (float)$this->input->post('cbm'),
            ]);
            $this->session->set_flashdata('success', 'Packing List berhasil diperbarui.');
            redirect('transactions/packing-lists');
        }
        $data['page_title'] = 'Packing Lists';
        $data['edit'] = $this->input->get('edit') ? $this->pl->get($this->input->get('edit')) : null;
        $data['rows'] = $this->pl->rows();
        $this->render('admin/transactions/packing_lists', $data);
    }

    public function invoices()
    {
        if ($this->input->method() === 'post') {
            $this->inv->update_row($this->input->post('id'), ['invoice_date' => $this->input->post('invoice_date'), 'notes' => $this->input->post('notes', true)]);
            $this->session->set_flashdata('success', 'Invoice berhasil diperbarui.');
            redirect('transactions/invoices');
        }
        $data['page_title'] = 'Invoices';
        $data['edit'] = $this->input->get('edit') ? $this->inv->get($this->input->get('edit')) : null;
        $data['rows'] = $this->inv->rows();
        $this->render('admin/transactions/invoices', $data);
    }

    public function print_invoice($id)
    {
        $data['company'] = $this->company->latest();
        $data['inv'] = $this->db->query("SELECT inv.*, so.so_no, so.order_date, c.company_name, c.address, c.country, cur.currency_code, pt.term_name, ic.incoterm_code FROM invoices inv LEFT JOIN sales_orders so ON so.id=inv.sales_order_id LEFT JOIN customers c ON c.id=so.customer_id LEFT JOIN currencies cur ON cur.id=so.currency_id LEFT JOIN payment_terms pt ON pt.id=so.payment_term_id LEFT JOIN incoterms ic ON ic.id=so.incoterm_id WHERE inv.id=?", [$id])->row_array();
        $data['items'] = $this->db->query("SELECT ii.*, p.product_name, soi.description FROM invoice_items ii LEFT JOIN sales_order_items soi ON soi.id=ii.sales_order_item_id LEFT JOIN products p ON p.id=soi.product_id WHERE ii.invoice_id=?", [$id])->result_array();
        $this->load->view('admin/transactions/print_invoice', $data);
    }

    public function print_packing_list($id)
    {
        $data['company'] = $this->company->latest();
        $data['pl'] = $this->db->query("SELECT pl.*, so.so_no, so.order_date, c.company_name, c.address, c.country FROM packing_lists pl LEFT JOIN sales_orders so ON so.id=pl.sales_order_id LEFT JOIN customers c ON c.id=so.customer_id WHERE pl.id=?", [$id])->row_array();
        $data['items'] = $this->db->query("SELECT pli.*, p.product_name, p.nw_unit, p.gw_unit, p.cbm_unit, p.package_unit, soi.description FROM packing_list_items pli LEFT JOIN sales_order_items soi ON soi.id=pli.sales_order_item_id LEFT JOIN products p ON p.id=soi.product_id WHERE pli.packing_list_id=?", [$id])->result_array();

        $calc = ['total_packages' => 0, 'gross_weight' => 0, 'net_weight' => 0, 'cbm' => 0];
        foreach ($data['items'] as &$item) {
            $qty = (float)($item['qty'] ?? 0);
            $item['package_count'] = ((float)($item['package_count'] ?? 0) > 0) ? (float)$item['package_count'] : $qty * (float)($item['package_unit'] ?? 0);
            $item['net_weight'] = ((float)($item['net_weight'] ?? 0) > 0) ? (float)$item['net_weight'] : $qty * (float)($item['nw_unit'] ?? 0);
            $item['gross_weight'] = ((float)($item['gross_weight'] ?? 0) > 0) ? (float)$item['gross_weight'] : $qty * (float)($item['gw_unit'] ?? 0);
            $item['cbm'] = ((float)($item['cbm'] ?? 0) > 0) ? (float)$item['cbm'] : $qty * (float)($item['cbm_unit'] ?? 0);
            $calc['total_packages'] += (float)$item['package_count'];
            $calc['gross_weight'] += (float)$item['gross_weight'];
            $calc['net_weight'] += (float)$item['net_weight'];
            $calc['cbm'] += (float)$item['cbm'];
        }
        unset($item);

        if ((float)($data['pl']['total_packages'] ?? 0) <= 0 && $calc['total_packages'] > 0) {
            $data['pl']['total_packages'] = $calc['total_packages'];
        }
        if ((float)($data['pl']['gross_weight'] ?? 0) <= 0 && $calc['gross_weight'] > 0) {
            $data['pl']['gross_weight'] = $calc['gross_weight'];
        }
        if ((float)($data['pl']['net_weight'] ?? 0) <= 0 && $calc['net_weight'] > 0) {
            $data['pl']['net_weight'] = $calc['net_weight'];
        }
        if ((float)($data['pl']['cbm'] ?? 0) <= 0 && $calc['cbm'] > 0) {
            $data['pl']['cbm'] = $calc['cbm'];
        }

        $this->load->view('admin/transactions/print_packing_list', $data);
    }
}
