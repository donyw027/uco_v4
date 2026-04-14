<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';
$route['dashboard'] = 'dashboard/index';
$route['about'] = 'welcome/about';
$route['products'] = 'welcome/products';
$route['contact'] = 'welcome/contact';

$route['masters/(:any)'] = 'masters/index/$1';
$route['inventory/stock'] = 'inventory/stock';
$route['inventory/movements'] = 'inventory/movements';
$route['transactions/sales-orders'] = 'transactions/sales_orders';
$route['transactions/packing-lists'] = 'transactions/packing_lists';
$route['transactions/invoices'] = 'transactions/invoices';
$route['transactions/so-detail/(:num)'] = 'transactions/so_detail/$1';
$route['transactions/print-invoice/(:num)'] = 'transactions/print_invoice/$1';
$route['transactions/print-packing-list/(:num)'] = 'transactions/print_packing_list/$1';
$route['settings/company'] = 'settings/company';


$route['transactions/manual-invoices'] = 'transactions/manual_invoices';
$route['transactions/print-manual-invoice/(:num)'] = 'transactions/print_manual_invoice/$1';
$route['transactions/print-manual-invoice-draft'] = 'transactions/print_manual_invoice_draft';
$route['transactions/inquiries'] = 'transactions/inquiries';

$route['transactions/inquiries'] = 'transactions/inquiries';
$route['transactions/print-manual-inquiry/(:num)'] = 'transactions/print_manual_inquiry/$1';
$route['transactions/print-manual-inquiry-draft'] = 'transactions/print_manual_inquiry_draft';
