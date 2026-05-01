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
            'users' => ['table' => 'users', 'title' => 'User Management', 'fields' => ['nama', 'username', 'password', 'position', 'role', 'is_active']],
            'products' => ['table' => 'products', 'title' => 'Products', 'fields' => ['code', 'product_name', 'description', 'image', 'uom_id',  'sales_price', 'nw_unit', 'gw_unit', 'cbm_unit', 'package_unit', 'is_active']],
        ];
    }


    private function handle_product_image_upload()
    {
        if (empty($_FILES['image']['name'])) {
            return null;
        }

        $uploadDir = FCPATH . 'uploads/products/';
        if (!is_dir($uploadDir)) {
            @mkdir($uploadDir, 0777, true);
        }

        $originalName = (string)$_FILES['image']['name'];
        $tmpName = (string)$_FILES['image']['tmp_name'];
        $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($ext, $allowed, true)) {
            $this->session->set_flashdata('error', 'Format gambar produk harus JPG, JPEG, PNG, atau WEBP.');
            return null;
        }

        $filename = 'product_' . date('Ymd_His') . '_' . mt_rand(1000, 9999) . '.' . $ext;
        $target = $uploadDir . $filename;

        if (is_uploaded_file($tmpName) && move_uploaded_file($tmpName, $target)) {
            return $filename;
        }

        $this->session->set_flashdata('error', 'Upload gambar produk gagal. Cek permission folder uploads/products/.');
        return null;
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
                    if ($slug === 'products') {
                        $old = $this->crud->get($cfg['table'], $id);
                        if (!empty($old['image'])) {
                            $oldPath = FCPATH . 'uploads/products/' . $old['image'];
                            if (is_file($oldPath)) {
                                @unlink($oldPath);
                            }
                        }
                    }
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

            if ($slug === 'products') {
                $uploadedImage = $this->handle_product_image_upload();
                if ($uploadedImage !== null) {
                    if ($action !== 'create') {
                        $old = $this->crud->get($cfg['table'], $this->input->post('id'));
                        if (!empty($old['image'])) {
                            $oldPath = FCPATH . 'uploads/products/' . $old['image'];
                            if (is_file($oldPath)) {
                                @unlink($oldPath);
                            }
                        }
                    }
                    $payload['image'] = $uploadedImage;
                } else {
                    unset($payload['image']);
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
