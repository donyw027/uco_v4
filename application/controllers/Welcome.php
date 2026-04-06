<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Crud_model', 'crud');
    }

    public function index()
    {
        $data['title'] = 'UCO Trading Solution';
        $this->render('public/home', $data, 'public');
    }

    public function about()
    {
        $data['title'] = 'About - UCO Trading Solution';
        $this->render('public/about', $data, 'public');
    }

    public function products()
    {
        $data['title'] = 'Products - UCO Trading Solution';
        $data['products'] = $this->crud->all('products', 'id ASC');
        $this->render('public/products', $data, 'public');
    }

    public function contact()
    {
        $data['title'] = 'Contact - UCO Trading Solution';
        $this->render('public/contact', $data, 'public');
    }
}
