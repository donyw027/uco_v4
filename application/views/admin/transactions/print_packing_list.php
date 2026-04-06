<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Packing List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{background:#eef4fb;color:#0f172a}
        .print-wrap{max-width:1020px;margin:24px auto;background:#fff;border-radius:24px;overflow:hidden;box-shadow:0 18px 40px rgba(15,23,42,.08)}
        .doc-head{background:linear-gradient(135deg,#081121,#0ea5e9);color:#fff;padding:28px 34px}
        .doc-head h2{margin:0;font-weight:800;letter-spacing:.02em}
        .doc-sub{color:rgba(255,255,255,.76)}
        .content-wrap{padding:28px 34px}
        .mini-label{font-size:12px;text-transform:uppercase;letter-spacing:.08em;color:#64748b;font-weight:700;margin-bottom:6px}
        .soft-box{border:1px solid #e2e8f0;border-radius:18px;padding:16px 18px;height:100%}
        .table thead th{background:#f8fafc;text-transform:uppercase;font-size:12px;color:#475569}
        @media print{body{background:#fff}.print-wrap{box-shadow:none;margin:0;max-width:none;border-radius:0}}
    </style>
</head>
<body onload="window.print()">
<div class="print-wrap">
    <div class="doc-head d-flex justify-content-between align-items-start gap-4">
        <div>
            <div class="doc-sub mb-2">Shipping support document</div>
            <h2>PACKING LIST</h2>
            <div class="mt-3"><strong><?= e($company['company_name'] ?? 'UCO Trading Solution'); ?></strong></div>
            <div class="doc-sub"><?= nl2br(e($company['address'] ?? '')); ?></div>
        </div>
        <div class="text-end">
            <div class="mini-label text-white-50">Packing List No</div>
            <div class="fs-4 fw-bold"><?= e($pl['pl_no'] ?? ''); ?></div>
            <div class="doc-sub mt-2">Date: <?= format_date_id($pl['pl_date'] ?? ''); ?></div>
            <div class="doc-sub">Ref SO: <?= e($pl['so_no'] ?? ''); ?></div>
        </div>
    </div>

    <div class="content-wrap">
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="soft-box">
                    <div class="mini-label">Buyer</div>
                    <div class="fw-bold mb-1"><?= e($pl['company_name'] ?? ''); ?></div>
                    <div><?= nl2br(e($pl['address'] ?? '')); ?></div>
                    <div><?= e($pl['country'] ?? ''); ?></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="soft-box">
                    <div class="mini-label">Order Reference</div>
                    <div><strong>SO No:</strong> <?= e($pl['so_no'] ?? '-'); ?></div>
                    <div><strong>Order Date:</strong> <?= format_date_id($pl['order_date'] ?? ''); ?></div>
                    <div><strong>Marks & Numbers:</strong> <?= e($pl['marks_numbers'] ?: '-'); ?></div>
                </div>
            </div>
        </div>

        <div class="table-responsive mb-4">
            <table class="table table-bordered align-middle mb-0">
                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th>Description</th>
                        <th class="text-end" width="110">Qty</th>
                        <th class="text-end" width="120">Packages</th>
                        <th class="text-end" width="120">NW</th>
                        <th class="text-end" width="120">GW</th>
                        <th class="text-end" width="120">CBM</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($items as $it): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= e($it['product_name']); ?><?= $it['description'] ? ' - ' . e($it['description']) : ''; ?></td>
                        <td class="text-end"><?= e($it['qty']); ?></td>
                        <td class="text-end"><?= number_format((float)($it['package_count'] ?? 0), 2); ?></td>
                        <td class="text-end"><?= number_format((float)($it['net_weight'] ?? 0), 2); ?></td>
                        <td class="text-end"><?= number_format((float)($it['gross_weight'] ?? 0), 2); ?></td>
                        <td class="text-end"><?= number_format((float)($it['cbm'] ?? 0), 4); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="soft-box">
                    <div class="mini-label">Marks & Numbers</div>
                    <div><?= nl2br(e($pl['marks_numbers'] ?? '-')); ?></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="soft-box p-0 overflow-hidden">
                    <table class="table table-sm mb-0">
                        <tr><th class="ps-3">Total Packages</th><td class="text-end pe-3"><?= number_format((float)($pl['total_packages'] ?? 0), 2); ?></td></tr>
                        <tr><th class="ps-3">Net Weight</th><td class="text-end pe-3"><?= number_format((float)($pl['net_weight'] ?? 0), 2); ?></td></tr>
                        <tr><th class="ps-3">Gross Weight</th><td class="text-end pe-3"><?= number_format((float)($pl['gross_weight'] ?? 0), 2); ?></td></tr>
                        <tr><th class="ps-3">CBM</th><td class="text-end pe-3"><?= number_format((float)($pl['cbm'] ?? 0), 4); ?></td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
