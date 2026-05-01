<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact_messages extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->require_login();
        $this->load->model('Inquiry_message_model', 'inq_msg');
    }

    public function index()
    {
        $data['page_title'] = 'Website Inquiry Messages';
        $data['filter_status'] = $this->input->get('status', true);
        $data['keyword'] = $this->input->get('q', true);
        $data['rows'] = $this->inq_msg->rows($data['filter_status'], $data['keyword']);
        $this->render('admin/contact_messages/index', $data);
    }

    public function view($id)
    {
        $row = $this->inq_msg->get($id);
        if (!$row) {
            show_404();
        }

        if (($row['status'] ?? '') === 'new') {
            $this->inq_msg->update_status($id, 'read');
            $row['status'] = 'read';
        }

        $data['page_title'] = 'Inquiry Detail';
        $data['row'] = $row;
        $this->render('admin/contact_messages/view', $data);
    }

    public function status($id)
    {
        $this->inq_msg->update_status($id, $this->input->post('status', true));
        $this->session->set_flashdata('success', 'Status inquiry berhasil diperbarui.');
        redirect('contact_messages/view/' . (int)$id);
    }

    public function delete($id)
    {
        $this->inq_msg->delete($id);
        $this->session->set_flashdata('success', 'Inquiry berhasil dihapus.');
        redirect('contact_messages');
    }
}
