<?php
$edit = isset($edit) && is_array($edit) ? $edit : null;
function fv($key, $default = '')
{
    global $edit;
    return e($edit[$key] ?? $default);
}
?>
<div class="section-block">
    <div class="section-head">
        <div>
            <h3>Salary / Fee Slip Generator</h3>
            <p>CRUD slip gaji atau fee distribution, lalu print seperti dokumen invoice.</p>
        </div>
        <div class="badge-soft badge-soft-primary">Fee Distribution Document</div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="mb-1"><?= $edit ? 'Edit Slip' : 'Create Slip'; ?></h5>
            <form method="post">
                <?php if ($edit): ?><input type="hidden" name="id" value="<?= e($edit['id']); ?>"><?php endif; ?>
                <div class="row g-3">
                    <div class="col-md-3"><label class="form-label">Slip No</label><input name="slip_no" class="form-control" value="<?= fv('slip_no'); ?>" placeholder="Auto generate if empty"></div>
                    <div class="col-md-3"><label class="form-label">Slip Date</label><input type="date" name="slip_date" class="form-control" value="<?= fv('slip_date', date('Y-m-d')); ?>"></div>
                    <div class="col-md-3"><label class="form-label">Period</label><input name="period_text" class="form-control" value="<?= fv('period_text', 'April 2026'); ?>"></div>
                    <div class="col-md-3"><label class="form-label">Currency</label><input name="currency_text" class="form-control" value="<?= fv('currency_text', 'IDR'); ?>"></div>
                    <div class="col-md-4"><label class="form-label">Paid To</label><input name="payee_name" class="form-control" value="<?= fv('payee_name'); ?>" required></div>
                    <div class="col-md-4"><label class="form-label">Position</label><input name="position_text" class="form-control" value="<?= fv('position_text'); ?>"></div>
                    <div class="col-md-4"><label class="form-label">Bank Account</label><input name="bank_account" class="form-control" value="<?= fv('bank_account'); ?>" placeholder="Mandiri - 1550012457803"></div>
                    <div class="col-md-4"><label class="form-label">Payment Term</label><input name="payment_term" class="form-control" value="<?= fv('payment_term', 'Monthly Fee Distribution'); ?>"></div>
                    <div class="col-md-2"><label class="form-label">Gross Fee</label><input type="number" step="0.01" name="gross_fee" class="form-control calc" value="<?= fv('gross_fee', '0'); ?>"></div>
                    <div class="col-md-2"><label class="form-label">Capital Contribution</label><input type="number" step="0.01" name="capital_contribution" class="form-control calc" value="<?= fv('capital_contribution', '0'); ?>"></div>
                    <div class="col-md-2"><label class="form-label">Deduction</label><input type="number" step="0.01" name="deduction_amount" class="form-control calc" value="<?= fv('deduction_amount', '0'); ?>"></div>
                    <div class="col-md-2"><label class="form-label">Tax</label><input type="number" step="0.01" name="tax_amount" class="form-control calc" value="<?= fv('tax_amount', '0'); ?>"></div>
                    <div class="col-md-6"><label class="form-label">Description</label><textarea name="description" rows="4" class="form-control" required><?= fv('description', 'Fee distribution for consulting service related to:'); ?></textarea></div>
                    <div class="col-md-6"><label class="form-label">Notes</label><textarea name="notes" rows="4" class="form-control"><?= fv('notes', 'Deduction is allocated as initial capital contribution based on mutual agreement.'); ?></textarea></div>
                </div>
                <div class="alert alert-light border mt-3 mb-0"><strong>Take Home Pay: </strong><span id="take-home-preview">0.00</span></div>
                <div class="admin-form-actions mt-3">
                    <button class="btn btn-dark" name="submit_action" value="save">Save</button>
                    <button class="btn btn-success" name="submit_action" value="save_print">Save + Print</button>

                    <button type="submit" name="submit_action" value="print_only" class="btn btn-info">
                        <i class="fa fa-print"></i> Print Only
                    </button>

                    <?php if ($edit): ?><a class="btn btn-outline-secondary" href="<?= site_url('fee-slips'); ?>">Cancel Edit</a><?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="section-block">
    <div class="section-head">
        <div>
            <h3>Saved Slip List</h3>
            <p>Data slip yang sudah disimpan.</p>
        </div>
    </div>
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Slip No</th>
                            <th>Date</th>
                            <th>Paid To</th>
                            <th class="text-end">Take Home Pay</th>
                            <th class="action-cell">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($rows)): ?><tr>
                                <td colspan="5" class="empty-state">No salary slips yet.</td>
                            </tr><?php else: foreach ($rows as $row): ?>
                                <tr>
                                    <td class="fw-semibold"><?= e($row['slip_no']); ?></td>
                                    <td><?= format_date_id($row['slip_date']); ?></td>
                                    <td><?= e($row['payee_name']); ?></td>
                                    <td class="text-end fw-semibold"><?= e($row['currency_text']); ?> <?= format_money($row['take_home_pay']); ?></td>
                                    <td class="action-cell">
                                        <div class="table-action-group">
                                            <a class="btn btn-sm btn-outline-primary" href="<?= site_url('fee-slips?edit=' . $row['id']); ?>">Edit</a>
                                            <a class="btn btn-sm btn-success" target="_blank" href="<?= site_url('fee-slips/print/' . $row['id']); ?>">Print</a>
                                            <a class="btn btn-sm btn-danger" onclick="return confirm('Delete this slip?')" href="<?= site_url('fee-slips/delete/' . $row['id']); ?>">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                        <?php endforeach;
                                endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function calcTHP() {
        let v = n => parseFloat(document.querySelector('[name="' + n + '"]').value || 0);
        let t = v('gross_fee') - v('capital_contribution') - v('deduction_amount') - v('tax_amount');
        document.getElementById('take-home-preview').innerText = t.toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }
    document.querySelectorAll('.calc').forEach(e => e.addEventListener('input', calcTHP));
    calcTHP();
</script>