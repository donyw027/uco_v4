<div class="section-block">
    <div class="section-head">
        <div>
            <h3>Packing list management</h3>
            <p>Kelola hasil generate packing list, cek paket, berat, dan volume agar dokumen shipment lebih rapi.</p>
        </div>
        <span class="badge-soft badge-soft-primary"><?= is_array($rows) ? count($rows) : 0; ?> packing list</span>
    </div>

    <?php if ($edit): ?>
    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <strong>Edit packing list</strong>
                <div class="text-muted small">Koreksi data totals jika perlu penyesuaian sebelum dokumen diprint.</div>
            </div>
            <span class="badge-soft badge-soft-warning">Edit mode</span>
        </div>
        <div class="card-body">
            <form method="post">
                <input type="hidden" name="id" value="<?= e($edit['id']); ?>">
                <div class="row g-3">
                    <div class="col-md-3"><label class="form-label">PL Date</label><input type="date" name="pl_date" class="form-control" value="<?= e($edit['pl_date']); ?>"></div>
                    <div class="col-md-3"><label class="form-label">Total Packages</label><input type="number" step="0.01" name="total_packages" class="form-control" value="<?= e($edit['total_packages']); ?>"></div>
                    <div class="col-md-2"><label class="form-label">Gross Weight</label><input type="number" step="0.01" name="gross_weight" class="form-control" value="<?= e($edit['gross_weight']); ?>"></div>
                    <div class="col-md-2"><label class="form-label">Net Weight</label><input type="number" step="0.01" name="net_weight" class="form-control" value="<?= e($edit['net_weight']); ?>"></div>
                    <div class="col-md-2"><label class="form-label">CBM</label><input type="number" step="0.0001" name="cbm" class="form-control" value="<?= e($edit['cbm']); ?>"></div>
                    <div class="col-12"><label class="form-label">Marks & Numbers</label><textarea name="marks_numbers" class="form-control"><?= e($edit['marks_numbers']); ?></textarea></div>
                </div>
                <div class="d-flex flex-wrap gap-2 mt-3">
                    <button class="btn btn-dark">Update Packing List</button>
                    <a href="<?= site_url('transactions/packing-lists'); ?>" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-header">
            <strong>Packing list directory</strong>
            <div class="text-muted small">Tabel dibuat lebih clean supaya gampang dibaca oleh admin shipping atau owner.</div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>PL No</th>
                            <th>Date</th>
                            <th>SO No</th>
                            <th>Customer</th>
                            <th class="text-end">Packages</th>
                            <th class="text-end">GW</th>
                            <th class="text-end">NW</th>
                            <th class="text-end">CBM</th>
                            <th class="action-cell">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!$rows): ?>
                            <tr><td colspan="9" class="empty-state">Belum ada data packing list.</td></tr>
                        <?php else: foreach ($rows as $row): ?>
                            <tr>
                                <td class="fw-semibold"><?= e($row['pl_no']); ?></td>
                                <td><?= format_date_id($row['pl_date']); ?></td>
                                <td><?= e($row['so_no']); ?></td>
                                <td><?= e($row['company_name']); ?></td>
                                <td class="text-end"><?= number_format((float)$row['total_packages'], 2); ?></td>
                                <td class="text-end"><?= number_format((float)$row['gross_weight'], 2); ?></td>
                                <td class="text-end"><?= number_format((float)$row['net_weight'], 2); ?></td>
                                <td class="text-end"><?= number_format((float)$row['cbm'], 4); ?></td>
                                <td class="action-cell">
                                    <div class="table-action-group">
                                        <a href="<?= site_url('transactions/packing-lists?edit=' . $row['id']); ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <a href="<?= site_url('transactions/print-packing-list/' . $row['id']); ?>" target="_blank" class="btn btn-sm btn-primary">Print</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
