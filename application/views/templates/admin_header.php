<?php
defined('BASEPATH') or exit('No direct script access allowed');

$page_title = isset($page_title) ? $page_title : 'Admin Panel';
$site_name  = isset($site_name) ? $site_name : 'UCO Trading';

/*
|--------------------------------------------------------------------------
| Current user aman
|--------------------------------------------------------------------------
*/
$u = isset($current_user) && is_array($current_user) ? $current_user : [];

/*
|--------------------------------------------------------------------------
| Ambil path URL tanpa bergantung ke uri_string / $this->uri
|--------------------------------------------------------------------------
*/
$request_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
$script_name = isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '';

$path = parse_url($request_uri, PHP_URL_PATH);
$path = trim($path, '/');

$segments = ($path === '') ? [] : explode('/', $path);

/*
|--------------------------------------------------------------------------
| Hilangkan base folder project jika jalan di subfolder
| contoh: /uco_v4/dashboard
|--------------------------------------------------------------------------
*/
$base_dir = trim(str_replace('\\', '/', dirname($script_name)), '/');
if ($base_dir !== '') {
  $base_parts = explode('/', $base_dir);
  foreach ($base_parts as $part) {
    if (!empty($segments) && isset($segments[0]) && $segments[0] === $part) {
      array_shift($segments);
    }
  }
}

/*
|--------------------------------------------------------------------------
| Normalisasi jika index.php muncul di URL
|--------------------------------------------------------------------------
*/
if (!empty($segments) && $segments[0] === 'index.php') {
  array_shift($segments);
}

$current_path = implode('/', $segments);

/*
|--------------------------------------------------------------------------
| Helper active menu lokal
|--------------------------------------------------------------------------
*/
$nav_active = function ($targets = []) use ($current_path) {
  foreach ((array)$targets as $target) {
    if ($current_path === trim($target, '/')) {
      return 'active';
    }
  }
  return '';
};
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($page_title); ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/css2/app.css'); ?>" rel="stylesheet">
</head>

