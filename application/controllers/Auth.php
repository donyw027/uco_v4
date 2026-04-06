<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model', 'authm');
    }

    public function login()
    {
        if ($this->user) redirect('dashboard');
        if ($this->input->method() === 'post') {
            $user = $this->authm->login($this->input->post('username', true), $this->input->post('password'));
            if ($user) {
                $this->session->set_userdata('user', $user);
                redirect('dashboard');
            }
            $this->session->set_flashdata('error', 'Username atau password salah.');
            redirect('login');
        }
        $this->load->view('auth/login');
    }

    public function logout()
    {
        $this->session->unset_userdata('user');
        $this->session->set_flashdata('success', 'Berhasil logout.');
        redirect('login');
    }
}
