<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Crud_model', 'crud');
        $this->load->model('Inquiry_message_model', 'inq_msg');
        $this->load->model('Company_model', 'company');
    }

    public function index()
    {
        $data['title'] = 'Uco Exportindo Consulting';
        $data['company'] = $this->company->latest();
        $this->render('public/home', $data, 'public');
    }

    public function about()
    {
        $data['title'] = 'About - Uco Exportindo Consulting';
        $data['company'] = $this->company->latest();
        $this->render('public/about', $data, 'public');
    }

    public function products()
    {
        $data['title'] = 'Products - Uco Exportindo Consulting';
        $data['company'] = $this->company->latest();
        $data['products'] = $this->crud->all('products', 'id ASC');
        $this->render('public/products', $data, 'public');
    }

    public function contact()
    {
        $data['title'] = 'Contact - Uco Exportindo Consulting';
        $data['company'] = $this->company->latest();
        $this->render('public/contact', $data, 'public');
    }

    public function send_inquiry()
    {
        if ($this->input->method() !== 'post') {
            redirect('contact');
        }

        $full_name = trim((string)$this->input->post('full_name', true));
        $email     = trim((string)$this->input->post('email', true));
        $phone     = trim((string)$this->input->post('phone', true));
        $subject   = trim((string)$this->input->post('subject', true));
        $message   = trim((string)$this->input->post('message', true));

        if ($full_name === '' || $email === '' || $subject === '' || $message === '') {
            $this->session->set_flashdata('error', 'Please complete name, email, subject, and message.');
            redirect('contact#inquiry-form');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->session->set_flashdata('error', 'Please enter a valid email address.');
            redirect('contact#inquiry-form');
        }

        $this->db->insert('inquiry_messages', [
            'full_name'  => $full_name,
            'email'      => $email,
            'phone'      => $phone,
            'subject'    => $subject,
            'message'    => $message,
            'status'     => 'new',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $this->session->set_flashdata('success', 'Thank you. Your inquiry has been submitted successfully. Our team will contact you shortly.');
        redirect('contact#inquiry-form');
    }
}
