<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->require_login();
        $this->load->model('Company_model', 'company');
    }

    public function company()
    {
        if ($this->input->method() === 'post') {
            $this->company->save([
                'company_name' => $this->input->post('company_name', true),
                'address' => $this->input->post('address', true),
                'phone' => $this->input->post('phone', true),
                'email' => $this->input->post('email', true),
                'bank_info' => $this->input->post('bank_info', true),
                'signature_name' => $this->input->post('signature_name', true),
                'signature_title' => $this->input->post('signature_title', true),
            ]);
            $this->session->set_flashdata('success', 'Company profile berhasil disimpan.');
            redirect('settings/company');
        }
        $data['page_title'] = 'Company Profile';
        $data['row'] = $this->company->latest();
        $this->render('admin/settings/company', $data);
    }
}
