<?php
$company_name    = $company['company_name'] ?? 'Your Company';
$company_address = $company['address'] ?? '';
$company_phone   = $company['phone'] ?? '';
$company_email   = $company['email'] ?? '';
$company_website = $company['website'] ?? '';
$company_bank    = $company['bank_name'] ?? '';
$company_account = $company['bank_account'] ?? '';
$company_swift   = $company['swift_code'] ?? '';
$company_holder  = $company['account_name'] ?? '';

$currencyCode = $inv['currency_code'] ?? '';
$invoiceNo    = $inv['invoice_no'] ?? '-';
$invoiceDate  = $inv['invoice_date'] ?? date('Y-m-d');

$customerName    = $inv['customer_name'] ?? '';
$customerAddress = $inv['customer_address'] ?? '';
$customerCountry = $inv['customer_country'] ?? '';
$picName         = $inv['pic_name'] ?? '';
$subject         = $inv['subject'] ?? '';
$incoterm        = $inv['incoterm_text'] ?? '';
$paymentTerm     = $inv['payment_term_text'] ?? '';
$notes           = $inv['notes'] ?? '';

$subtotalAmount      = (float)($inv['subtotal_amount'] ?? 0);
$totalDiscountAmount = (float)($inv['total_discount_amount'] ?? 0);
$totalTaxAmount      = (float)($inv['total_tax_amount'] ?? 0);
$paidAmount          = (float)($inv['paid_amount'] ?? 0);
$grandTotal          = (float)($inv['total_amount'] ?? 0);
$balanceAmount       = (float)($inv['balance_amount'] ?? ($grandTotal - $paidAmount));

