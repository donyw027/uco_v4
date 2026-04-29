<?php
$edit = isset($edit) && is_array($edit) ? $edit : null;
$GLOBALS['edit'] = $edit;
$items = !empty($edit_items) ? $edit_items : [[
    'description' => 'Used Cooking Oil Supply / Export Documentation Assistance',
    'agency' => 'Supplier / Customs / Related Authority',
    'duration_text' => 'To be confirmed',
    'amount' => 0
]];
function qf($k, $d = '') {
    $currentEdit = $GLOBALS['edit'] ?? null;
    return e(is_array($currentEdit) ? ($currentEdit[$k] ?? $d) : $d);
}
function selected_qf($k, $v, $d = '') {
    $currentEdit = $GLOBALS['edit'] ?? null;
    $cur = is_array($currentEdit) ? ($currentEdit[$k] ?? $d) : $d;
    return ((string)$cur === (string)$v) ? 'selected' : '';
}
$docTypeLabels = [
    'commercial_proposal' => 'Commercial Proposal',
    'business_proposal'   => 'Business Proposal',
    'quotation'           => 'Quotation',
    'service_offer'       => 'Service Offer',
];
$offerTypeLabels = [
    'product'         => 'Product / Goods',
    'service'         => 'Service / Consulting',
    'product_service' => 'Product + Service',
];
?>
<div class="section-block">
    <div class="section-head">
        <div>
            <h3>Commercial Document</h3>
            <p>Create flexible offers for product export, consulting service, or both.</p>
        </div>
        <div class="badge-soft badge-soft-primary">Proposal / Quotation / Service Offer</div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="mb-1"><?= $edit ? 'Edit Commercial Document' : 'Create Commercial Document'; ?></h5>
            <p class="text-muted small mb-3">Pilih jenis dokumen dan jenis penawaran, nanti judul serta label print akan menyesuaikan.</p>

            <form method="post">
                <?php if ($edit): ?><input type="hidden" name="id" value="<?= e($edit['id']); ?>"><?php endif; ?>

                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Document Type</label>
                        <select name="document_type" id="document_type" class="form-select">
                            <?php foreach ($docTypeLabels as $key => $label): ?>
                                <option value="<?= e($key); ?>" <?= selected_qf('document_type', $key, 'commercial_proposal'); ?>><?= e($label); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Offer Type</label>
                        <select name="offer_type" id="offer_type" class="form-select">
                            <?php foreach ($offerTypeLabels as $key => $label): ?>
                                <option value="<?= e($key); ?>" <?= selected_qf('offer_type', $key, 'product_service'); ?>><?= e($label); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Document No</label>
                        <input type="text" name="proposal_no" class="form-control" value="<?= qf('proposal_no'); ?>" placeholder="Auto if empty">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="proposal_date" class="form-control" value="<?= qf('proposal_date', date('Y-m-d')); ?>" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Currency</label>
                        <input type="text" name="currency_text" class="form-control" value="<?= qf('currency_text', 'IDR'); ?>" placeholder="IDR / USD">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">PPN (%)</label>
                        <input type="number" step="0.01" name="ppn_percent" id="ppn_percent" class="form-control" value="<?= qf('ppn_percent', '11'); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">PPH (%) <small class="text-muted">dikurangi</small></label>
                        <input type="number" step="0.01" name="pph_percent" id="pph_percent" class="form-control" value="<?= qf('pph_percent', '2'); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Show Summary</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" role="switch" id="show_summary" name="show_summary" value="1" <?= !isset($edit['show_summary']) || (int)($edit['show_summary'] ?? 1) === 1 ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="show_summary">ON / OFF</label>
                        </div>
                        <small class="text-muted">Matikan jika tidak ingin menampilkan summary di print.</small>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Validity Offer</label>
                        <input type="text" name="validity_offer" class="form-control" value="<?= qf('validity_offer', '7 days from issued date'); ?>" placeholder="e.g. 7 days">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Lead Time / Timeline</label>
                        <input type="text" name="lead_time" class="form-control" value="<?= qf('lead_time', 'To be confirmed'); ?>" placeholder="e.g. 14 working days">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Attention / PIC</label>
                        <input type="text" name="recipient_pic" class="form-control" value="<?= qf('recipient_pic'); ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Client / Recipient Company</label>
                        <input type="text" name="recipient_company" class="form-control" value="<?= qf('recipient_company'); ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Subject / Offer Title</label>
                        <input type="text" name="subject" id="subject" class="form-control" value="<?= qf('subject', 'Commercial Offer for Product Supply & Consulting Service'); ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Recipient Address</label>
                        <textarea name="recipient_address" class="form-control" rows="3"><?= qf('recipient_address'); ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Scope of Work / Offer Scope</label>
                        <textarea name="scope_of_work" id="scope_of_work" class="form-control" rows="3" placeholder="Ringkasan scope barang/jasa yang ditawarkan"><?= qf('scope_of_work', 'Product supply, sourcing support, export/import consultation, documentation assistance, and coordination based on client requirements.'); ?></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Opening Text</label>
                        <textarea name="opening_text" id="opening_text" class="form-control" rows="3"><?= qf('opening_text', 'Thank you for your interest in our products and services. We are pleased to submit this offer for your review and consideration.'); ?></textarea>
                    </div>
                </div>

                <div class="table-responsive mt-4">
                    <table class="table table-sm align-middle" id="manual-inquiry-items-table">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th width="220" id="agency-head">Agency / Scope</th>
                                <th width="150" id="duration-head">Duration / Lead Time</th>
                                <th width="170">Amount</th>
                                <th width="70">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $it): ?>
                                <tr>
                                    <td><textarea name="description[]" class="form-control" rows="2"><?= e($it['description'] ?? ''); ?></textarea></td>
                                    <td><input type="text" name="agency[]" class="form-control" value="<?= e($it['agency'] ?? ''); ?>"></td>
                                    <td><input type="text" name="duration_text[]" class="form-control" value="<?= e($it['duration_text'] ?? ''); ?>"></td>
                                    <td><input type="number" step="0.01" name="amount[]" class="form-control inquiry-amount" value="<?= e($it['amount'] ?? 0); ?>"></td>
                                    <td><button type="button" class="btn btn-sm btn-outline-danger remove-row">×</button></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Grand Total (Subtotal + PPN - PPH)</th>
                                <th><input type="text" class="form-control" id="inquiry-grand-total" readonly></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <label class="form-label">Terms / Commercial Terms</label>
                        <textarea name="terms_text" id="terms_text" class="form-control" rows="5"><?= qf('terms_text', "• Price is subject to final scope, quantity, and destination confirmation.\n• Payment term will be agreed before project execution or shipment.\n• Banking charges, tax, customs duties, and third-party fees are excluded unless stated otherwise."); ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Closing Text</label>
                        <textarea name="closing_text" class="form-control" rows="5"><?= qf('closing_text', 'We hope this offer meets your requirements. Please feel free to contact us for further discussion or adjustment.'); ?></textarea>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2 align-items-center mt-3">
                    <button type="button" class="btn btn-outline-secondary btn-sm" id="add-inquiry-row">+ Add Item</button>
                    <?php if ($edit): ?>
                        <button type="submit" name="submit_action" value="update" class="btn btn-dark">Update</button>
                        <button type="submit" name="submit_action" value="update_print" class="btn btn-success">Update + Print</button>
                        <a href="<?= site_url('transactions/inquiries'); ?>" class="btn btn-outline-secondary">Cancel</a>
                    <?php else: ?>
                        <button type="submit" name="submit_action" value="save_print" class="btn btn-dark">Save + Print</button>
                        <button type="submit" name="submit_action" value="print_only" class="btn btn-success" formtarget="_blank">Print Only</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="section-block">
    <div class="section-head">
        <div>
            <h3>Saved Commercial Documents</h3>
            <p>Saved proposals, quotations, and service offers.</p>
        </div>
    </div>
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Doc No</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Recipient</th>
                            <th>Subject</th>
                            <th width="240">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($rows)): ?>
                            <tr><td colspan="6" class="empty-state">No documents yet.</td></tr>
                        <?php else: foreach ($rows as $row): ?>
                            <tr>
                                <td class="fw-semibold"><?= e($row['proposal_no']); ?></td>
                                <td><?= format_date_id($row['proposal_date']); ?></td>
                                <td><span class="badge-soft badge-soft-primary"><?= e($docTypeLabels[$row['document_type'] ?? 'commercial_proposal'] ?? 'Commercial Proposal'); ?></span></td>
                                <td><?= e($row['recipient_company']); ?></td>
                                <td><?= e($row['subject']); ?></td>
                                <td>
                                    <div class="d-inline-flex flex-nowrap gap-1 action-buttons">
                                        <a href="<?= site_url('transactions/inquiries?edit=' . $row['id']); ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <a href="<?= site_url('transactions/print-manual-inquiry/' . $row['id']); ?>" target="_blank" class="btn btn-sm btn-success">Print</a>
                                        <a href="<?= site_url('transactions/delete-manual-inquiry/' . $row['id']); ?>" onclick="return confirm('Delete this document?')" class="btn btn-sm btn-danger">Delete</a>
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

