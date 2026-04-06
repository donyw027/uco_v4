<?php if (!$so): ?>
<div class="alert alert-warning">Data Sales Order tidak ditemukan.</div>
<?php return; endif; ?>
<?php $status_class = $so['status'] === 'SHIPPED' ? 'success' : ($so['status'] === 'CONFIRMED' ? 'primary' : 'secondary'); ?>
<div class="row g-4 mb-3 align-items-start">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-3">
                    <div>
                        <div class="small text-uppercase text-muted fw-semibold">Sales Order</div>
                        <h4 class="mb-1"><?= e($so['so_no']); ?></h4>
                        <div class="text-muted">Tanggal order <?= format_date_id($so['order_date']); ?></div>
                    </div>
                    <span class="badge-soft badge-soft-<?= $status_class; ?>"><?= e($so['status']); ?></span>
                </div>
                <div class="row g-3">
                    <div class="col-md-6"><div class="info-pair"><span>Customer</span><strong><?= e($so['company_name']); ?></strong></div></div>
                    <div class="col-md-6"><div class="info-pair"><span>Warehouse</span><strong><?= e($so['warehouse_name']); ?></strong></div></div>
                    <div class="col-md-6"><div class="info-pair"><span>Currency</span><strong><?= e($so['currency_code']); ?></strong></div></div>
                    <div class="col-md-6"><div class="info-pair"><span>Destination Port</span><strong><?= e($so['destination_port'] ?: '-'); ?></strong></div></div>
                    <div class="col-12"><div class="info-pair"><span>Remarks</span><strong><?= e($so['remarks'] ?: '-'); ?></strong></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="small text-uppercase text-muted fw-semibold mb-2">Order summary</div>
                <div class="metric-mini mb-3"><div><div class="label">Total Items</div><div class="big"><?= is_array($items) ? count($items) : 0; ?></div></div><i class="bi bi-list-check fs-4 text-primary"></i></div>
                <div class="metric-mini"><div><div class="label">Total Amount</div><div class="big" style="font-size:1.3rem;"><?= format_money($so['total_amount']); ?></div></div><i class="bi bi-cash-stack fs-4 text-success"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-sm align-middle mb-0">
        <thead>
            <tr>
                <th width="60">No</th>
                <th>Product</th>
                <th>Description</th>
                <th class="text-end">Qty</th>
                <th class="text-end">Unit Price</th>
                <th class="text-end">Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!$items): ?>
                <tr><td colspan="6" class="empty-state">Belum ada item di sales order ini.</td></tr>
            <?php else: $no = 1; foreach ($items as $it): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td class="fw-semibold"><?= e($it['product_name']); ?></td>
                    <td><?= e($it['description']); ?></td>
                    <td class="text-end"><?= e($it['qty']); ?></td>
                    <td class="text-end"><?= format_money($it['unit_price']); ?></td>
                    <td class="text-end fw-semibold"><?= format_money($it['amount']); ?></td>
                </tr>
            <?php endforeach; endif; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" class="text-end">Grand Total</th>
                <th class="text-end"><?= format_money($so['total_amount']); ?></th>
            </tr>
        </tfoot>
    </table>
</div>
