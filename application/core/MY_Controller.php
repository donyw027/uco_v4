<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected $user;

    public function __construct()
    {
        parent::__construct();
        $this->user = $this->session->userdata('user');
    }

    protected function require_login()
    {
        if (!$this->user) {
            redirect('login');
        }
    }

    protected function render($view, $data = [], $layout = 'admin')
    {
        $data['current_user'] = $this->user;
        if ($layout === 'public') {
            $this->load->view('templates/public_header', $data);
            $this->load->view($view, $data);
            $this->load->view('templates/public_footer', $data);
            return;
        }
        $this->load->view('templates/admin_header', $data);
        $this->load->view($view, $data);
        $this->load->view('templates/admin_footer', $data);
    }
}
