<div class="section-block">
    <div class="section-head">
        <div>
            <h3>Stock overview</h3>
            <p>Tampilan stok dibuat lebih bersih untuk memantau ketersediaan barang per warehouse.</p>
        </div>
    </div>
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="get" class="row g-3 align-items-end">
                <div class="col-md-4"><label class="form-label">Warehouse</label><select name="warehouse_id" class="form-select"><?php foreach ($warehouses as $w): ?><option value="<?= e($w['id']); ?>" <?= $warehouse_id === (int)$w['id'] ? 'selected' : ''; ?>><?= e($w['warehouse_name']); ?></option><?php endforeach; ?></select></div>
                <div class="col-md-2"><button class="btn btn-dark">Filter</button></div>
            </form>
        </div>
    </div>
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <strong>Current stock by product</strong>
                <div class="text-muted small">Produk dengan stok rendah akan ditandai merah.</div>
            </div>
            <span class="badge-soft badge-soft-warning">Low stock ≤ 100</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm mb-0">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Product</th>
                            <th>UOM</th>
                            <th class="text-end">Current Stock</th>
                        </tr>
                    </thead>
                    <tbody><?php if (!$rows): ?><tr><td colspan="4" class="empty-state">Belum ada data stok.</td></tr><?php endif; ?><?php foreach ($rows as $row): ?><tr>
                        <td><?= e($row['code']); ?></td>
                        <td><?= e($row['product_name']); ?></td>
                        <td><?= e($row['uom_name']); ?></td>
                        <td class="text-end <?= ((float)$row['stock']) <= 100 ? 'text-danger fw-bold' : 'fw-semibold'; ?>"><?= format_money($row['stock'], 2); ?></td>
                    </tr><?php endforeach; ?></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
