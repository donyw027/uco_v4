<div class="section-block">
    <div class="section-head">
        <div>
            <h3>Stock movement control</h3>
            <p>Input movement lebih mudah dibaca dan histori perpindahan stok tetap cepat dipantau.</p>
        </div>
    </div>
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-4 align-items-start">
                <div class="col-lg-8">
                    <h5 class="mb-1">Create Stock Movement</h5>
                    <div class="text-muted small mb-3">Gunakan untuk stock in, stock out, atau adjustment manual.</div>
                </div>
                <div class="col-lg-4">
                    <div class="quick-note">
                        <h6>Catatan</h6>
                        <p>Module ini penting untuk menjaga data stock overview tetap akurat.</p>
                    </div>
                </div>
            </div>
            <form method="post">
                <div class="row g-3">
                    <div class="col-md-2"><label class="form-label">Date</label><input type="date" name="movement_date" class="form-control" value="<?= date('Y-m-d'); ?>"></div>
                    <div class="col-md-2"><label class="form-label">Type</label><select name="movement_type" class="form-select">
                            <option value="IN">Stock In</option>
                            <option value="OUT">Stock Out</option>
                            <option value="ADJUSTMENT">Adjustment (+)</option>
                        </select></div>
                    <div class="col-md-3"><label class="form-label">Warehouse</label><select name="warehouse_id" class="form-select" required><?php foreach ($warehouses as $w): ?><option value="<?= e($w['id']); ?>"><?= e($w['warehouse_name']); ?></option><?php endforeach; ?></select></div>
                    <div class="col-md-3"><label class="form-label">Product</label><select name="product_id" class="form-select" required><?php foreach ($products as $p): ?><option value="<?= e($p['id']); ?>"><?= e($p['product_name']); ?> (<?= e($p['uom_name']); ?>)</option><?php endforeach; ?></select></div>
                    <div class="col-md-2"><label class="form-label">Qty</label><input type="number" step="0.01" name="qty" class="form-control" required></div>
                    <div class="col-md-4"><label class="form-label">Reference No</label><input type="text" name="reference_no" class="form-control"></div>
                    <div class="col-md-6"><label class="form-label">Notes</label><input type="text" name="notes" class="form-control"></div>
                    <div class="col-md-2 d-grid"><label class="form-label">&nbsp;</label><button class="btn btn-dark">Save</button></div>
                </div>
            </form>
        </div>
    </div>
    <div class="card shadow-sm">
        <div class="card-header"><strong>Movement history</strong>
            <div class="text-muted small">Riwayat transaksi stock terbaru.</div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm mb-0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Warehouse</th>
                            <th>Product</th>
                            <th>Type</th>
                            <th class="text-end">In</th>
                            <th class="text-end">Out</th>
                            <th class="text-end">Balance</th>
                            <th>Reference</th>
                        </tr>
                    </thead>
                    <tbody><?php if (!$rows): ?><tr>
                                <td colspan="8" class="empty-state">Belum ada data movement.</td>
                            </tr><?php endif; ?><?php foreach ($rows as $row): ?><tr>
                                <td><?= format_datetime_id($row['movement_date']); ?></td>
                                <td><?= e($row['warehouse_name']); ?></td>
                                <td><?= e($row['product_name']); ?></td>
                                <td><?= e($row['movement_type']); ?></td>
                                <td class="text-end text-success fw-semibold"><?= format_money($row['qty_in'], 2); ?></td>
                                <td class="text-end text-danger fw-semibold"><?= format_money($row['qty_out'], 2); ?></td>
                                <td class="text-end fw-semibold"><?= format_money(isset($row['balance']) ? $row['balance'] : 0, 2); ?></td>
                                <td><?= e($row['reference_no']); ?></td>
                            </tr><?php endforeach; ?></tbody>
                </table>
            </div>
        </div>
    </div>
</div>