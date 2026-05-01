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

$master_menu_open = $nav_active([
  'masters/products',
  'masters/customers',
  'masters/suppliers',
  'masters/uom',
  'masters/currencies',
  'masters/incoterms',
  'masters/payment_terms',
  'masters/warehouses',
  'masters/users',
  'settings/company'
]) ? true : false;
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($page_title); ?></title>
  <link rel="icon" href="<?= base_url('assets/img/favicon.png'); ?>">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/css2/app.css'); ?>" rel="stylesheet">

  <style>
    .navbar {
      border-bottom: 1px solid #eee;
    }

    html {
      overflow-y: scroll;
    }

    body {
      overflow-x: hidden;
    }

    .admin-shell {
      min-height: 100vh;
      align-items: stretch;
    }

    .sidebar {
      width: 290px;
      min-width: 290px;
      max-width: 290px;
      flex: 0 0 290px;
      min-height: 100vh;
      overflow-y: auto;
      overflow-x: hidden;
      position: sticky;
      top: 0;
    }

    .main-area {
      min-width: 0;
      width: calc(100% - 290px);
      flex: 1 1 auto;
    }

    .sidebar .sidebar-brand,
    .sidebar .user-chip,
    .sidebar .nav-section-title,
    .sidebar .nav-link {
      width: 100%;
    }

    .sidebar .nav-link {
      display: flex;
      align-items: center;
      gap: 10px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .sidebar .nav-link i {
      flex: 0 0 18px;
      text-align: center;
    }

    .sidebar .collapse .nav-link {
      padding-left: 1rem !important;
    }

    .sidebar .collapse .nav-link span,
    .sidebar .nav-link span {
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }

    .sidebar .bi-chevron-down {
      margin-left: auto;
      flex: 0 0 auto;
    }



    /* =========================================================
       Admin compact usability patch
       - tombol tabel sejajar, tidak turun ke bawah
       - form/card/table lebih ringkas dan enak dibaca
       ========================================================= */
    .section-block {
      margin-bottom: 1.35rem;
    }

    .section-head {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 1rem;
      margin-bottom: .85rem;
    }

    .section-head h3 {
      margin-bottom: .15rem;
      font-size: 1.15rem;
      font-weight: 800;
      letter-spacing: -.02em;
    }

    .section-head p {
      margin-bottom: 0;
      font-size: .86rem;
      color: #64748b;
    }

    .card {
      border: 1px solid rgba(15, 23, 42, .08);
      border-radius: 18px;
    }

    .card.shadow-sm {
      box-shadow: 0 10px 30px rgba(15, 23, 42, .055) !important;
    }

    .card-body {
      padding: 1.1rem;
    }

    .form-label {
      margin-bottom: .32rem;
      font-size: .78rem;
      font-weight: 700;
      color: #475569;
    }

    .form-control,
    .form-select {
      min-height: 38px;
      border-radius: 11px;
      border-color: #dbe3ef;
      font-size: .88rem;
    }

    textarea.form-control {
      min-height: auto;
    }

    .btn {
      border-radius: 11px;
      font-weight: 700;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: .35rem;
    }

    .btn-sm {
      min-height: 31px;
      padding: .28rem .58rem;
      border-radius: 10px;
      font-size: .78rem;
      line-height: 1.1;
      white-space: nowrap;
    }

    .table-responsive {
      overflow-x: auto;
    }

    .table {
      --bs-table-bg: transparent;
      font-size: .88rem;
    }

    .table> :not(caption)>*>* {
      padding: .62rem .75rem;
      vertical-align: middle;
    }

    .table thead th {
      font-size: .74rem;
      text-transform: uppercase;
      letter-spacing: .04em;
      color: #64748b;
      background: #f8fafc;
      border-bottom: 1px solid #e2e8f0;
      white-space: nowrap;
    }

    .table tbody tr:hover {
      background: #f8fafc;
    }

    .table-action-group,
    .action-buttons {
      display: inline-flex;
      align-items: center;
      flex-wrap: nowrap;
      gap: .38rem;
      white-space: nowrap;
    }

    .table-action-group form,
    .action-buttons form {
      display: inline-flex;
      margin: 0;
    }

    .table td.action-cell,
    .table th.action-cell {
      width: 1%;
      white-space: nowrap;
    }

    .admin-form-actions {
      display: flex;
      align-items: center;
      flex-wrap: wrap;
      gap: .5rem;
    }

    .empty-state {
      text-align: center;
      color: #94a3b8;
      padding: 1.4rem !important;
      font-weight: 600;
    }

    @media (max-width: 767.98px) {
      .section-head {
        align-items: flex-start;
        flex-direction: column;
      }

      .card-body {
        padding: .95rem;
      }

      .table {
        font-size: .82rem;
      }

      .table> :not(caption)>*>* {
        padding: .55rem .6rem;
      }
    }

    @media (max-width: 991.98px) {
      .admin-shell {
        display: block !important;
      }

      .sidebar {
        width: 100%;
        min-width: 100%;
        max-width: 100%;
        flex: 0 0 100%;
        min-height: auto;
        position: relative;
        top: auto;
      }

      .main-area {
        width: 100%;
      }
    }
  </style>
</head>

<body>
  <!-- TOP NAVBAR -->
  <nav class="navbar navbar-expand navbar-light bg-white shadow-sm px-4" style="height:60px;">

    <!-- LEFT (optional title / breadcrumb) -->
    <div class="d-flex align-items-center">
      <span class="fw-semibold text-dark">
        <?= $page_title ?? 'Dashboard'; ?>
      </span>
    </div>

    <!-- RIGHT -->
    <ul class="navbar-nav ms-auto align-items-center">

      <!-- NOTIFICATION DOT (optional) -->
      <li class="nav-item me-3">
        <span class="position-relative d-inline-block">
          <i class="bi bi-bell fs-5"></i>
          <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
        </span>
      </li>

      <!-- USER DROPDOWN -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
          <img src="<?= base_url('assets/img/avatar.png'); ?>" width="32" height="32" class="rounded-circle">
          <span><?= $this->session->userdata('name'); ?></span>
        </a>

        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
          <li>
            <a class="dropdown-item" href="<?= site_url('change_password'); ?>">
              <i class="bi bi-key me-2"></i> Change Password
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="<?= site_url('logout'); ?>">
              <i class="bi bi-box-arrow-right me-2"></i> Logout
            </a>
          </li>
        </ul>
      </li>

    </ul>
  </nav>
  <div class="d-flex admin-shell">
    <aside class="sidebar text-white p-3 p-lg-4">
      <a href="<?= site_url('dashboard'); ?>" class="sidebar-brand mb-3 text-decoration-none">
        <div class="brand-title">UCO Exportindo Consulting</div>
        <div class="brand-subtitle">Export trading admin system</div>
      </a>

      <!-- <div class="user-chip mb-3">
        <strong><?= e(isset($u['nama']) ? $u['nama'] : 'Administrator'); ?></strong>
        <span><?= e(ucfirst(isset($u['role']) ? $u['role'] : 'admin')); ?> access panel</span>
      </div> -->

      <nav class="nav flex-column gap-1">
        <a class="nav-link <?= $nav_active(['dashboard']); ?>" href="<?= site_url('dashboard'); ?>">
          <i class="bi bi-grid-1x2-fill"></i>
          <span>Dashboard</span>
        </a>

        <div class="nav-section-title">Master Data</div>

        <!-- <a class="nav-link d-flex justify-content-between align-items-center"
          data-bs-toggle="collapse"
          href="#masterMenu"
          role="button"
          aria-expanded="<?= $master_menu_open ? 'true' : 'false'; ?>"
          aria-controls="masterMenu">
          <span><i class="bi bi-database"></i> Master Data</span>
          <i class="bi bi-chevron-down"></i>
        </a> -->
        <a class="nav-link d-flex justify-content-between align-items-center"
          data-bs-toggle="collapse"
          href="#masterMenu"
          role="button"
          aria-expanded="false"
          aria-controls="masterMenu">
          <span><i class="bi bi-database"></i> Master Data</span>
          <i class="bi bi-chevron-down"></i>
        </a>

        <div class="collapse <?= $master_menu_open ? 'show' : ''; ?>" id="masterMenu">

          <a class="nav-link ms-3 <?= $nav_active(['masters/products']); ?>" href="<?= site_url('masters/products'); ?>">
            <i class="bi bi-box-seam"></i>
            <span>Products</span>
          </a>

          <a class="nav-link ms-3 <?= $nav_active(['masters/customers']); ?>" href="<?= site_url('masters/customers'); ?>">
            <i class="bi bi-people"></i>
            <span>Customers</span>
          </a>

          <a class="nav-link ms-3 <?= $nav_active(['masters/suppliers']); ?>" href="<?= site_url('masters/suppliers'); ?>">
            <i class="bi bi-building"></i>
            <span>Suppliers</span>
          </a>

          <a class="nav-link ms-3 <?= $nav_active(['masters/uom']); ?>" href="<?= site_url('masters/uom'); ?>">
            <i class="bi bi-rulers"></i>
            <span>UOM</span>
          </a>

          <a class="nav-link ms-3 <?= $nav_active(['masters/currencies']); ?>" href="<?= site_url('masters/currencies'); ?>">
            <i class="bi bi-currency-exchange"></i>
            <span>Currencies</span>
          </a>

          <a class="nav-link ms-3 <?= $nav_active(['masters/incoterms']); ?>" href="<?= site_url('masters/incoterms'); ?>">
            <i class="bi bi-globe2"></i>
            <span>Incoterms</span>
          </a>

          <a class="nav-link ms-3 <?= $nav_active(['masters/payment_terms']); ?>" href="<?= site_url('masters/payment_terms'); ?>">
            <i class="bi bi-calendar-check"></i>
            <span>Payment Terms</span>
          </a>

          <a class="nav-link ms-3 <?= $nav_active(['masters/warehouses']); ?>" href="<?= site_url('masters/warehouses'); ?>">
            <i class="bi bi-house-door"></i>
            <span>Warehouses</span>
          </a>

          <a class="nav-link ms-3 <?= $nav_active(['settings/company']); ?>" href="<?= site_url('settings/company'); ?>">
            <i class="bi bi-bank"></i>
            <span>Company Profile</span>
          </a>

        </div>

        <div class="nav-section-title">Transactions</div>

        <a class="nav-link <?= $nav_active(['transactions/sales-orders']); ?>" href="<?= site_url('transactions/sales-orders'); ?>">
          <i class="bi bi-receipt"></i>
          <span>Sales Orders</span>
        </a>

        <a class="nav-link <?= $nav_active(['transactions/packing-lists']); ?>" href="<?= site_url('transactions/packing-lists'); ?>">
          <i class="bi bi-box2-heart"></i>
          <span>Packing Lists</span>
        </a>

        <a class="nav-link <?= $nav_active(['transactions/invoices']); ?>" href="<?= site_url('transactions/invoices'); ?>">
          <i class="bi bi-file-earmark-text"></i>
          <span>Invoices</span>
        </a>

        <div class="nav-section-title">Generate document</div>

        <a class="nav-link <?= $nav_active(['transactions/inquiries']); ?>" href="<?= site_url('transactions/inquiries'); ?>">
          <i class="bi bi-receipt"></i>
          <span>Inquiry</span>
        </a>

        <a class="nav-link <?= $nav_active(['transactions/manual-invoices']); ?>" href="<?= site_url('transactions/manual-invoices'); ?>">
          <i class="bi bi-file-earmark-text"></i>
          <span>Invoices</span>
        </a>

        <a class="nav-link <?= $nav_active(['fee-slips']); ?>" href="<?= site_url('fee-slips'); ?>">
          <i class="bi bi-cash-stack"></i>
          <span>Salary / Fee Slips</span>
        </a>

        <div class="nav-section-title">Inventory</div>

        <a class="nav-link <?= $nav_active(['inventory/stock']); ?>" href="<?= site_url('inventory/stock'); ?>">
          <i class="bi bi-bar-chart-steps"></i>
          <span>Stock Overview</span>
        </a>

        <a class="nav-link <?= $nav_active(['inventory/movements']); ?>" href="<?= site_url('inventory/movements'); ?>">
          <i class="bi bi-arrow-left-right"></i>
          <span>Stock Movements</span>
        </a>

        <div class="nav-section-title">Customer Communication</div>

        <a class="nav-link <?= $nav_active(['contact_messages']); ?>" href="<?= site_url('contact_messages'); ?>">
          <i class="bi bi-envelope-paper"></i>
          <span>Website Inquiries</span>
        </a>

        <div class="nav-section-title">System</div>

        <a class="nav-link <?= $nav_active(['masters/users']); ?>" href="<?= site_url('masters/users'); ?>">
          <i class="bi bi-person-badge"></i>
          <span>User Management</span>
        </a>

        <a class="nav-link" href="<?= site_url('logout'); ?>">
          <i class="bi bi-box-arrow-right"></i>
          <span>Logout</span>
        </a>
      </nav>
    </aside>

    <main class="flex-grow-1 main-area">
      <div class="topbar-panel d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
          <h1 class="h4"><?= e($page_title); ?></h1>
          <div class="subtext">UCO Exportindo admin workspace for export operations, documents, and stock monitoring.</div>
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