<body>
  <div class="d-flex admin-shell">
    <aside class="sidebar text-white p-3 p-lg-4">
      <a href="<?= site_url('dashboard'); ?>" class="sidebar-brand mb-3 text-decoration-none">
        <div class="brand-title">UCO Trading Solution</div>
        <div class="brand-subtitle">Export trading admin system</div>
      </a>

      <div class="user-chip mb-3">
        <strong><?= e(isset($u['nama']) ? $u['nama'] : 'Administrator'); ?></strong>
        <span><?= e(ucfirst(isset($u['role']) ? $u['role'] : 'admin')); ?> access panel</span>
      </div>

      <nav class="nav flex-column gap-1">
        <a class="nav-link <?= $nav_active(['dashboard']); ?>" href="<?= site_url('dashboard'); ?>">
          <i class="bi bi-grid-1x2-fill"></i> Dashboard
        </a>


        <div class="nav-section-title">Master Data</div>

        <a class="nav-link d-flex justify-content-between align-items-center"
          data-bs-toggle="collapse"
          href="#masterMenu"
          role="button"
          aria-expanded="false"
          aria-controls="masterMenu">
          <span><i class="bi bi-database"></i> Master Data</span>
          <i class="bi bi-chevron-down"></i>
        </a>

        <div class="collapse <?= $nav_active([
                                'masters/products',
                                'masters/customers',
                                'masters/suppliers',
                                'masters/uom',
                                'masters/currencies',
                                'masters/incoterms',
                                'masters/payment_terms',
                                'masters/warehouses',
                                'settings/company'
                              ]) ? 'show' : '' ?>" id="masterMenu">

          <a class="nav-link ms-3 <?= $nav_active(['masters/products']); ?>" href="<?= site_url('masters/products'); ?>">
            <i class="bi bi-box-seam"></i> Products
          </a>

          <a class="nav-link ms-3 <?= $nav_active(['masters/customers']); ?>" href="<?= site_url('masters/customers'); ?>">
            <i class="bi bi-people"></i> Customers
          </a>

          <a class="nav-link ms-3 <?= $nav_active(['masters/suppliers']); ?>" href="<?= site_url('masters/suppliers'); ?>">
            <i class="bi bi-building"></i> Suppliers
          </a>

          <a class="nav-link ms-3 <?= $nav_active(['masters/uom']); ?>" href="<?= site_url('masters/uom'); ?>">
            <i class="bi bi-rulers"></i> UOM
          </a>

          <a class="nav-link ms-3 <?= $nav_active(['masters/currencies']); ?>" href="<?= site_url('masters/currencies'); ?>">
            <i class="bi bi-currency-exchange"></i> Currencies
          </a>

          <a class="nav-link ms-3 <?= $nav_active(['masters/incoterms']); ?>" href="<?= site_url('masters/incoterms'); ?>">
            <i class="bi bi-globe2"></i> Incoterms
          </a>

          <a class="nav-link ms-3 <?= $nav_active(['masters/payment_terms']); ?>" href="<?= site_url('masters/payment_terms'); ?>">
            <i class="bi bi-calendar-check"></i> Payment Terms
          </a>

          <a class="nav-link ms-3 <?= $nav_active(['masters/warehouses']); ?>" href="<?= site_url('masters/warehouses'); ?>">
            <i class="bi bi-house-door"></i> Warehouses
          </a>

          <a class="nav-link ms-3 <?= $nav_active(['settings/company']); ?>" href="<?= site_url('settings/company'); ?>">
            <i class="bi bi-bank"></i> Company Profile
          </a>

        </div>

        <div class="nav-section-title">Transactions</div>
        <a class="nav-link <?= $nav_active(['transactions/sales-orders']); ?>" href="<?= site_url('transactions/sales-orders'); ?>">
          <i class="bi bi-receipt"></i> Sales Orders
        </a>
        <a class="nav-link <?= $nav_active(['transactions/packing-lists']); ?>" href="<?= site_url('transactions/packing-lists'); ?>">
          <i class="bi bi-box2-heart"></i> Packing Lists
        </a>
        <a class="nav-link <?= $nav_active(['transactions/invoices']); ?>" href="<?= site_url('transactions/invoices'); ?>">
          <i class="bi bi-file-earmark-text"></i> Invoices
        </a>

        <div class="nav-section-title">Inventory</div>
        <a class="nav-link <?= $nav_active(['inventory/stock']); ?>" href="<?= site_url('inventory/stock'); ?>">
          <i class="bi bi-bar-chart-steps"></i> Stock Overview
        </a>
        <a class="nav-link <?= $nav_active(['inventory/movements']); ?>" href="<?= site_url('inventory/movements'); ?>">
          <i class="bi bi-arrow-left-right"></i> Stock Movements
        </a>

        <div class="nav-section-title">System</div>
        <a class="nav-link <?= $nav_active(['masters/users']); ?>" href="<?= site_url('masters/users'); ?>">
          <i class="bi bi-person-badge"></i> User Management
        </a>
        <a class="nav-link" href="<?= site_url('logout'); ?>">
          <i class="bi bi-box-arrow-right"></i> Logout
        </a>
      </nav>
    </aside>

    <main class="flex-grow-1 main-area">
      <div class="topbar-panel d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
          <h1 class="h4"><?= e($page_title); ?></h1>
          <div class="subtext">Modernized V4 admin workspace for export operations, documents, and stock monitoring.</div>
        </div>
        <div class="text-end">
          <div class="badge-soft badge-soft-primary mb-2">
            <i class="bi bi-shield-check me-1"></i> Trusted export workflow
          </div>
          <div class="subtext">Today: <?= date('d M Y'); ?></div>
        </div>
      </div>

      <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?= e($this->session->flashdata('success')); ?></div>
      <?php endif; ?>

      <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"><?= e($this->session->flashdata('error')); ?></div>
      <?php endif; ?>