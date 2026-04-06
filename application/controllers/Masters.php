<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Masters extends MY_Controller
{
    private $maps = [];

    public function __construct()
    {
        parent::__construct();
        $this->require_login();
        $this->load->model('Crud_model', 'crud');
        $this->maps = [
            'customers' => ['table' => 'customers', 'title' => 'Customers', 'fields' => ['customer_code', 'company_name', 'pic_name', 'email', 'phone', 'address', 'country', 'is_active']],
            'suppliers' => ['table' => 'suppliers', 'title' => 'Suppliers', 'fields' => ['company_name', 'pic_name', 'email', 'phone', 'address', 'country']],
            'uom' => ['table' => 'uoms', 'title' => 'UOM', 'fields' => ['uom_name']],
            'currencies' => ['table' => 'currencies', 'title' => 'Currencies', 'fields' => ['currency_code', 'currency_name']],
            'incoterms' => ['table' => 'incoterms', 'title' => 'Incoterms', 'fields' => ['incoterm_code', 'description']],
            'payment_terms' => ['table' => 'payment_terms', 'title' => 'Payment Terms', 'fields' => ['term_name', 'description']],
            'warehouses' => ['table' => 'warehouses', 'title' => 'Warehouses', 'fields' => ['code', 'warehouse_name', 'location', 'is_active']],
            'users' => ['table' => 'users', 'title' => 'User Management', 'fields' => ['nama', 'username', 'password', 'role', 'is_active']],
            'products' => ['table' => 'products', 'title' => 'Products', 'fields' => ['code', 'product_name', 'description', 'uom_id', 'sales_price', 'nw_unit', 'gw_unit', 'cbm_unit', 'package_unit', 'is_active']],
        ];
    }

    public function index($slug = 'products')
    {
        if (!isset($this->maps[$slug])) show_404();
        $cfg = $this->maps[$slug];
        $data['page_title'] = $cfg['title'];
        $data['slug'] = $slug;
        $data['cfg'] = $cfg;
        $data['edit'] = $this->input->get('edit') ? $this->crud->get($cfg['table'], $this->input->get('edit')) : null;
        if ($slug === 'products') $data['uoms'] = $this->crud->all('uoms', 'uom_name ASC');
        $data['rows'] = $this->crud->all($cfg['table']);

        if ($this->input->method() === 'post') {
            $action = $this->input->post('action');
            if ($action === 'delete') {
                $id = (int)$this->input->post('id');
                if ($slug === 'users' && $id == ($this->user['id'] ?? 0)) {
                    $this->session->set_flashdata('error', 'User login saat ini tidak bisa dihapus.');
                } else {
                    $this->crud->delete($cfg['table'], $id);
                    $this->session->set_flashdata('success', 'Data berhasil dihapus.');
                }
                redirect('masters/' . $slug);
            }

            $payload = [];
            foreach ($cfg['fields'] as $field) {
                if ($field === 'password') continue;
                $payload[$field] = $this->input->post($field, true);
            }
            if ($slug === 'users') {
                if ($this->input->post('password')) {
                    $payload['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                }
            }
            if ($action === 'create') {
                if ($slug === 'users' && empty($payload['password'])) {
                    $payload['password'] = password_hash('admin123', PASSWORD_DEFAULT);
                }
                $this->crud->insert($cfg['table'], $payload);
                $this->session->set_flashdata('success', 'Data berhasil ditambahkan.');
            } else {
                $this->crud->update($cfg['table'], $this->input->post('id'), $payload);
                $this->session->set_flashdata('success', 'Data berhasil diperbarui.');
            }
            redirect('masters/' . $slug);
        }

        $this->render('admin/masters/index', $data);
    }
}
