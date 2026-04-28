<?php
$s = $slip ?? [];
$cur = $s['currency_text'] ?: 'IDR';

if (!function_exists('mny')) {
    function mny($v)
    {
        return number_format((float)$v, 2, '.', ',');
    }
}
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title><?= e($s['slip_no'] ?? 'Fee Slip'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @page {
            size: A4;
            margin: 10mm;
        }

        body {
            background: #eef4fb;
            color: #0f172a;
            font-family: Arial, sans-serif;
            font-size: 13px;
        }

        .top-actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            margin-bottom: 10px;
        }

        .btn-print,
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
            border: 0;
            cursor: pointer;
        }

        .btn-print:hover,
        .btn-back:hover {
            background: #0b3278;
            color: #fff;
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
            border-radius: 24px 24px 0 0;
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
            background: #fff;
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

        .table thead th {
            background: #f8fafc;
            text-transform: uppercase;
            font-size: 12px;
            color: #475569;
            vertical-align: middle;
        }

        .desc-cell {
            white-space: normal;
        }

        .money-cell {
            white-space: nowrap;
            text-align: right;
            font-variant-numeric: tabular-nums;
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

        .summary-card .take-home {
            font-size: 15px;
            color: #0f3d91;
            font-weight: 800;
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
            margin-top: 18px;
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

        .sign-box {
            min-height: 70px;
            border-top: 1px dashed #94a3b8;
            padding-top: 10px;
            margin-top: 18px;
        }

        @media print {
            body {
                background: #fff;
            }

            .print-wrap {
                width: 210mm;
                min-height: auto;
                margin: 0 auto;
                border-radius: 0;
                box-shadow: none;
                overflow: visible !important;
            }

            .doc-head {
                border-radius: 0;
            }

            .content-wrap {
                padding: 24px;
            }

            .top-actions {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <div class="top-actions">
        <a href="<?= site_url('fee_slips'); ?>" class="btn-back">← Back</a>
        <button type="button" onclick="window.print()" class="btn-print">Print</button>
    </div>

    <div class="print-wrap">
        <div class="doc-head d-flex justify-content-between align-items-center gap-4">
            <div>
                <div class="doc-sub mb-2">Fee distribution document</div>
                <h2>FEE SLIP</h2>

                <div class="mt-3">
                    <strong>UCO Exportindo Consulting</strong>
                </div>

                <div class="doc-sub">
                    Perum Majapahit, Pungging – Mojokerto
                </div>
            </div>

            <div class="text-end">
                <div class="mini-label text-white-50">Slip No</div>
                <div class="fs-4 fw-bold"><?= e($s['slip_no'] ?? ''); ?></div>

                <div class="doc-sub mt-2">
                    Date: <?= format_date_id($s['slip_date'] ?? ''); ?>
                </div>
                <div class="doc-sub">
                    Period: <?= e($s['period_text'] ?? ''); ?>
                </div>
            </div>
        </div>

        <div class="content-wrap">
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="soft-box">
                        <div class="mini-label">Paid To</div>
                        <div class="fw-bold mb-1"><?= e($s['payee_name'] ?? ''); ?></div>
                        <div>Position: <?= e($s['position_text'] ?? '-'); ?></div>

                        <?php if (!empty($s['bank_account'])): ?>
                            <div class="mini-label mt-4">Bank Account</div>
                            <div><?= nl2br(e($s['bank_account'])); ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="soft-box">
                        <div class="mini-label">Payment Detail</div>
                        <div class="d-grid gap-2">
                            <div><strong>Payment Term:</strong> <?= e($s['payment_term'] ?? '-'); ?></div>
                            <div><strong>Currency:</strong> <?= e($cur); ?></div>
                            <div><strong>Document Type:</strong> Fee / Salary Slip</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive mb-4">
                <table class="table table-bordered align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Description</th>
                            <th class="money-cell" width="170">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td class="desc-cell"><?= nl2br(e($s['description'] ?? '')); ?></td>
                            <td class="money-cell fw-semibold"><?= e($cur); ?> <?= mny($s['gross_fee'] ?? 0); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="row g-4 align-items-start">
                <div class="col-md-6">
                    <div class="soft-box">
                        <div class="mini-label">Notes</div>
                        <div><?= !empty($s['notes']) ? nl2br(e($s['notes'])) : '-'; ?></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="soft-box summary-card">
                        <div class="mini-label">Income Summary</div>

                        <div class="summary-row">
                            <div class="label">Gross Fee</div>
                            <div class="value money">
                                <span class="cur"><?= e($cur); ?></span>
                                <span class="amt"><?= mny($s['gross_fee'] ?? 0); ?></span>
                            </div>
                        </div>

                        <div class="summary-row">
                            <div class="label">Capital Contribution</div>
                            <div class="value money">
                                <span class="cur"><?= e($cur); ?></span>
                                <span class="amt"><?= mny($s['capital_contribution'] ?? 0); ?></span>
                            </div>
                        </div>

                        <div class="summary-row">
                            <div class="label">Deduction</div>
                            <div class="value money">
                                <span class="cur"><?= e($cur); ?></span>
                                <span class="amt"><?= mny($s['deduction_amount'] ?? 0); ?></span>
                            </div>
                        </div>

                        <div class="summary-row">
                            <div class="label">Total Tax</div>
                            <div class="value money">
                                <span class="cur"><?= e($cur); ?></span>
                                <span class="amt"><?= mny($s['tax_amount'] ?? 0); ?></span>
                            </div>
                        </div>

                        <div class="summary-row">
                            <div class="label take-home">Take Home Pay</div>
                            <div class="value money take-home">
                                <span class="cur"><?= e($cur); ?></span>
                                <span class="amt"><?= mny($s['take_home_pay'] ?? 0); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-pair">
                    <div class="footer-item">
                        <div class="logo-wrap">
                            <img src="<?= base_url('assets/img/uco.png'); ?>" style="max-height:170px; max-width:100%;" alt="UCO Logo">
                        </div>
                    </div>

                    <div class="footer-item">
                        <div class="soft-box text-center">
                            <div class="mini-label">Received By</div>
                            <div style="height:40px;"></div>
                            <div class="sign-box">
                                <div class="fw-bold"><?= e($s['payee_name'] ?? ''); ?></div>
                                <div class="text-muted">Recipient</div>
                            </div>
                        </div>
                    </div>

                    <div class="footer-item">
                        <div class="soft-box text-center">
                            <div class="mini-label">Approved By</div>
                            <div style="height:40px;"></div>
                            <div class="sign-box">
                                <div class="fw-bold">UCO Exportindo Consulting</div>
                                <div class="text-muted">Authorized Signature</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function () {
            setTimeout(function () {
                window.print();
            }, 300);
        };
    </script>
</body>

</html>
