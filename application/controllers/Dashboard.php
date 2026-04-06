<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->require_login();
        $this->load->model('Dashboard_model', 'dash');
    }

    public function index()
    {
        $data['page_title'] = 'Executive Dashboard';
        $data['stats'] = $this->dash->stats();
        $data['monthly_revenue'] = $this->dash->monthly_revenue();
        $data['yearly_revenue'] = $this->dash->yearly_revenue();
        $data['operational_summary'] = $this->dash->operational_summary();
        $data['status_breakdown'] = $this->dash->sales_status_breakdown();
        $data['recent_so'] = $this->dash->recent_so();
        $data['low_stock'] = $this->dash->low_stock();
        $this->render('admin/dashboard/index', $data);
    }
}
