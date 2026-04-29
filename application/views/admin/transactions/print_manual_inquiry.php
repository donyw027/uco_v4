<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Commercial Document</title>
    <style>
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .brand {
            flex: 1;
        }

        .header-logo-center {
            flex: 0 0 180px;
            text-align: center;
        }

        .header-logo-center img {
            max-width: 140px;
            max-height: 90px;
            object-fit: contain;
        }

        .doc-meta {
            flex: 1;
            text-align: right;
        }

        .top-actions {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 10px;
        }

        .btn-back {
            display: inline-block;
            padding: 8px 14px;
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

        @media print {
            .top-actions {
                display: none !important;
            }
        }


        @page {
            size: A4 portrait;
            margin: 10mm 10mm 10mm 10mm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background: #e9eef5;
            color: #1e293b;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            line-height: 1.45;
        }

        .page {
            width: 100%;
            max-width: 180mm;
            min-height: 267mm;
            margin: 12px auto;
            background: #fff;
            position: relative;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, .08);
            overflow: hidden;
        }

        .top-accent {
            height: 5px;
            background: linear-gradient(90deg, #0f3d91, #2b6fff, #8ab7ff);
        }

        .content {
            padding: 16mm 14mm 14mm 14mm;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            padding-bottom: 12px;
            border-bottom: 1.5px solid #dbe4f0;
            margin-bottom: 12px;
        }

        .brand {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            flex: 1;
            min-width: 0;
        }

        .brand-logo {
            width: 54px;
            height: auto;
            object-fit: contain;
            flex: 0 0 auto;
        }

        .brand-kicker {
            font-size: 10px;
            color: #94a3b8;
            margin-bottom: 3px;
        }

        .brand-title {
            margin: 0;
            font-size: 20px;
            line-height: 1.05;
            font-weight: 800;
            letter-spacing: .2px;
            color: #0f172a;
        }

        .company-name {
            margin-top: 8px;
            font-weight: 700;
            color: #334155;
            font-size: 12px;
        }

        .company-address {
            margin-top: 3px;
            color: #64748b;
            line-height: 1.45;
            max-width: 100%;
            font-size: 11px;
        }

        .doc-meta {
            width: 185px;
            text-align: right;
            flex: 0 0 185px;
        }

        .doc-label {
            font-size: 9px;
            color: #94a3b8;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: .08em;
        }

        .doc-no {
            font-size: 16px;
            line-height: 1.1;
            font-weight: 800;
            color: #0f3d91;
            margin: 3px 0 6px;
            word-break: break-word;
        }

        .doc-sub {
            color: #64748b;
            line-height: 1.5;
            font-size: 11px;
        }

        .section-box {
            border: 1px solid #dbe4f0;
            border-radius: 10px;
            padding: 10px 12px;
            background: linear-gradient(180deg, #ffffff 0%, #fbfdff 100%);
            margin-bottom: 10px;
            page-break-inside: avoid;
        }

        .box-title {
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: .08em;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 6px;
        }

        .recipient-name {
            font-size: 15px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 4px;
        }

        .muted {
            color: #64748b;
        }

        .opening-text,
        .closing-text,
        .terms-text {
            line-height: 1.65;
            color: #334155;
            white-space: pre-line;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .item-table {
            margin-top: 4px;
            border: 1px solid #dbe4f0;
            overflow: hidden;
            border-radius: 10px;
            page-break-inside: avoid;
        }

        .item-table th {
            background: #f8fbff;
            color: #475569;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: .05em;
            font-weight: 800;
            padding: 8px 8px;
            border-bottom: 1px solid #dbe4f0;
        }

        .item-table td {
            padding: 8px 8px;
            border-top: 1px solid #e8eef6;
            vertical-align: top;
            font-size: 11px;
        }

        .item-table tbody tr:first-child td {
            border-top: none;
        }

        .item-table .num {
            text-align: center;
            width: 42px;
        }

        .item-table .text-end {
            text-align: right;
        }

        .item-table .amount {
            font-weight: 800;
            color: #0f172a;
            white-space: nowrap;
        }

        .item-table tfoot th {
            background: #fcfdff;
            border-top: 1px solid #dbe4f0;
            font-size: 10px;
            color: #0f172a;
            padding: 9px 8px;
        }


        .bottom-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 10px;
            page-break-inside: avoid;
        }

        .bottom-grid.no-summary {
            grid-template-columns: 1fr;
        }

        .summary-table td {
            padding: 6px 0;
            border-bottom: 1px solid #e8eef6;
            font-size: 11px;
        }

        .summary-table tr:last-child td {
            border-bottom: none;
            font-weight: 800;
            color: #0f172a;
        }

        .summary-table .cur {
            width: 45px;
            color: #64748b;
            text-align: center;
        }

        .summary-table .val {
            text-align: right;
            font-weight: 700;
        }

        .sign-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 12px;
            page-break-inside: avoid;
        }

        .sign-box {
            border: 1px solid #dbe4f0;
            border-radius: 10px;
            padding: 12px;
            background: linear-gradient(180deg, #ffffff 0%, #fbfdff 100%);
            min-height: 130px;
        }

        .sign-wrap {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            align-items: center;
            text-align: center;
        }

        .sign-space {
            height: 46px;
        }

        .sign-line {
            width: 82%;
            border-top: 1px dashed #94a3b8;
            margin: 8px 0 6px;
        }

        .sign-name {
            font-weight: 800;
            color: #0f172a;
            font-size: 11px;
        }

        .sign-title {
            color: #64748b;
            line-height: 1.45;
            font-size: 10px;
        }

        .watermark {
            position: absolute;
            right: 10mm;
            bottom: 8mm;
            font-size: 40px;
            font-weight: 800;
            color: rgba(148, 163, 184, .08);
            pointer-events: none;
            user-select: none;
            letter-spacing: .06em;
        }

        @media print {
            body {
                background: #fff;
            }

            .page {
                margin: 0;
                max-width: none;
                min-height: auto;
                border-radius: 0;
                box-shadow: none;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <?php
    $docType = $inq['document_type'] ?? 'commercial_proposal';
    $offerType = $inq['offer_type'] ?? 'product_service';
    $docTitles = [
        'commercial_proposal' => 'COMMERCIAL PROPOSAL',
        'business_proposal'   => 'BUSINESS PROPOSAL',
        'quotation'           => 'QUOTATION',
        'service_offer'       => 'SERVICE OFFER',
    ];
    $docSubtitles = [
        'product'         => 'Product / goods offer',
        'service'         => 'Service / consulting offer',
        'product_service' => 'Product and service offer',
    ];
    $docTitle = $docTitles[$docType] ?? 'COMMERCIAL PROPOSAL';
    $docSubtitle = $docSubtitles[$offerType] ?? 'Product and service offer';

    // =========================
    // PRINT BEHAVIOR SETTINGS
    // =========================
    // Bisa dikirim dari database: $inq['show_summary'] = 1 / 0
    // Default tetap tampil agar dokumen lama tidak berubah.
    $showSummary = !isset($inq['show_summary']) || (int)$inq['show_summary'] === 1;

    // Product document: Quotation / product offer menampilkan Qty, Unit, Unit Price.
    // Service document: Service Offer menyembunyikan Qty, Unit, Unit Price.
    // Commercial Proposal campuran: kolom product hanya muncul kalau item punya qty/unit/unit_price.
    $isServiceDoc = ($docType === 'service_offer' || $offerType === 'service');
    $isProductDoc = ($docType === 'quotation' || $offerType === 'product');
    $isMixedDoc   = (!$isServiceDoc && !$isProductDoc);

    $hasQty = false;
    $hasUnit = false;
    $hasUnitPrice = false;
    if (!empty($items)) {
        foreach ($items as $row) {
            if ((float)($row['qty'] ?? 0) > 0) $hasQty = true;
            if (trim((string)($row['unit'] ?? $row['uom'] ?? '')) !== '') $hasUnit = true;
            if ((float)($row['unit_price'] ?? $row['price'] ?? 0) > 0) $hasUnitPrice = true;
        }
    }

    $isServiceDoc = ($docType === 'service_offer' || $offerType === 'service');

    $agencyLabel   = $isServiceDoc ? 'Scope / Agency' : 'Scope / Specification';
    $durationLabel = $isServiceDoc ? 'Timeline' : 'Duration / Lead Time';
    $amountLabel   = $isServiceDoc ? 'Service Fee' : 'Amount';

    $agencyLabel = $isProductDoc ? 'Specification' : ($isServiceDoc ? 'Scope / Agency' : 'Scope / Specification');
    $durationLabel = $isServiceDoc ? 'Timeline' : 'Lead Time';
    $amountLabel = $isServiceDoc ? 'Service Fee' : 'Amount';
    ?>

    <div class="page">
        <div class="top-accent"></div>

        <div class="content">
            <div class="top-actions">
                <a href="<?= site_url('transactions/inquiries'); ?>" class="btn-back">← Back to Commercial Document</a>
            </div>
            <div class="header">

                <!-- LEFT -->
                <div class="brand">
                    <div>
                        <div class="brand-kicker"><?= e($docSubtitle); ?></div>
                        <h1 class="brand-title"><?= e($docTitle); ?></h1>
                        <div class="company-name">
                            <?= e($company['company_name'] ?? 'UCO Exportindo Consulting'); ?>
                        </div>
                        <div class="company-address">
                            <?= nl2br(e($company['address'] ?? '')); ?>
                        </div>
                    </div>
                </div>

                <!-- CENTER LOGO -->
                <div class="header-logo-center">
                    <img src="<?= base_url('assets/img/uco.png'); ?>" alt="UCO Logo">
                </div>

                <!-- RIGHT -->
                <div class="doc-meta">
                    <div class="doc-label">Document No</div>
                    <div class="doc-no"><?= e($inq['proposal_no'] ?? ''); ?></div>
                    <div class="doc-sub">
                        <strong>Date:</strong>
                        <?= format_date_id($inq['proposal_date'] ?? ''); ?>
                    </div>
                </div>

            </div>

            <div class="section-box">
                <div class="box-title">To</div>
                <div class="recipient-name"><?= e($inq['recipient_company'] ?? ''); ?></div>
                <?php if (!empty($inq['recipient_pic'])): ?>
                    <div><strong>Attn:</strong> <?= e($inq['recipient_pic']); ?></div>
                <?php endif; ?>
                <?php if (!empty($inq['recipient_address'])): ?>
                    <div class="muted"><?= nl2br(e($inq['recipient_address'])); ?></div>
                <?php endif; ?>
            </div>

            <?php if (!empty($inq['subject'])): ?>
                <div class="section-box">
                    <div class="box-title">Subject</div>
                    <div class="recipient-name" style="font-size:12px; margin-bottom:0;">
                        <?= e($inq['subject']); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($inq['validity_offer']) || !empty($inq['lead_time'])): ?>
                <div class="section-box">
                    <div class="box-title">Commercial Information</div>
                    <?php if (!empty($inq['validity_offer'])): ?><div><strong>Validity Offer:</strong> <?= e($inq['validity_offer']); ?></div><?php endif; ?>
                    <?php if (!empty($inq['lead_time'])): ?><div><strong><?= e($durationLabel); ?>:</strong> <?= e($inq['lead_time']); ?></div><?php endif; ?>
                </div>
            <?php endif; ?>

            <?php
            $scopeText = trim(preg_replace("/\n\s*\n+/", "\n", $inq['scope_of_work'] ?? ''));
            ?>

            <?php if ($scopeText !== ''): ?>
                <div class="section-box">
                    <div class="box-title">Scope of Work / Offer Scope</div>
                    <div class="opening-text"><?= nl2br(e($scopeText)); ?></div>
                </div>
            <?php endif; ?>

            <?php if (!empty($inq['opening_text'])): ?>
                <div class="section-box">
                    <div class="box-title">Opening</div>
                    <div class="opening-text"><?= nl2br(e($inq['opening_text'])); ?></div>
                </div>
            <?php endif; ?>

            <div class="item-table">
                <table>
                    <thead>
                        <tr>
                            <th width="42">No</th>
                            <th>Description</th>
                            <th width="220"><?= e($agencyLabel); ?></th>
                            <th width="125"><?= e($durationLabel); ?></th>
                            <th class="text-end" width="130"><?= e($amountLabel); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        $total = 0;
                        $ppnPercent = isset($inq['ppn_percent']) ? (float)$inq['ppn_percent'] : 11;
                        $pphPercent = isset($inq['pph_percent']) ? (float)$inq['pph_percent'] : 2; ?>
                        <?php foreach ($items as $it): ?>
                            <?php
                            $qty = (float)($it['qty'] ?? 0);
                            $unit = $it['unit'] ?? $it['uom'] ?? '';
                            $unitPrice = (float)($it['unit_price'] ?? $it['price'] ?? 0);
                            $amount = (float)($it['amount'] ?? 0);
                            if ($amount <= 0 && $qty > 0 && $unitPrice > 0) {
                                $amount = $qty * $unitPrice;
                            }
                            $total += $amount;
                            ?>
                            <tr>
                                <td class="num"><?= $no++; ?></td>
                                <td><?= nl2br(e($it['description'] ?? '')); ?></td>
                                <td><?= nl2br(e($it['agency'] ?? '')); ?></td>
                                <td><?= nl2br(e($it['duration_text'] ?? '')); ?></td>
                                <td class="text-end amount"><?= format_money($amount); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <?php
                    $ppnAmount = $total * $ppnPercent / 100;
                    $pphAmount = $total * $pphPercent / 100;
                    $grandTotal = $total + $ppnAmount - $pphAmount;

                    ?>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-end">
                                TOTAL (<?= e($inq['currency_text'] ?? 'IDR'); ?>)
                            </th>
                            <th class="text-end"><?= format_money($grandTotal); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>


            <div class="bottom-grid <?= $showSummary ? '' : 'no-summary'; ?>">
                <?php
                $termsText = $inq['terms_text'] ?? '';
                $termsText = str_replace(["\r\n", "\r"], "\n", $termsText);
                $termsLines = array_filter(array_map('trim', explode("\n", $termsText)));
                ?>

                <div class="section-box" style="margin-bottom:0;">
                    <div class="box-title">Commercial Terms</div>

                    <?php foreach ($termsLines as $line): ?>
                        <div class="terms-line">• <?= e(ltrim($line, "•- \t")); ?></div>
                    <?php endforeach; ?>
                </div>

                <?php if ($showSummary): ?>
                    <div class="section-box" style="margin-bottom:0;">
                        <div class="box-title">Summary</div>
                        <table class="summary-table">
                            <tr>
                                <td>Subtotal</td>
                                <td class="cur"><?= e($inq['currency_text'] ?? 'IDR'); ?></td>
                                <td class="val"><?= format_money($total); ?></td>
                            </tr>
                            <tr>
                                <td>PPN <?= rtrim(rtrim(number_format($ppnPercent, 2, '.', ''), '0'), '.'); ?>%</td>
                                <td class="cur"><?= e($inq['currency_text'] ?? 'IDR'); ?></td>
                                <td class="val"><?= format_money($ppnAmount); ?></td>
                            </tr>
                            <tr>
                                <td>PPH <?= rtrim(rtrim(number_format($pphPercent, 2, '.', ''), '0'), '.'); ?>%</td>
                                <td class="cur"><?= e($inq['currency_text'] ?? 'IDR'); ?></td>
                                <td class="val"><?= format_money($pphAmount); ?></td>
                            </tr>
                            <tr>
                                <td>Grand Total</td>
                                <td class="cur"><?= e($inq['currency_text'] ?? 'IDR'); ?></td>
                                <td class="val"><?= format_money($grandTotal); ?></td>
                            </tr>
                        </table>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (!empty($inq['closing_text'])): ?>
                <div class="section-box" style="margin-top:10px;">
                    <div class="box-title">Closing</div>
                    <?= nl2br(e(trim(preg_replace("/\n\s*\n+/", "\n", $inq['closing_text'])))); ?>
                </div>
            <?php endif; ?>
            <div class="sign-grid">
                <div class="sign-box">
                    <div class="box-title">Offered By</div>
                    <div class="sign-wrap">
                        <div class="sign-space"></div>
                        <div class="sign-line"></div>
                        <div class="sign-name"><?= e($company['signature_name'] ?? ''); ?></div>
                        <div class="sign-title">
                            <?= e($company['signature_title'] ?? ''); ?><br>
                            <?= e($company['company_name'] ?? ''); ?>
                        </div>
                    </div>
                </div>

                <div class="sign-box">
                    <div class="box-title">Accepted By</div>
                    <div class="sign-wrap">
                        <div class="sign-space"></div>
                        <div class="sign-line"></div>
                        <div class="sign-name">(........................................)</div>
                        <div class="sign-title">
                            Direktur / Authorized Person<br>
                            <?= e($inq['recipient_company'] ?? ''); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="watermark">UCO</div>
    </div>
</body>

</html>