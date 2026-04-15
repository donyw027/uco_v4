<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Consulting Service Proposal</title>
    <style>
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
    <div class="page">
        <div class="top-accent"></div>

        <div class="content">
            <div class="top-actions">
                <a href="<?= site_url('transactions/inquiries'); ?>" class="btn-back">← Back to Manual Inquiry</a>
            </div>
            <div class="header">
                <div class="brand">
                    <!-- <img src="<?= base_url('assets/img/uco.png'); ?>" class="brand-logo" alt="UCO Logo"> -->
                    <div>
                        <div class="brand-kicker">Consulting service document</div>
                        <h1 class="brand-title">CONSULTING SERVICE PROPOSAL</h1>
                        <div class="company-name"><?= e($company['company_name'] ?? 'UCO Exportindo Consulting'); ?></div>
                        <div class="company-address"><?= nl2br(e($company['address'] ?? '')); ?></div>
                    </div>
                </div>

                <div class="doc-meta">
                    <div class="doc-label">Proposal No</div>
                    <div class="doc-no"><?= e($inq['proposal_no'] ?? ''); ?></div>
                    <div class="doc-sub">
                        <strong>Date:</strong> <?= format_date_id($inq['proposal_date'] ?? ''); ?>
                    </div>
                </div>
            </div>

            <div class="section-box">
                <div class="box-title">Kepada / To</div>
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
                            <th width="160">Instansi</th>
                            <th width="95">Durasi</th>
                            <th class="text-end" width="120">Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        $total = 0; ?>
                        <?php foreach ($items as $it): ?>
                            <?php $total += (float)($it['amount'] ?? 0); ?>
                            <tr>
                                <td class="num"><?= $no++; ?></td>
                                <td><?= nl2br(e($it['description'])); ?></td>
                                <td><?= e($it['agency'] ?? ''); ?></td>
                                <td><?= e($it['duration_text'] ?? ''); ?></td>
                                <td class="text-end amount"><?= format_money($it['amount']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-end">TOTAL (<?= e($inq['currency_text'] ?? 'IDR'); ?>)</th>
                            <th class="text-end"><?= format_money($total); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <?php if (!empty($inq['terms_text'])): ?>
                <div class="section-box" style="margin-top:10px;">
                    <div class="box-title">Ketentuan</div>
                    <div class="terms-text"><?= nl2br(e($inq['terms_text'])); ?></div>
                </div>
            <?php endif; ?>

            <?php if (!empty($inq['closing_text'])): ?>
                <div class="section-box">
                    <div class="box-title">Closing</div>
                    <div class="closing-text"><?= nl2br(e($inq['closing_text'])); ?></div>
                </div>
            <?php endif; ?>

            <div class="sign-grid">
                <div class="sign-box">
                    <div class="box-title">Hormat Kami</div>
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
                    <div class="box-title">Menyetujui</div>
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