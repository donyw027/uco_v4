<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fee_slips extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->require_login();
        $this->load->model('Fee_slip_model', 'fee_slip');
        $this->load->model('Company_model', 'company');
    }

    public function index()
    {
        if ($this->input->method() === 'post') {
            $id = (int)$this->input->post('id');
            $action = $this->input->post('submit_action');
            $slip_no = trim((string)$this->input->post('slip_no'));
            if ($slip_no === '') {
                $slip_no = $this->fee_slip->next_slip_no();
            }
            $data = [
                'slip_no' => $slip_no,
                'slip_date' => $this->input->post('slip_date') ?: date('Y-m-d'),
                'period_text' => $this->input->post('period_text', true),
                'payee_name' => $this->input->post('payee_name', true),
                'position_text' => $this->input->post('position_text', true),
                'bank_account' => $this->input->post('bank_account', true),
                'payment_term' => $this->input->post('payment_term', true),
                'currency_text' => $this->input->post('currency_text', true) ?: 'IDR',
                'description' => $this->input->post('description', false),
                'notes' => $this->input->post('notes', false),
                'gross_fee' => (float)$this->input->post('gross_fee'),
                'capital_contribution' => (float)$this->input->post('capital_contribution'),
                'deduction_amount' => (float)$this->input->post('deduction_amount'),
                'tax_amount' => (float)$this->input->post('tax_amount'),
                'created_by' => $this->user['id'] ?? null,
            ];

            if ($action === 'print_only') {
                $data['take_home_pay'] = $this->fee_slip->calculate_take_home($data);
                $this->session->set_userdata('fee_slip_draft', $data);
                redirect('fee-slips/print-draft');
            }

            $saved_id = $this->fee_slip->save($data, $id ?: null);
            $this->session->set_flashdata('success', $id ? 'Slip gaji berhasil diperbarui.' : 'Slip gaji berhasil dibuat.');
            if ($action === 'save_print') {
                redirect('fee-slips/print/' . $saved_id);
            }
            redirect('fee-slips');
        }
        $data['page_title'] = 'Salary / Fee Slips';
        $data['rows'] = $this->fee_slip->rows();
        $data['edit'] = $this->input->get('edit') ? $this->fee_slip->get($this->input->get('edit')) : null;
        $this->render('admin/fee_slips/index', $data);
    }

    public function print_slip($id)
    {
        $data['company'] = $this->company->latest();
        $data['slip'] = $this->fee_slip->get($id);
        if (!$data['slip']) show_404();
        $this->load->view('admin/fee_slips/print', $data);
    }


    public function print_only()
    {
        $data = [
            'slip_no' => trim((string)$this->input->post('slip_no')) ?: $this->fee_slip->next_slip_no(),
            'slip_date' => $this->input->post('slip_date') ?: date('Y-m-d'),
            'period_text' => $this->input->post('period_text', true),
            'payee_name' => $this->input->post('payee_name', true),
            'position_text' => $this->input->post('position_text', true),
            'bank_account' => $this->input->post('bank_account', true),
            'payment_term' => $this->input->post('payment_term', true),
            'currency_text' => $this->input->post('currency_text', true) ?: 'IDR',
            'description' => $this->input->post('description', false),
            'notes' => $this->input->post('notes', false),
            'gross_fee' => (float)$this->input->post('gross_fee'),
            'capital_contribution' => (float)$this->input->post('capital_contribution'),
            'deduction_amount' => (float)$this->input->post('deduction_amount'),
            'tax_amount' => (float)$this->input->post('tax_amount'),
        ];
        $data['take_home_pay'] = $this->fee_slip->calculate_take_home($data);
        $this->session->set_userdata('fee_slip_draft', $data);
        redirect('fee-slips/print-draft');
    }

    public function print_draft()
    {
        $draft = $this->session->userdata('fee_slip_draft');
        if (!$draft) show_404();
        $data['company'] = $this->company->latest();
        $data['slip'] = $draft;
        $data['is_draft'] = true;
        $this->load->view('admin/fee_slips/print', $data);
    }

    public function delete($id)
    {
        $this->fee_slip->delete($id);
        $this->session->set_flashdata('success', 'Slip gaji berhasil dihapus.');
        redirect('fee-slips');
    }
}
