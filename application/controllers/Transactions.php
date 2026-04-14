<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transactions extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->require_login();
        $this->load->model('Sales_order_model', 'so');
        $this->load->model('Packing_list_model', 'pl');
        $this->load->model('Manual_invoice_model', 'manual_inv');
        $this->load->model('Invoice_model', 'inv');
        $this->load->model('Inventory_model', 'inventory');
        $this->load->model('Manual_inquiry_model', 'manual_inquiry');
        $this->load->model('Company_model', 'company');
    }

    public function inquiries()
    {
        if ($this->input->method() === 'post') {
            $action = $this->input->post('submit_action');

            $proposal_no = trim((string)$this->input->post('proposal_no'));
            if ($proposal_no === '') {
                $proposal_no = 'INQ-UCO/' . date('Ym') . '/' . str_pad((string)rand(1, 9999), 4, '0', STR_PAD_LEFT);
            }

            $header = [
                'proposal_no'       => $proposal_no,
                'proposal_date'     => $this->input->post('proposal_date') ?: date('Y-m-d'),
                'recipient_company' => $this->input->post('recipient_company', true),
                'recipient_address' => $this->input->post('recipient_address', true),
                'recipient_pic'     => $this->input->post('recipient_pic', true),
                'subject'           => $this->input->post('subject', true),
                'opening_text'      => $this->input->post('opening_text', true),
                'terms_text'        => $this->input->post('terms_text', true),
                'closing_text'      => $this->input->post('closing_text', true),
                'currency_text'     => $this->input->post('currency_text', true) ?: 'IDR',
                'created_by'        => $this->user['id'] ?? null,
            ];

            $items = [];
            foreach ((array)$this->input->post('description') as $i => $desc) {
                $items[] = [
                    'description'   => $desc,
                    'agency'        => $this->input->post('agency')[$i] ?? '',
                    'duration_text' => $this->input->post('duration_text')[$i] ?? '',
                    'amount'        => (float)($this->input->post('amount')[$i] ?? 0),
                ];
            }

            if ($action === 'save_print') {
                $saved_id = $this->manual_inquiry->create($header, $items);

                if ($saved_id) {
                    $this->session->set_flashdata('success', 'Inquiry berhasil disimpan.');
                    redirect('transactions/print-manual-inquiry/' . $saved_id);
                }

                $this->session->set_flashdata('error', 'Gagal menyimpan inquiry.');
                redirect('transactions/inquiries');
            }

            if ($action === 'print_only') {
                $draft = [
                    'header' => $header,
                    'items'  => $items,
                ];
                $this->session->set_userdata('manual_inquiry_draft', $draft);
                redirect('transactions/print-manual-inquiry-draft');
            }
        }

        $data['page_title'] = 'Inquiries';
        $data['rows'] = $this->manual_inquiry->rows();
        $this->render('admin/transactions/manual_inquiries', $data);
    }

    public function print_manual_inquiry($id)
    {
        $data['company'] = $this->company->latest();
        $data['inq'] = $this->manual_inquiry->get($id);
        $data['items'] = $this->manual_inquiry->items($id);

        $this->load->view('admin/transactions/print_manual_inquiry', $data);
    }

    public function print_manual_inquiry_draft()
    {
        $draft = $this->session->userdata('manual_inquiry_draft');
        if (!$draft) {
            $this->session->set_flashdata('error', 'Draft inquiry tidak ditemukan.');
            redirect('transactions/inquiries');
        }

        $data['company'] = $this->company->latest();
        $data['inq'] = $draft['header'];
        $data['items'] = array_values(array_filter($draft['items'], function ($it) {
            return trim((string)$it['description']) !== '';
        }));

        $this->session->unset_userdata('manual_inquiry_draft');
        $this->load->view('admin/transactions/print_manual_inquiry', $data);
    }

    public function manual_invoices()
    {
        if ($this->input->method() === 'post') {
            $action = $this->input->post('submit_action');

            $invoice_no = trim((string)$this->input->post('invoice_no'));
            if ($invoice_no === '') {
                $invoice_no = $this->so->next_doc_no('INV', 'INV-UCO');
            }

            $header = [
                'invoice_no'       => $invoice_no,
                'invoice_date'     => $this->input->post('invoice_date') ?: date('Y-m-d'),
                'customer_name'    => $this->input->post('customer_name', true),
                'customer_address' => $this->input->post('customer_address', true),
                'customer_country' => $this->input->post('customer_country', true),
                'pic_name'         => $this->input->post('pic_name', true),
                'currency_id'      => (int)$this->input->post('currency_id'),
                'incoterm_id'      => (int)$this->input->post('incoterm_id'),
                'payment_term_id'  => (int)$this->input->post('payment_term_id'),
                'subject'          => $this->input->post('subject', true),
                'notes'            => $this->input->post('notes', true),
                'created_by'       => $this->user['id'] ?? null,
                'total_amount'     => 0,
            ];

            $items = [];
            foreach ((array)$this->input->post('description') as $i => $desc) {
                $items[] = [
                    'description' => $desc,
                    'qty'         => (float)($this->input->post('qty')[$i] ?? 0),
                    'unit'        => $this->input->post('unit')[$i] ?? '',
                    'unit_price'  => (float)($this->input->post('unit_price')[$i] ?? 0),
                ];
            }

            if ($action === 'save_print') {
                $saved_id = $this->manual_inv->create($header, $items);

                if ($saved_id) {
                    $this->session->set_flashdata('success', 'Manual invoice berhasil disimpan.');
                    redirect('transactions/print-manual-invoice/' . $saved_id);
                }

                $this->session->set_flashdata('error', 'Gagal menyimpan manual invoice.');
                redirect('transactions/manual-invoices');
            }

            if ($action === 'print_only') {
                $draft = [
                    'header' => $header,
                    'items'  => $items,
                ];
                $this->session->set_userdata('manual_invoice_draft', $draft);
                redirect('transactions/print-manual-invoice-draft');
            }
        }

        $data = $this->so->reference_data();
        $data['page_title'] = 'Manual Invoices';
        $data['rows'] = $this->manual_inv->rows();
        $data['next_invoice_no'] = 'AUTO';
        $this->render('admin/transactions/manual_invoices', $data);
    }

    public function print_manual_invoice($id)
    {
        $data['company'] = $this->company->latest();
        $data['inv'] = $this->db->query("
        SELECT mi.*,
               cur.currency_code,
               pt.term_name,
               ic.incoterm_code
        FROM manual_invoices mi
        LEFT JOIN currencies cur ON cur.id = mi.currency_id
        LEFT JOIN payment_terms pt ON pt.id = mi.payment_term_id
        LEFT JOIN incoterms ic ON ic.id = mi.incoterm_id
        WHERE mi.id = ?
    ", [$id])->row_array();

        $data['items'] = $this->manual_inv->items($id);

        $this->load->view('admin/transactions/print_manual_invoice', $data);
    }

    public function print_manual_invoice_draft()
    {
        $draft = $this->session->userdata('manual_invoice_draft');
        if (!$draft) {
            $this->session->set_flashdata('error', 'Draft invoice tidak ditemukan.');
            redirect('transactions/manual-invoices');
        }

        $data['company'] = $this->company->latest();

        $currency = $this->db->get_where('currencies', ['id' => (int)($draft['header']['currency_id'] ?? 0)])->row_array();
        $incoterm = $this->db->get_where('incoterms', ['id' => (int)($draft['header']['incoterm_id'] ?? 0)])->row_array();
        $payment = $this->db->get_where('payment_terms', ['id' => (int)($draft['header']['payment_term_id'] ?? 0)])->row_array();

        $total = 0;
        $items = [];
        foreach ((array)$draft['items'] as $it) {
            if (trim($it['description']) === '' || (float)$it['qty'] <= 0) {
                continue;
            }

            $amount = (float)$it['qty'] * (float)$it['unit_price'];
            $total += $amount;

            $items[] = [
                'description' => $it['description'],
                'qty' => $it['qty'],
                'unit' => $it['unit'],
                'unit_price' => $it['unit_price'],
                'amount' => $amount,
            ];
        }

        $data['inv'] = [
            'invoice_no' => $draft['header']['invoice_no'] ?: 'DRAFT-PREVIEW',
            'invoice_date' => $draft['header']['invoice_date'],
            'customer_name' => $draft['header']['customer_name'],
            'customer_address' => $draft['header']['customer_address'],
            'customer_country' => $draft['header']['customer_country'],
            'pic_name' => $draft['header']['pic_name'],
            'subject' => $draft['header']['subject'],
            'notes' => $draft['header']['notes'],
            'currency_code' => $currency['currency_code'] ?? '',
            'term_name' => $payment['term_name'] ?? '',
            'incoterm_code' => $incoterm['incoterm_code'] ?? '',
            'total_amount' => $total,
        ];

        $data['items'] = $items;

        $this->session->unset_userdata('manual_invoice_draft');
        $this->load->view('admin/transactions/print_manual_invoice', $data);
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
                    $error = 'Stok untuk ' . $it['product_name'] . ' tidak cukup.';
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
