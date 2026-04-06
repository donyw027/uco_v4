<div class="section-block">
    <div class="section-head">
        <div>
            <h3>Invoice management</h3>
            <p>Kelola invoice hasil generate dari sales order agar lebih siap diprint dan dikirim ke buyer.</p>
        </div>
        <span class="badge-soft badge-soft-success"><?= is_array($rows) ? count($rows) : 0; ?> invoice</span>
    </div>

    <?php if ($edit): ?>
    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <strong>Edit invoice</strong>
                <div class="text-muted small">Update tanggal invoice atau tambahkan notes sebelum dikirim ke customer.</div>
            </div>
            <span class="badge-soft badge-soft-warning">Edit mode</span>
        </div>
        <div class="card-body">
            <form method="post">
                <input type="hidden" name="id" value="<?= e($edit['id']); ?>">
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label">Invoice Date</label><input type="date" name="invoice_date" class="form-control" value="<?= e($edit['invoice_date']); ?>"></div>
                    <div class="col-12"><label class="form-label">Notes</label><textarea name="notes" class="form-control"><?= e($edit['notes']); ?></textarea></div>
                </div>
                <div class="d-flex flex-wrap gap-2 mt-3">
                    <button class="btn btn-dark">Update Invoice</button>
                    <a href="<?= site_url('transactions/invoices'); ?>" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-header">
            <strong>Invoice directory</strong>
            <div class="text-muted small">Tampilan invoice list dibuat lebih bersih agar nominal dan buyer lebih cepat dibaca.</div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Invoice No</th>
                            <th>Date</th>
                            <th>SO No</th>
                            <th>Customer</th>
                            <th class="text-end">Total</th>
                            <th width="210">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!$rows): ?>
                            <tr><td colspan="6" class="empty-state">Belum ada data invoice.</td></tr>
                        <?php else: foreach ($rows as $row): ?>
                            <tr>
                                <td class="fw-semibold"><?= e($row['invoice_no']); ?></td>
                                <td><?= format_date_id($row['invoice_date']); ?></td>
                                <td><?= e($row['so_no']); ?></td>
                                <td><?= e($row['company_name']); ?></td>
                                <td class="text-end fw-semibold"><?= format_money($row['total_amount']); ?></td>
                                <td>
                                    <div class="table-action-group">
                                        <a href="<?= site_url('transactions/invoices?edit=' . $row['id']); ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <a href="<?= site_url('transactions/print-invoice/' . $row['id']); ?>" target="_blank" class="btn btn-sm btn-success">Print</a>
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
