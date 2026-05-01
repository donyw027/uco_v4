<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - UCO Exportindo Consulting</title>
    <link rel="icon" href="<?= base_url('assets/img/favicon.png'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css2/app.css'); ?>" rel="stylesheet">
</head>

<body class="login-page d-flex align-items-center">
    <div class="container py-5">
        <div class="row justify-content-center align-items-center g-4">

            <div class="col-lg-5 d-none d-lg-block">
                <div class="login-side h-100">
                    <div class="login-badge mb-4">
                        <i class="bi bi-briefcase-fill"></i> UCO Exportindo Consulting Operation Panel
                    </div>

                    <h1 class="display-6 fw-bold mb-3">
                        Welcome back to UCO Exportindo Consulting
                    </h1>

                    <p class="mb-4 text-white-50">
                        Access the integrated system to manage commercial proposals, service offers, manual inquiries, invoices, export documentation, and business operations in one professional workspace.
                    </p>

                    <div class="d-grid gap-3">

                        <div class="metric-mini bg-transparent border border-light-subtle text-white">
                            <div>
                                <div class="label text-white-50">Module Access</div>
                                <div class="big text-white">
                                    Inquiry / Invoice / SO / PL / Inventory
                                </div>
                            </div>
                            <i class="bi bi-folder-check fs-4"></i>
                        </div>

                        <div class="metric-mini bg-transparent border border-light-subtle text-white">
                            <div>
                                <div class="label text-white-50">Business Scope</div>
                                <div class="big text-white">
                                    Export Supply, Consulting & Trade Services
                                </div>
                            </div>
                            <i class="bi bi-globe-asia-australia fs-4"></i>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-8 col-lg-5">
                <div class="card login-card">
                    <div class="card-body p-4 p-lg-5">
                        <div class="mb-4 text-center">
                            <div class="badge-soft badge-soft-primary mb-3">
                                <i class="bi bi-lock-fill me-1"></i> Secure admin access
                            </div>

                            <h4 class="mb-2">Admin Login</h4>
                            <p class="text-muted mb-0">
                                Sign in to access the operational dashboard.
                            </p>
                        </div>

                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger"><?= e($this->session->flashdata('error')); ?></div>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success"><?= e($this->session->flashdata('success')); ?></div>
                        <?php endif; ?>

                        <form method="post">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <button class="btn btn-dark w-100">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login
                            </button>
                        </form>

                        <div class="text-center mt-4">
                            <a href="<?= site_url(); ?>" class="btn btn-outline-secondary w-100">Back to Website</a>
                        </div>

                        <div class="text-center text-muted small mt-3">
                            UCO Exportindo Consulting Admin Panel
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>