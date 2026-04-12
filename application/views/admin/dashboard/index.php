<?php
$total_so = (int)($stats['sales_orders'] ?? 0);
$draft = (int)($status_breakdown['DRAFT'] ?? 0);
$confirmed = (int)($status_breakdown['CONFIRMED'] ?? 0);
$shipped = (int)($status_breakdown['SHIPPED'] ?? 0);
$draft_pct = $total_so ? round(($draft / $total_so) * 100) : 0;
$confirmed_pct = $total_so ? round(($confirmed / $total_so) * 100) : 0;
$shipped_pct = $total_so ? round(($shipped / $total_so) * 100) : 0;
?>

<div class="section-block">
    <div class="section-head">
        <div>
            <h3>Overview</h3>
            <p>Quick summary of sales activity, invoicing, inventory, and export operations.</p>
        </div>
    </div>

    <div class="row g-3 kpi-grid">
        <div class="col-md-6 col-xl-3">
            <div class="card card-stat h-100">
                <div class="card-body">
                    <div class="stat-label">Sales Orders</div>
                    <div class="stat-value"><?= e($stats['sales_orders'] ?? 0); ?></div>
                    <div class="stat-note">Total sales orders recorded in the system</div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card card-stat h-100">
                <div class="card-body">
                    <div class="stat-label">Monthly Revenue</div>
                    <div class="stat-value"><?= format_money($monthly_revenue ?? 0); ?></div>
                    <div class="stat-note">Accumulated invoice value for the current month</div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card card-stat h-100">
                <div class="card-body">
                    <div class="stat-label">Shipped Orders</div>
                    <div class="stat-value"><?= e($stats['shipped_so'] ?? 0); ?></div>
                    <div class="stat-note">Orders that have been processed for shipment</div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card card-stat h-100">
                <div class="card-body">
                    <div class="stat-label">Stock Items</div>
                    <div class="stat-value"><?= e($stats['stock_items'] ?? 0); ?></div>
                    <div class="stat-note">Products currently available in stock</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 section-block">
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <strong>Sales Pipeline Status</strong>
                    <div class="text-muted small">Monitor order progress from draft to shipped.</div>
                </div>
                <span class="badge-soft badge-soft-success">Yearly Revenue <?= format_money($yearly_revenue ?? 0); ?></span>
            </div>

            <div class="card-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="metric-mini">
                            <div>
                                <div class="label">Draft</div>
                                <div class="big"><?= e($draft); ?></div>
                            </div>
                            <span class="badge-soft badge-soft-secondary"><?= $draft_pct; ?>%</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="metric-mini">
                            <div>
                                <div class="label">Confirmed</div>
                                <div class="big"><?= e($confirmed); ?></div>
                            </div>
                            <span class="badge-soft badge-soft-primary"><?= $confirmed_pct; ?>%</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="metric-mini">
                            <div>
                                <div class="label">Shipped</div>
                                <div class="big"><?= e($shipped); ?></div>
                            </div>
                            <span class="badge-soft badge-soft-success"><?= $shipped_pct; ?>%</span>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="fw-semibold">Draft Orders</span>
                        <span class="text-muted small"><?= $draft; ?> item</span>
                    </div>
                    <div class="progress-slim">
                        <div class="progress-bar bg-secondary" style="width: <?= $draft_pct; ?>%"></div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="fw-semibold">Confirmed Orders</span>
                        <span class="text-muted small"><?= $confirmed; ?> item</span>
                    </div>
                    <div class="progress-slim">
                        <div class="progress-bar bg-primary" style="width: <?= $confirmed_pct; ?>%"></div>
                    </div>
                </div>

                <div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="fw-semibold">Shipped Orders</span>
                        <span class="text-muted small"><?= $shipped; ?> item</span>
                    </div>
                    <div class="progress-slim">
                        <div class="progress-bar bg-success" style="width: <?= $shipped_pct; ?>%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header">
                <strong>Operational Snapshot</strong>
                <div class="text-muted small">Key numbers for export and warehouse activity.</div>
            </div>

            <div class="card-body d-grid gap-3">
                <div class="metric-mini">
                    <div>
                        <div class="label">Packing Lists</div>
                        <div class="big"><?= e($operational_summary['packing_lists'] ?? 0); ?></div>
                    </div>
                    <i class="bi bi-box2-heart fs-4 text-primary"></i>
                </div>

                <div class="metric-mini">
                    <div>
                        <div class="label">Invoices</div>
                        <div class="big"><?= e($operational_summary['invoices'] ?? 0); ?></div>
                    </div>
                    <i class="bi bi-file-earmark-text fs-4 text-success"></i>
                </div>

                <div class="metric-mini">
                    <div>
                        <div class="label">Stock Movements</div>
                        <div class="big"><?= e($operational_summary['movements'] ?? 0); ?></div>
                    </div>
                    <i class="bi bi-arrow-left-right fs-4 text-warning"></i>
                </div>

                <div class="metric-mini">
                    <div>
                        <div class="label">Warehouses</div>
                        <div class="big"><?= e($operational_summary['warehouses'] ?? 0); ?></div>
                    </div>
                    <i class="bi bi-house-door fs-4 text-danger"></i>
                </div>

                <div class="quick-note mt-2">
                    <h6>Operational Insight</h6>
                    <p>This dashboard helps users monitor core sales, export, and inventory activities in a more structured and professional layout.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 section-block">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <strong>Recent Sales Orders</strong>
                    <div class="text-muted small">Latest orders for quick monitoring.</div>
                </div>
                <a href="<?= site_url('transactions/sales-orders'); ?>" class="btn btn-sm btn-dark">Open Module</a>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr>
                                <th>SO No</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Status</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!$recent_so): ?>
                                <tr>
                                    <td colspan="5" class="empty-state">No sales orders available yet.</td>
                                </tr>
                                <?php else: foreach ($recent_so as $r): ?>
                                    <?php
                                    $status_class = $r['status'] === 'SHIPPED' ? 'success' : ($r['status'] === 'CONFIRMED' ? 'primary' : 'secondary');
                                    ?>
                                    <tr>
                                        <td><strong><?= e($r['so_no']); ?></strong></td>
                                        <td><?= format_date_id($r['order_date']); ?></td>
                                        <td><?= e($r['company_name']); ?></td>
                                        <td><span class="badge-soft badge-soft-<?= $status_class; ?>"><?= e($r['status']); ?></span></td>
                                        <td class="text-end fw-semibold"><?= format_money($r['total_amount']); ?></td>
                                    </tr>
                            <?php endforeach;
                            endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <strong>Low Stock Alert</strong>
                    <div class="text-muted small">Products that should be reviewed by the warehouse team.</div>
                </div>
                <a href="<?= site_url('inventory/stock'); ?>" class="btn btn-sm btn-outline-secondary">Check Stock</a>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Product</th>
                                <th class="text-end">Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!$low_stock): ?>
                                <tr>
                                    <td colspan="3" class="empty-state">All stock levels are safe.</td>
                                </tr>
                                <?php else: foreach ($low_stock as $r): ?>
                                    <tr>
                                        <td><?= e($r['code']); ?></td>
                                        <td><?= e($r['product_name']); ?></td>
                                        <td class="text-end text-danger fw-semibold"><?= format_money($r['stock'], 2); ?> <?= e($r['uom_name']); ?></td>
                                    </tr>
                            <?php endforeach;
                            endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>