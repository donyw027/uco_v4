<?php
function rupiah_spk($n)
{
    return 'Rp. ' . number_format((float)$n, 0, ',', '.') . ',-';
}
function tgl_spk_id($d)
{
    return function_exists('format_date_id') ? format_date_id($d) : date('d F Y', strtotime($d));
}
function clean_lines($s)
{
    return nl2br(e($s));
}
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title><?= e($spk['agreement_no'] ?? 'SPK'); ?></title>
    <style>
        @page {
            size: A4;
            margin: 18mm 16mm 18mm 16mm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: "Times New Roman", serif;
            color: #111;
            background: #e9eef5;
            margin: 0;
            font-size: 11.5pt;
            line-height: 1.32;
        }

        .top-actions {
            max-width: 210mm;
            margin: 14px auto 8px;
            text-align: right;
        }

        .top-actions a,
        .top-actions button {
            font-family: Arial, sans-serif;
            border: 0;
            background: #0f3d91;
            color: #fff;
            text-decoration: none;
            border-radius: 7px;
            padding: 8px 12px;
            font-size: 12px;
        }

        .sheet {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto 24px;
            background: #fff;
            padding: 16mm 16mm 14mm;
            box-shadow: 0 16px 40px rgba(15, 23, 42, .12);
        }

        /* LETTERHEAD */
        .letterhead {
            display: flex;
            align-items: center;
            gap: 28px;
            margin-bottom: 20px;
            padding-bottom: 8px;
        }

        .lh-logo {
            width: 150px;
            height: auto;
            display: block;
            flex-shrink: 0;
        }

        .lh-info {
            text-align: left;
            color: #666;
            line-height: 1.22;
        }

        .company {
            font-size: 24px;
            font-weight: bold;
            color: #666;
            letter-spacing: .2px;
        }

        .small {
            font-size: 15px;
            color: #666;
        }

        /* TITLE */
        .title {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            font-size: 13pt;
            margin: 10px 0 2px;
        }

        .subtitle {
            text-align: center;
            font-weight: bold;
            margin-bottom: 14px;
        }

        /* PARTY */
        .party-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        .party-table td {
            vertical-align: top;
            padding: 2px 3px;
        }

        /* ARTICLE */
        .article-title {
            text-align: center;
            font-weight: bold;
            margin-top: 10px;
        }

        .article-name {
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .article-block {
            margin-bottom: 8px;
            page-break-inside: avoid;
        }

        p {
            margin: 4px 0 6px;
        }

        ol,
        ul {
            margin-top: 4px;
            margin-bottom: 6px;
        }

        ol.alpha {
            margin-top: 4px;
            padding-left: 24px;
        }

        /* SIGNATURE */
        .sign-table {
            width: 100%;
            margin-top: 20px;
            text-align: center;
            page-break-inside: avoid;
        }

        .sign-table td {
            width: 50%;
            vertical-align: top;
        }

        .sign-space {
            height: 45px;
        }

        /* TIMELINE */
        .timeline-title {
            text-align: center;
            font-weight: bold;
            margin: 18px 0 8px;
        }

        .timeline {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            font-size: 10pt;
            page-break-inside: avoid;
        }

        .timeline th,
        .timeline td {
            border: 1px solid #111;
            padding: 4px 5px;
            text-align: center;
        }

        .timeline td:nth-child(2) {
            text-align: left;
        }

        /* JANGAN PAKSA HALAMAN BARU */
        .page-break {
            page-break-before: auto !important;
        }

        /* FOOTER NORMAL */
        .footer {
            margin-top: 18mm;
            padding-top: 5px;
            border-top: 1px solid #ccc;
            text-align: center;
            font-size: 9px;
            color: #777;
        }

        /* PRINT */
        @media print {
            body {
                background: #fff;
                margin: 0;
            }

            .top-actions {
                display: none;
            }

            .sheet {
                width: auto;
                min-height: auto;
                margin: 0;
                padding: 0;
                box-shadow: none;
            }

            .footer {
                margin-top: 14mm;
            }
        }
    </style>
</head>

<body>
    <div class="top-actions"><a href="<?= site_url('work-agreements'); ?>">Back</a> <button onclick="window.print()">Print / Save PDF</button></div>
    <div class="sheet">
        <div class="letterhead">
            <img src="<?= base_url('assets/img/uco.png'); ?>" class="lh-logo" alt="UCO Logo">

            <div class="lh-text">
                <div class="lh-company"><b>UCO EXPORTINDO CONSULTING</b></div>
                <div>Perum Majapahit, Pungging – Mojokerto, Indonesia</div>
                <div>Email : ucoexporindo@gmail.com | marketing@ucoexportindo.com</div>
                <div>Telp : +62 896-7257-4222</div>
            </div>
        </div>
        <hr class="line">
        <div class="title"><?= e($spk['title'] ?: 'SURAT PERJANJIAN KERJA'); ?></div>
        <div class="subtitle"><?= e($spk['party_one_company']); ?> - <?= e($spk['party_two_company']); ?><br>Tentang<br><?= e($spk['subject']); ?></div>
        <p>Yang bertanda tangan di bawah ini :</p>
        <table class="party-table">
            <tr>
                <td width="5%">1.</td>
                <td width="30%"><?= e($spk['party_one_name']); ?></td>
                <td width="3%">:</td>
                <td>Selaku <?= e($spk['party_one_position']); ?> bertindak untuk dan atas nama <?= e($spk['party_one_company']); ?> yang berkedudukan di <?= e($spk['party_one_address']); ?> dan selanjutnya disebut <b>PIHAK KESATU</b>.</td>
            </tr>
            <tr>
                <td colspan="4" style="height:12px"></td>
            </tr>
            <tr>
                <td>2.</td>
                <td><?= e($spk['party_two_name']); ?></td>
                <td>:</td>
                <td>Selaku <?= e($spk['party_two_position']); ?> bertindak untuk dan atas nama <?= e($spk['party_two_company']); ?> berkedudukan di <?= e($spk['party_two_address']); ?> dan selanjutnya disebut <b>PIHAK KEDUA</b>.</td>
            </tr>
        </table>
        <p>Kedua belah pihak dengan ini telah bersepakat untuk mengadakan dan melaksanakan perjanjian dengan ketentuan-ketentuan sebagai berikut :</p>
        <div class="article-title">Pasal 1</div>
        <div class="article-name">PENYERAHAN PEKERJAAN</div>
        <p>PIHAK KESATU menyerahkan pekerjaan kepada PIHAK KEDUA, dan PIHAK KEDUA menerima dan bersedia melaksanakan pekerjaan yang diserahkan oleh PIHAK KESATU, berupa :</p>
        <p><?= e($spk['work_description']); ?></p>
        <div class="article-title">Pasal 2</div>
        <div class="article-name">RUANG LINGKUP PEKERJAAN</div>
        <p>(1) Ruang Lingkup dan persyaratan pekerjaan seperti yang dimaksud Pasal 1 Surat Perjanjian ini adalah:</p>
        <ol class="alpha" type="a"><?php foreach ($scopes as $s): ?><li><?= e($s['scope_text']); ?></li><?php endforeach; ?></ol>
        <div class="article-title">Pasal 3</div>
        <div class="article-name">JANGKA WAKTU PELAKSANAAN</div>
        <p>Jangka waktu pelaksanaan perjanjian ini adalah <?= e($spk['duration_text']); ?></p>
        <div class="article-title">Pasal 4</div>
        <div class="article-name">PEMBIAYAAN</div>
        <p>(1) Biaya pelaksanaan pekerjaan ini seluruhnya ditetapkan sebesar <?= rupiah_spk($spk['total_amount'] ?? 0); ?>.</p>
        <p>(2) Pelaksanaan pembayaran atas seluruh biaya yang dimaksud dalam Pasal 4 Surat Perjanjian ini, dilakukan oleh PIHAK KESATU kepada PIHAK KEDUA.</p>
        <p>(3) Pelaksanaan pembayaran diatur secara Termin berdasarkan progress pekerjaan sebagai berikut:</p>
        <ol class="alpha" type="a">
            <li>Tahap Pertama : Sebesar <?= e($spk['dp_percent']); ?>% atau sama dengan <?= rupiah_spk($spk['dp_amount'] ?? 0); ?> setelah perjanjian ini ditandatangani.</li>
            <li>Tahap Kedua : Sebesar <?= e($spk['settlement_percent']); ?>% atau sama dengan <?= rupiah_spk($spk['settlement_amount'] ?? 0); ?>, <?= e($spk['settlement_trigger_text']); ?>.</li><?php if (!empty($spk['show_tax_clause'])): ?><li><?= e($spk['tax_clause_text']); ?></li><?php endif; ?>
        </ol>
        <div class="article-title">Pasal 5</div>
        <div class="article-name">EVALUASI DOKUMEN PERIZINAN</div>
        <p><?= clean_lines($spk['evaluation_text']); ?></p>
        <div class="article-title">Pasal 6</div>
        <div class="article-name">FORCE MAJEURE</div>
        <p><?= clean_lines($spk['force_majeure_text']); ?></p>
        <div class="article-title">Pasal 7</div>
        <div class="article-name">HAL-HAL LAIN</div>
        <p><?= clean_lines($spk['other_terms_text']); ?></p>
        <p>Surat Perjanjian ini dibuat dan ditandatangani oleh kedua belah pihak dalam keadaan sadar, rangkap 2 (dua) yang mempunyai kekuatan hukum yang sama.</p>
        <div style="text-align:right;margin-top:20px;"><?= e($spk['place_signed']); ?>, <?= tgl_spk_id($spk['agreement_date']); ?></div>
        <table class="sign-table">
            <tr>
                <td><b>PIHAK KESATU</b><br><?= e($spk['party_one_company']); ?><div class="sign-space"></div><b><u><?= e($spk['signer_party_one']); ?></u></b></td>
                <td><b>PIHAK KEDUA</b><br><?= e($spk['party_two_company']); ?><div class="sign-space"></div><b><u><?= e($spk['signer_party_two']); ?></u></b></td>
            </tr>
        </table>
        <?php if (!empty($timelines)): ?><div class="page-break"></div>
            <h3 style="text-align:center">Time Line Pekerjaan</h3>
            <table class="timeline">
                <thead>
                    <tr>
                        <th width="40">No</th>
                        <th>Activity</th>
                        <th width="150">Leadtime</th>
                        <th width="160">PIC</th>
                    </tr>
                </thead>
                <tbody><?php $no = 1;
                        foreach ($timelines as $t): ?><tr>
                            <td><?= $no++; ?></td>
                            <td><?= e($t['activity']); ?></td>
                            <td><?= e($t['leadtime']); ?></td>
                            <td><?= e($t['pic']); ?></td>
                        </tr><?php endforeach; ?></tbody>
            </table><?php endif; ?>
    </div>
</body>

</html>