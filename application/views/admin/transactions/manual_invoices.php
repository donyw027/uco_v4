<?php
$edit = isset($edit) && is_array($edit) ? $edit : null;
$GLOBALS['edit'] = $edit;
$items = !empty($edit_items) ? $edit_items : [[ 'description'=>'', 'qty'=>1, 'unit'=>'', 'unit_price'=>0 ]];
function ef($k, $d = '') {
    $currentEdit = $GLOBALS['edit'] ?? null;
    return e(is_array($currentEdit) ? ($currentEdit[$k] ?? $d) : $d);
}
?>
<div class="section-block"><div class="section-head"><div><h3>Manual Invoice Management</h3><p>Create, edit, save, and print manual invoices.</p></div><div class="badge-soft badge-soft-primary">Manual Consulting Invoice</div></div>
<div class="card shadow-sm mb-4"><div class="card-body"><h5 class="mb-1"><?= $edit ? 'Edit Manual Invoice' : 'Create Manual Invoice'; ?></h5>
<form method="post"><?php if($edit): ?><input type="hidden" name="id" value="<?= e($edit['id']); ?>"><?php endif; ?>
<div class="row g-3">
<div class="col-md-3"><label class="form-label">Invoice No</label><input type="text" name="invoice_no" class="form-control" value="<?= ef('invoice_no'); ?>" placeholder="Auto generate if empty"></div>
<div class="col-md-3"><label class="form-label">Invoice Date</label><input type="date" name="invoice_date" class="form-control" value="<?= ef('invoice_date', date('Y-m-d')); ?>" required></div>
<div class="col-md-3"><label class="form-label">Currency</label><select name="currency_id" class="form-select" required><option value="">- select currency -</option><?php foreach ($currencies as $c): ?><option value="<?= e($c['id']); ?>" <?= ((string)($edit['currency_id'] ?? '') === (string)$c['id']) ? 'selected' : ''; ?>><?= e($c['currency_code']); ?></option><?php endforeach; ?></select></div>
<div class="col-md-3"><label class="form-label">PIC Name</label><input type="text" name="pic_name" class="form-control" value="<?= ef('pic_name'); ?>"></div>
<div class="col-md-6"><label class="form-label">Customer Name</label><input type="text" name="customer_name" class="form-control" value="<?= ef('customer_name'); ?>" required></div>
<div class="col-md-3"><label class="form-label">Incoterm</label><input type="text" name="incoterm_text" class="form-control" value="<?= ef('incoterm_text'); ?>"></div>
<div class="col-md-3"><label class="form-label">Payment Term</label><input type="text" name="payment_term_text" class="form-control" value="<?= ef('payment_term_text'); ?>"></div>
<div class="col-md-8"><label class="form-label">Customer Address</label><textarea name="customer_address" class="form-control" rows="3"><?= ef('customer_address'); ?></textarea></div>
<div class="col-md-4"><label class="form-label">Country</label><input type="text" name="customer_country" class="form-control" value="<?= ef('customer_country'); ?>"></div>
<div class="col-md-6"><label class="form-label">Subject</label><input type="text" name="subject" class="form-control" value="<?= ef('subject'); ?>"></div>
<div class="col-md-2"><label class="form-label">PPN (%)</label><input type="number" step="0.01" min="0" name="ppn_percent" id="ppn_percent" class="form-control" value="<?= ef('ppn_percent','11'); ?>"></div>
<div class="col-md-2"><label class="form-label">PPH (%) <small class="text-muted">dikurangi</small></label><input type="number" step="0.01" min="0" name="pph_percent" id="pph_percent" class="form-control" value="<?= ef('pph_percent','2'); ?>"></div>
<div class="col-md-2"><label class="form-label">Paid Amount</label><input type="number" step="0.01" min="0" name="paid_amount" class="form-control" value="<?= ef('paid_amount','0'); ?>"></div>
</div>
<div class="table-responsive mt-4"><table class="table table-sm align-middle" id="manual-items-table"><thead><tr><th>Description</th><th width="90">Qty</th><th width="90">Unit</th><th width="140">Unit Price</th><th width="140">Amount</th><th width="60"></th></tr></thead><tbody>
<?php foreach($items as $it): ?><tr><td><input type="text" name="description[]" class="form-control" value="<?= e($it['description'] ?? ''); ?>" required></td><td><input type="number" step="0.01" min="0" name="qty[]" class="form-control qty-input" value="<?= e($it['qty'] ?? 1); ?>"></td><td><input type="text" name="unit[]" class="form-control" value="<?= e($it['unit'] ?? ''); ?>"></td><td><input type="number" step="0.01" min="0" name="unit_price[]" class="form-control price-input" value="<?= e($it['unit_price'] ?? 0); ?>"></td><td><input type="text" class="form-control item-amount" readonly></td><td><button type="button" class="btn btn-sm btn-danger btn-remove-row">&times;</button></td></tr><?php endforeach; ?>
</tbody><tfoot><tr><th colspan="4" class="text-end">Grand Total (Subtotal + PPN - PPH)</th><th><input type="text" class="form-control" id="grand-total" readonly></th><th></th></tr></tfoot></table></div>
<div class="row g-3 mt-1"><div class="col-12"><label class="form-label">Notes</label><textarea name="notes" class="form-control" rows="4"><?= ef('notes'); ?></textarea></div></div>
<div class="admin-form-actions mt-3"><button type="button" class="btn btn-outline-secondary btn-sm" id="add-row">+ Add Item</button>
<?php if($edit): ?><button type="submit" name="submit_action" value="update" class="btn btn-dark">Update</button><button type="submit" name="submit_action" value="update_print" class="btn btn-success">Update + Print</button><a href="<?= site_url('transactions/manual-invoices'); ?>" class="btn btn-outline-secondary">Cancel</a><?php else: ?><button type="submit" name="submit_action" value="save_print" class="btn btn-dark">Save + Print</button><button type="submit" name="submit_action" value="print_only" class="btn btn-success" formtarget="_blank">Print Only</button><?php endif; ?></div>
</form></div></div></div>
<div class="section-block"><div class="section-head"><div><h3>Saved Manual Invoice List</h3><p>Invoices saved from this form.</p></div></div><div class="card shadow-sm"><div class="card-body p-0"><div class="table-responsive"><table class="table table-sm mb-0 align-middle"><thead><tr><th>Invoice No</th><th>Date</th><th>Customer</th><th class="text-end">Total</th><th class="action-cell">Action</th></tr></thead><tbody><?php if(!$rows): ?><tr><td colspan="5" class="empty-state">No manual invoices yet.</td></tr><?php else: foreach($rows as $row): ?><tr><td class="fw-semibold"><?= e($row['invoice_no']); ?></td><td><?= format_date_id($row['invoice_date']); ?></td><td><?= e($row['customer_name']); ?></td><td class="text-end fw-semibold"><?= format_money($row['total_amount']); ?></td><td class="action-cell"><div class="table-action-group"><a href="<?= site_url('transactions/manual-invoices?edit='.$row['id']); ?>" class="btn btn-sm btn-outline-primary">Edit</a> <a href="<?= site_url('transactions/print-manual-invoice/'.$row['id']); ?>" target="_blank" class="btn btn-sm btn-success">Print</a> <a href="<?= site_url('transactions/delete-manual-invoice/'.$row['id']); ?>" onclick="return confirm('Delete this invoice?')" class="btn btn-sm btn-danger">Delete</a></div></td></tr><?php endforeach; endif; ?></tbody></table></div></div></div></div>
<script>(function(){
function n(v){v=parseFloat(v);return isNaN(v)?0:v}
function rowCalc(r){let q=n(r.querySelector('.qty-input').value),p=n(r.querySelector('.price-input').value);let amt=q*p;r.querySelector('.item-amount').value=amt.toFixed(2);total()}
function total(){let sub=0;document.querySelectorAll('.item-amount').forEach(e=>sub+=n(e.value));let ppn=n(document.getElementById('ppn_percent')?.value||0),pph=n(document.getElementById('pph_percent')?.value||0);let grand=sub+(sub*ppn/100)-(sub*pph/100);document.getElementById('grand-total').value=grand.toFixed(2)}
function bind(r){r.querySelectorAll('.qty-input,.price-input').forEach(i=>i.addEventListener('input',()=>rowCalc(r)));r.querySelector('.btn-remove-row').addEventListener('click',()=>{if(document.querySelectorAll('#manual-items-table tbody tr').length>1){r.remove();total()}});rowCalc(r)}
document.querySelectorAll('#manual-items-table tbody tr').forEach(bind);
document.getElementById('ppn_percent')?.addEventListener('input',total);
document.getElementById('pph_percent')?.addEventListener('input',total);
document.getElementById('add-row').addEventListener('click',()=>{let tb=document.querySelector('#manual-items-table tbody'),r=tb.querySelector('tr').cloneNode(true);r.querySelectorAll('input').forEach(i=>{i.value=(i.name==='qty[]')?'1':(i.classList.contains('item-amount')?'0.00':'')});tb.appendChild(r);bind(r)});
})();</script>