<script>
function fmt(n){return parseFloat(n||0).toLocaleString('en-US',{minimumFractionDigits:2,maximumFractionDigits:2})}
function total(){
    let subtotal=0;
    document.querySelectorAll('.inquiry-amount').forEach(e=>subtotal+=parseFloat(e.value||0));
    let ppn=parseFloat(document.getElementById('ppn_percent')?.value||0);
    let pph=parseFloat(document.getElementById('pph_percent')?.value||0);
    let grand=subtotal+(subtotal*ppn/100)-(subtotal*pph/100);
    document.getElementById('inquiry-grand-total').value=fmt(grand);
}
function bind(r){
    r.querySelector('.inquiry-amount').addEventListener('input',total);
    r.querySelector('.remove-row').addEventListener('click',()=>{if(document.querySelectorAll('#manual-inquiry-items-table tbody tr').length>1){r.remove();total()}});
}
document.getElementById('ppn_percent')?.addEventListener('input',total);
document.getElementById('pph_percent')?.addEventListener('input',total);
document.querySelectorAll('#manual-inquiry-items-table tbody tr').forEach(bind);total();
document.getElementById('add-inquiry-row').addEventListener('click',()=>{let tb=document.querySelector('#manual-inquiry-items-table tbody'),r=tb.querySelector('tr').cloneNode(true);r.querySelectorAll('input,textarea').forEach(i=>i.value=(i.name==='amount[]')?'0':'');tb.appendChild(r);bind(r);total()});
function applyOfferType(){
    const offer = document.getElementById('offer_type').value;
    const agencyHead = document.getElementById('agency-head');
    const durationHead = document.getElementById('duration-head');
    if(offer === 'product'){
        agencyHead.innerText = 'Origin / Specification';
        durationHead.innerText = 'Lead Time';
    } else if(offer === 'service'){
        agencyHead.innerText = 'Scope / Agency';
        durationHead.innerText = 'Timeline';
    } else {
        agencyHead.innerText = 'Scope / Specification';
        durationHead.innerText = 'Duration / Lead Time';
    }
}
document.getElementById('offer_type').addEventListener('change', applyOfferType);applyOfferType();
</script>