if (!function_exists('manual_money')) {
    function manual_money($amount)
    {
        return number_format((float)$amount, 2);
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Print Manual Invoice</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #222;
            margin: 0;
            background: #fff;
            font-size: 12px;
            line-height: 1.45;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            padding: 14mm 12mm;
            background: #fff;
        }

        .topbar {
            display: table;
            width: 100%;
            border-bottom: 2px solid #222;
            padding-bottom: 10px;
            margin-bottom: 14px;
        }

        .topbar-left,
        .topbar-right {
            display: table-cell;
            vertical-align: top;
        }

        .topbar-right {
            text-align: right;
            width: 220px;
        }

        .company-name {
            font-size: 24px;
            font-weight: 700;
            letter-spacing: .5px;
            margin-bottom: 4px;
        }

        .invoice-title {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .muted {
            color: #666;
        }

        .meta-table,
        .info-table,
        .items-table,
        .summary-table {
            width: 100%;
            border-collapse: collapse;
        }

        .meta-wrap {
            display: table;
            width: 100%;
            margin-bottom: 14px;
        }

        .meta-left,
        .meta-right {
            display: table-cell;
            vertical-align: top;
            width: 50%;
        }

        .box-title {
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 6px;
            text-transform: uppercase;
        }

        .info-box {
            border: 1px solid #cfcfcf;
            padding: 10px;
            min-height: 120px;
        }

        .meta-table td {
            padding: 3px 0;
            vertical-align: top;
        }

        .meta-table td:first-child {
            width: 110px;
            font-weight: 700;
        }

        .subject-box {
            border: 1px solid #cfcfcf;
            padding: 8px 10px;
            margin-bottom: 12px;
        }

        .terms-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
        }

        .terms-table td {
            border: 1px solid #cfcfcf;
            padding: 7px 8px;
            vertical-align: top;
        }

        .terms-table td.label {
            width: 180px;
            font-weight: 700;
            background: #f7f7f7;
        }

        .items-table {
            margin-top: 6px;
            margin-bottom: 14px;
        }

        .items-table th,
        .items-table td {
            border: 1px solid #bdbdbd;
            padding: 7px 6px;
            vertical-align: top;
        }

        .items-table thead th {
            background: #f2f2f2;
            text-align: center;
            font-weight: 700;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        .summary-wrap {
            width: 100%;
            margin-top: 8px;
        }

        .summary-table {
            width: 360px;
            margin-left: auto;
        }

        .summary-table td {
            border: 1px solid #bdbdbd;
            padding: 7px 8px;
        }

        .summary-table td:first-child {
            background: #f7f7f7;
            font-weight: 700;
            width: 180px;
        }

        .summary-table tr.total-row td {
            font-weight: 700;
            font-size: 13px;
        }

        .bank-box,
        .notes-box {
            border: 1px solid #cfcfcf;
            padding: 10px;
            margin-top: 14px;
        }

        .sign-area {
            width: 280px;
            margin-left: auto;
            margin-top: 36px;
            text-align: center;
        }

        .sign-space {
            height: 72px;
        }

        .sign-line {
            border-top: 1px solid #222;
            margin-top: 4px;
            padding-top: 4px;
            font-weight: 700;
        }

        .small {
            font-size: 11px;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            body {
                margin: 0;
            }

            .page {
                width: auto;
                min-height: auto;
                margin: 0;
                padding: 10mm 10mm;
            }
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="no-print" style="margin-bottom: 12px;">
            <button onclick="window.print()">Print</button>
            <button onclick="window.close()">Close</button>
        </div>

        <div class="topbar">
            <div class="topbar-left">
                <div class="company-name"><?= htmlspecialchars($company_name); ?></div>
                <div><?= nl2br(htmlspecialchars($company_address)); ?></div>
                <?php if ($company_phone): ?><div>Phone: <?= htmlspecialchars($company_phone); ?></div><?php endif; ?>
                <?php if ($company_email): ?><div>Email: <?= htmlspecialchars($company_email); ?></div><?php endif; ?>
                <?php if ($company_website): ?><div>Website: <?= htmlspecialchars($company_website); ?></div><?php endif; ?>
            </div>
            <div class="topbar-right">
                <div class="invoice-title">INVOICE</div>
            </div>
        </div>

        <div class="meta-wrap">
            <div class="meta-left" style="padding-right: 8px;">
                <div class="box-title">Bill To</div>
                <div class="info-box">
                    <div><strong><?= htmlspecialchars($customerName); ?></strong></div>
                    <?php if ($picName): ?><div>Attn: <?= htmlspecialchars($picName); ?></div><?php endif; ?>
                    <?php if ($customerAddress): ?><div><?= nl2br(htmlspecialchars($customerAddress)); ?></div><?php endif; ?>
                    <?php if ($customerCountry): ?><div><?= htmlspecialchars($customerCountry); ?></div><?php endif; ?>
                </div>
            </div>
            <div class="meta-right" style="padding-left: 8px;">
                <div class="box-title">Invoice Info</div>
                <div class="info-box">
                    <table class="meta-table">
                        <tr>
                            <td>Invoice No</td>
                            <td>: <?= htmlspecialchars($invoiceNo); ?></td>
                        </tr>
                        <tr>
                            <td>Invoice Date</td>
                            <td>: <?= htmlspecialchars($invoiceDate); ?></td>
                        </tr>
                        <tr>
                            <td>Currency</td>
                            <td>: <?= htmlspecialchars($currencyCode); ?></td>
                        </tr>
                        <tr>
                            <td>Payment Term</td>
                            <td>: <?= htmlspecialchars($paymentTerm); ?></td>
                        </tr>
                        <tr>
                            <td>Incoterm</td>
                            <td>: <?= htmlspecialchars($incoterm); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <?php if ($subject): ?>
            <div class="subject-box">
                <strong>Subject:</strong> <?= htmlspecialchars($subject); ?>
            </div>
        <?php endif; ?>

        <table class="terms-table">
            <tr>
                <td class="label">Commercial Terms</td>
                <td>
                    Payment Term: <?= htmlspecialchars($paymentTerm ?: '-'); ?><br>
                    Incoterm: <?= htmlspecialchars($incoterm ?: '-'); ?>
                </td>
            </tr>
        </table>

        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 32px;">No</th>
                    <th>Description</th>
                    <th style="width: 70px;">Qty</th>
                    <th style="width: 70px;">Unit</th>
                    <th style="width: 110px;">Unit Price</th>
                    <th style="width: 90px;">Disc. %</th>
                    <th style="width: 80px;">Tax %</th>
                    <th style="width: 120px;">Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($items)): ?>
                    <?php foreach ($items as $i => $item): ?>
                        <tr>
                            <td class="text-center"><?= $i + 1; ?></td>
                            <td><?= nl2br(htmlspecialchars($item['description'] ?? '')); ?></td>
                            <td class="text-center"><?= manual_money($item['qty'] ?? 0); ?></td>
                            <td class="text-center"><?= htmlspecialchars($item['unit'] ?? ''); ?></td>
                            <td class="text-end"><?= htmlspecialchars($currencyCode); ?> <?= manual_money($item['unit_price'] ?? 0); ?></td>
                            <td class="text-center"><?= manual_money($item['discount_percent'] ?? 0); ?></td>
                            <td class="text-center"><?= manual_money($item['tax_percent'] ?? 0); ?></td>
                            <td class="text-end"><?= htmlspecialchars($currencyCode); ?> <?= manual_money($item['amount'] ?? 0); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">No item data.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="summary-wrap">
            <table class="summary-table">
                <tr>
                    <td>Subtotal</td>
                    <td class="text-end"><?= htmlspecialchars($currencyCode); ?> <?= manual_money($subtotalAmount); ?></td>
                </tr>
                <tr>
                    <td>Total Discount</td>
                    <td class="text-end"><?= htmlspecialchars($currencyCode); ?> <?= manual_money($totalDiscountAmount); ?></td>
                </tr>
                <tr>
                    <td>Total Tax</td>
                    <td class="text-end"><?= htmlspecialchars($currencyCode); ?> <?= manual_money($totalTaxAmount); ?></td>
                </tr>
                <tr class="total-row">
                    <td>Grand Total</td>
                    <td class="text-end"><?= htmlspecialchars($currencyCode); ?> <?= manual_money($grandTotal); ?></td>
                </tr>
                <tr>
                    <td>Paid Amount</td>
                    <td class="text-end"><?= htmlspecialchars($currencyCode); ?> <?= manual_money($paidAmount); ?></td>
                </tr>
                <tr class="total-row">
                    <td>Balance Due</td>
                    <td class="text-end"><?= htmlspecialchars($currencyCode); ?> <?= manual_money($balanceAmount); ?></td>
                </tr>
            </table>
        </div>

        <div class="bank-box">
            <div class="box-title">Bank Information</div>
            <div><strong>Bank Name:</strong> <?= htmlspecialchars($company_bank ?: '-'); ?></div>
            <div><strong>Account Name:</strong> <?= htmlspecialchars($company_holder ?: '-'); ?></div>
            <div><strong>Account Number:</strong> <?= htmlspecialchars($company_account ?: '-'); ?></div>
            <div><strong>SWIFT Code:</strong> <?= htmlspecialchars($company_swift ?: '-'); ?></div>
        </div>

        <?php if ($notes): ?>
            <div class="notes-box">
                <div class="box-title">Notes</div>
                <div><?= nl2br(htmlspecialchars($notes)); ?></div>
            </div>
        <?php endif; ?>

        <div class="sign-area">
            <div><?= htmlspecialchars($company_name); ?></div>
            <div class="sign-space"></div>
            <div class="sign-line">Authorized Signature</div>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>