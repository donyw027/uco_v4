<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Commercial Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{background:#eef4fb;color:#0f172a}
        .print-wrap{max-width:980px;margin:24px auto;background:#fff;border-radius:24px;overflow:hidden;box-shadow:0 18px 40px rgba(15,23,42,.08)}
        .doc-head{background:linear-gradient(135deg,#081121,#103b86);color:#fff;padding:28px 34px}
        .doc-head h2{margin:0;font-weight:800;letter-spacing:.02em}
        .doc-sub{color:rgba(255,255,255,.72)}
        .content-wrap{padding:28px 34px}
        .mini-label{font-size:12px;text-transform:uppercase;letter-spacing:.08em;color:#64748b;font-weight:700;margin-bottom:6px}
        .soft-box{border:1px solid #e2e8f0;border-radius:18px;padding:16px 18px;height:100%}
        .table thead th{background:#f8fafc;text-transform:uppercase;font-size:12px;color:#475569}
        .sign-box{min-height:110px;border-top:1px dashed #94a3b8;padding-top:14px;margin-top:46px}
        @media print{body{background:#fff}.print-wrap{box-shadow:none;margin:0;max-width:none;border-radius:0}}
    </style>
</head>
<body onload="window.print()">
<div class="print-wrap">
    <div class="doc-head d-flex justify-content-between align-items-start gap-4">
        <div>
            <div class="doc-sub mb-2">Commercial export document</div>
            <h2>COMMERCIAL INVOICE</h2>
            <div class="mt-3"><strong><?= e($company['company_name'] ?? 'UCO Exportindo Consulting'); ?></strong></div>
            <div class="doc-sub"><?= nl2br(e($company['address'] ?? '')); ?></div>
        </div>
        <div class="text-end">
            <div class="mini-label text-white-50">Invoice No</div>
            <div class="fs-4 fw-bold"><?= e($inv['invoice_no'] ?? ''); ?></div>
            <div class="doc-sub mt-2">Date: <?= format_date_id($inv['invoice_date'] ?? ''); ?></div>
            <div class="doc-sub">Ref SO: <?= e($inv['so_no'] ?? ''); ?></div>
        </div>
    </div>

    <div class="content-wrap">
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="soft-box">
                    <div class="mini-label">Bill To</div>
                    <div class="fw-bold mb-1"><?= e($inv['company_name'] ?? ''); ?></div>
                    <div><?= nl2br(e($inv['address'] ?? '')); ?></div>
                    <div><?= e($inv['country'] ?? ''); ?></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="soft-box">
                    <div class="mini-label">Commercial Terms</div>
                    <div class="d-grid gap-2">
                        <div><strong>Payment Term:</strong> <?= e($inv['term_name'] ?? '-'); ?></div>
                        <div><strong>Incoterm:</strong> <?= e($inv['incoterm_code'] ?? '-'); ?></div>
                        <div><strong>Currency:</strong> <?= e($inv['currency_code'] ?? '-'); ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive mb-4">
            <table class="table table-bordered align-middle mb-0">
                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th>Description</th>
                        <th class="text-end" width="120">Qty</th>
                        <th class="text-end" width="160">Unit Price</th>
                        <th class="text-end" width="170">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($items as $it): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= e($it['product_name']); ?><?= $it['description'] ? ' - ' . e($it['description']) : ''; ?></td>
                        <td class="text-end"><?= e($it['qty']); ?></td>
                        <td class="text-end"><?= format_money($it['unit_price']); ?></td>
                        <td class="text-end fw-semibold"><?= format_money($it['amount']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-end">TOTAL (<?= e($inv['currency_code'] ?? ''); ?>)</th>
                        <th class="text-end"><?= format_money($inv['total_amount'] ?? 0); ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="row g-4 align-items-start">
            <div class="col-md-7">
                <div class="soft-box">
                    <div class="mini-label">Bank Information</div>
                    <div><?= nl2br(e($company['bank_info'] ?? '-')); ?></div>
                    <?php if (!empty($inv['notes'])): ?>
                    <div class="mini-label mt-4">Notes</div>
                    <div><?= nl2br(e($inv['notes'])); ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-5">
                <div class="soft-box text-center h-100 d-flex flex-column justify-content-end">
                    <div class="mini-label">Authorized Signature</div>
                    <div class="sign-box">
                        <div class="fw-bold"><?= e($company['signature_name'] ?? ''); ?></div>
                        <div class="text-muted"><?= e($company['signature_title'] ?? ''); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
