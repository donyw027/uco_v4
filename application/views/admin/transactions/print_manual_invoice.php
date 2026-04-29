<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Manual Commercial Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .money-cell {
            white-space: nowrap;
            text-align: right;
            font-variant-numeric: tabular-nums;
        }

        .desc-cell {
            white-space: normal;
        }

        .table {
            page-break-inside: auto;
            font-size: 13px;
        }

        .table tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        .table thead {
            display: table-header-group;
        }

        .table tfoot {
            display: table-footer-group;
        }

        @media print {
            .print-wrap {
                width: 210mm;
                min-height: auto;
                margin: 0 auto;
                border-radius: 0;
                box-shadow: none;
                overflow: visible !important;
            }

            .content-wrap {
                padding: 24px;
            }

            .top-actions {
                display: none !important;
            }

            body {
                background: #fff;
            }
        }

        .top-actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            margin-bottom: 10px;
        }

        .btn-back {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 8px;
            background: #0f3d91;
            color: #fff;
            text-decoration: none;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .02em;
        }

        .btn-back:hover {
            background: #0b3278;
            color: #fff;
        }

        body {
            background: #eef4fb;
            color: #0f172a;
        }

        .print-wrap {
            max-width: 980px;
            margin: 24px auto;
            background: #fff;
            border-radius: 24px;
            overflow: visible;
            box-shadow: 0 18px 40px rgba(15, 23, 42, .08);
        }

        .doc-head {
            background: linear-gradient(135deg, #081121, #103b86);
            color: #fff;
            padding: 24px 34px 18px;
            line-height: 1.4;
        }

        .doc-head h2 {
            margin: 0;
            font-weight: 800;
            letter-spacing: .02em;
        }

        .doc-sub {
            color: rgba(255, 255, 255, .72);
        }

        .content-wrap {
            padding: 28px 34px;
        }

        .mini-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: #64748b;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .soft-box {
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            padding: 16px 18px;
            height: 100%;
        }

        .table thead th {
            background: #f8fafc;
            text-transform: uppercase;
            font-size: 12px;
            color: #475569;
        }

        .table tfoot th,
        .table tfoot td {
            background: #f8fafc;
        }

        .summary-card .summary-row {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            padding: 8px 0;
            border-bottom: 1px dashed #cbd5e1;
            font-size: 13px;
            font-weight: 700;
        }

        .summary-card .summary-row:last-child {
            border-bottom: 0;
        }

        .summary-card .label {
            color: #475569;
            font-weight: 600;
        }

        .summary-card .value {
            text-align: right;
            font-weight: 600;
            color: #0f172a;
            white-space: nowrap;
        }

        .money {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            font-variant-numeric: tabular-nums;
        }

        .money .cur {
            min-width: 36px;
            text-align: left;
            color: #475569;
        }

        .money .amt {
            min-width: 120px;
            text-align: right;
        }

        .footer-pair {
            display: flex;
            gap: 16px;
            align-items: flex-end;
            margin-top: 12px;
        }

        .footer-pair .footer-item {
            flex: 1;
        }

        .logo-wrap {
            min-height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .signature-box-wrap {
            height: auto !important;
            min-height: unset !important;
        }

        .sign-box {
            min-height: 70px;
            border-top: 1px dashed #94a3b8;
            padding-top: 10px;
            margin-top: 18px;
        }

        .sign-box {
            min-height: 70px;
            border-top: 1px dashed #94a3b8;
            padding-top: 10px;
            margin-top: 18px;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="print-wrap">
        <div class="doc-head d-flex justify-content-between align-items-center gap-4">

            <div class="top-actions">
                <a href="<?= site_url('transactions/manual-invoices'); ?>" class="btn-back">
                    ← Back to Manual Invoice
                </a>
            </div>

            <div class="d-flex align-items-start gap-3">
                <div>
                    <div class="doc-sub mb-2">Commercial consulting document</div>
                    <h2>COMMERCIAL INVOICE</h2>

                    <div class="mt-3">
                        <strong><?= e($company['company_name'] ?? 'UCO Exportindo Consulting'); ?></strong>
                    </div>

                    <div class="doc-sub">
                        <?= nl2br(e($company['address'] ?? '')); ?>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <div class="mini-label text-white-50">Invoice No</div>
                <div class="fs-4 fw-bold"><?= e($inv['invoice_no'] ?? ''); ?></div>

                <div class="doc-sub mt-2">
                    Date: <?= format_date_id($inv['invoice_date'] ?? ''); ?>
                </div>

                <?php if (!empty($inv['subject'])): ?>
                    <div class="doc-sub"><?= e($inv['subject']); ?></div>
                <?php endif; ?>
            </div>

        </div>

        <div class="content-wrap">
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="soft-box">
                        <div class="mini-label">Bill To</div>
                        <div class="fw-bold mb-1"><?= e($inv['customer_name'] ?? ''); ?></div>
                        <?php if (!empty($inv['pic_name'])): ?>
                            <div>Attn: <?= e($inv['pic_name']); ?></div>
                        <?php endif; ?>
                        <div><?= nl2br(e($inv['customer_address'] ?? '')); ?></div>
                        <div><?= e($inv['customer_country'] ?? ''); ?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="soft-box">
                        <div class="mini-label">Commercial Terms</div>
                        <div class="d-grid gap-2">
                            <div><strong>Payment Term:</strong> <?= e($inv['payment_term_text'] ?? '-'); ?></div>
                            <div><strong>Incoterm:</strong> <?= e($inv['incoterm_text'] ?? '-'); ?></div>
                            <div><strong>Currency:</strong> <?= e($inv['currency_code'] ?? '-'); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            $currencyCode = $inv['currency_code'] ?? '';
            $subtotalAmount = 0;
            $showQtyUnit = false;
            foreach ($items as $it) {
                $qty = (float)($it['qty'] ?? 0);
                $unit = trim((string)($it['unit'] ?? ''));
                $unitPrice = (float)($it['unit_price'] ?? 0);
                $subtotalAmount += $qty * $unitPrice;
                if ($unit !== '' || $qty != 1) {
                    $showQtyUnit = true;
                }
            }
            if ($subtotalAmount <= 0) {
                $subtotalAmount = (float)($inv['subtotal_amount'] ?? 0);
            }
            $ppnPercent = isset($inv['ppn_percent']) ? (float)$inv['ppn_percent'] : (($subtotalAmount > 0) ? (((float)($inv['total_tax_amount'] ?? 0) / $subtotalAmount) * 100) : 0);
            $pphPercent = isset($inv['pph_percent']) ? (float)$inv['pph_percent'] : (($subtotalAmount > 0) ? (((float)($inv['total_discount_amount'] ?? 0) / $subtotalAmount) * 100) : 0);
            $totalTaxAmount = $subtotalAmount * ($ppnPercent / 100);
            $totalDiscountAmount = $subtotalAmount * ($pphPercent / 100);
            $grandTotal = $subtotalAmount + $totalTaxAmount - $totalDiscountAmount;
            $paidAmount = (float)($inv['paid_amount'] ?? 0);
            $balanceAmount = $grandTotal - $paidAmount;
            $fmtPercent = function($v) { return rtrim(rtrim(number_format((float)$v, 2, '.', ''), '0'), '.'); };
            ?>
            <div class="table-responsive mb-4">
                <table class="table table-bordered align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Description</th>

                            <?php if ($showQtyUnit): ?>
                                <th class="money-cell" width="85">Qty</th>
                                <th width="80">Unit</th>
                                <th class="money-cell" width="130">Unit Price</th>
                            <?php else: ?>
                                <th class="money-cell" width="130">Unit Price</th>
                            <?php endif; ?>

                            <th class="money-cell fw-semibold" width="145">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($items)): ?>
                            <?php $no = 1;
                            foreach ($items as $it): ?>
                                <?php
                                $qty = (float)($it['qty'] ?? 0);
                                $unit = trim((string)($it['unit'] ?? ''));
                                $unitPrice = (float)($it['unit_price'] ?? 0);
                                $lineAmount = $qty * $unitPrice;
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td class="desc-cell"><?= e($it['description'] ?? ''); ?></td>
                                    <?php if ($showQtyUnit): ?>
                                        <td class="text-end"><?= $qty == 0 ? '' : rtrim(rtrim(number_format($qty, 2, '.', ','), '0'), '.'); ?></td>
                                        <td><?= e($unit); ?></td>
                                        <td class="text-end"><?= e($currencyCode); ?> <?= format_money($unitPrice); ?></td>
                                    <?php else: ?>
                                        <td class="text-end"><?= e($currencyCode); ?> <?= format_money($unitPrice); ?></td>
                                    <?php endif; ?>
                                    <td class="text-end fw-semibold"><?= e($currencyCode); ?> <?= format_money($lineAmount); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="<?= 3 + ($showQtyUnit ? 2 : 0); ?>" class="text-center text-muted">
                                    No item data.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="row g-4 align-items-start">
                <div class="col-md-6">
                    <div class="soft-box">
                        <div class="mini-label">Bank Information</div>
                        <div><?= nl2br(e($company['bank_info'] ?? '-')); ?></div>

                        <?php if (!empty($inv['notes'])): ?>
                            <div class="mini-label mt-4">Notes</div>
                            <div><?= nl2br(e($inv['notes'])); ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="soft-box summary-card">
                        <div class="mini-label">Invoice Summary</div>

                        <div class="summary-row">
                            <div class="label">Subtotal</div>
                            <div class="value money">
                                <span class="cur"><?= e($currencyCode); ?></span>
                                <span class="amt"><?= format_money($subtotalAmount); ?></span>
                            </div>
                        </div>

                        <div class="summary-row">
                            <div class="label">PPN <?= $fmtPercent($ppnPercent); ?>%</div>
                            <div class="value money">
                                <span class="cur"><?= e($currencyCode); ?></span>
                                <span class="amt"><?= format_money($totalTaxAmount); ?></span>
                            </div>
                        </div>

                        <div class="summary-row">
                            <div class="label">PPH <?= $fmtPercent($pphPercent); ?>%</div>
                            <div class="value money">
                                <span class="cur"><?= e($currencyCode); ?></span>
                                <span class="amt"><?= format_money($totalDiscountAmount); ?></span>
                            </div>
                        </div>
                        <div class="summary-row">
                            <div class="label">Grand Total</div>
                            <div class="value money">
                                <span class="cur"><?= e($currencyCode); ?></span>
                                <span class="amt"><?= format_money($grandTotal); ?></span>
                            </div>
                        </div>

                        <div class="summary-row">
                            <div class="label">Paid Amount</div>
                            <div class="value money">
                                <span class="cur"><?= e($currencyCode); ?></span>
                                <span class="amt"><?= format_money($paidAmount); ?></span>
                            </div>
                        </div>

                        <div class="summary-row">
                            <div class="label">Balance Due</div>
                            <div class="value money">
                                <span class="cur"><?= e($currencyCode); ?></span>
                                <span class="amt"><?= format_money($balanceAmount); ?></span>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="footer-pair">
                    <div class="footer-item">
                        <div class="logo-wrap">
                            <img src="<?= base_url('assets/img/uco.png'); ?>" style="max-height:170px; max-width:100%;">
                        </div>
                    </div>

                    <div class="footer-item">
                        <div class="soft-box text-center signature-box-wrap">
                            <div class="mini-label">Authorized Signature</div>
                            <div style="height:40px;"></div>
                            <div class="sign-box">
                                <div class="fw-bold"><?= e($company['signature_name'] ?? ''); ?></div>
                                <div class="text-muted"><?= e($company['signature_title'] ?? ''); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>