<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Crud_model', 'crud');
    }

    public function index()
    {
        $data['title'] = 'Uco Exportindo Consulting';
        $this->render('public/home', $data, 'public');
    }

    public function about()
    {
        $data['title'] = 'About - Uco Exportindo Consulting';
        $this->render('public/about', $data, 'public');
    }

    public function products()
    {
        $data['title'] = 'Products - Uco Exportindo Consulting';
        $data['products'] = $this->crud->all('products', 'id ASC');
        $this->render('public/products', $data, 'public');
    }

    public function contact()
    {
        $data['title'] = 'Contact - Uco Exportindo Consulting';
        $this->render('public/contact', $data, 'public');
    }
}
