<?php $row = $row ?? []; ?>
<div class="section-block">
    <div class="section-head">
        <div>
            <h3>Company profile setup</h3>
            <p>Data ini dipakai untuk tampilan print invoice, packing list, dan identitas perusahaan di dokumen bisnis.</p>
        </div>
        <span class="badge-soft badge-soft-success">Document ready</span>
    </div>

    <div class="row g-4 align-items-start">
        <div class="col-lg-7">
            <div class="card shadow-sm h-100">
                <div class="card-header">
                    <strong>Company identity form</strong>
                    <div class="text-muted small">Isi profil perusahaan dengan lengkap agar hasil print terlihat lebih professional dan trusted.</div>
                </div>
                <div class="card-body">
                    <form method="post" class="d-grid gap-3">
                        <div>
                            <label class="form-label">Company Name</label>
                            <input type="text" name="company_name" class="form-control" value="<?= e($row['company_name'] ?? ''); ?>">
                        </div>
                        <div>
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control"><?= e($row['address'] ?? ''); ?></textarea>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6"><label class="form-label">Phone</label><input type="text" name="phone" class="form-control" value="<?= e($row['phone'] ?? ''); ?>"></div>
                            <div class="col-md-6"><label class="form-label">Email</label><input type="text" name="email" class="form-control" value="<?= e($row['email'] ?? ''); ?>"></div>
                        </div>
                        <div>
                            <label class="form-label">Bank Info</label>
                            <textarea name="bank_info" class="form-control" placeholder="Account name, account number, bank, swift, address, dll."><?= e($row['bank_info'] ?? ''); ?></textarea>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6"><label class="form-label">Signature Name</label><input type="text" name="signature_name" class="form-control" value="<?= e($row['signature_name'] ?? ''); ?>"></div>
                            <div class="col-md-6"><label class="form-label">Signature Title</label><input type="text" name="signature_title" class="form-control" value="<?= e($row['signature_title'] ?? ''); ?>"></div>
                        </div>
                        <div class="d-flex flex-wrap gap-2 pt-2">
                            <button class="btn btn-dark">Save Company Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <strong>Preview highlight</strong>
                    <div class="text-muted small">Gambaran elemen yang akan muncul pada dokumen print.</div>
                </div>
                <div class="card-body d-grid gap-3">
                    <div class="metric-mini"><div><div class="label">Company</div><div class="big"><?= e($row['company_name'] ?? 'UCO Trading Solution'); ?></div></div><i class="bi bi-buildings fs-4 text-primary"></i></div>
                    <div class="metric-mini"><div><div class="label">Email</div><div class="big" style="font-size:1rem;"><?= e($row['email'] ?? 'company@email.com'); ?></div></div><i class="bi bi-envelope fs-4 text-success"></i></div>
                    <div class="metric-mini"><div><div class="label">Phone</div><div class="big" style="font-size:1rem;"><?= e($row['phone'] ?? '-'); ?></div></div><i class="bi bi-telephone fs-4 text-warning"></i></div>
                    <div class="quick-note">
                        <h6>Tips</h6>
                        <p>Isi bank info dan signature dengan lengkap supaya commercial invoice lebih siap dipakai kirim ke buyer.</p>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header">
                    <strong>Recommended checklist</strong>
                    <div class="text-muted small">Supaya output invoice dan packing list terlihat lebih proper.</div>
                </div>
                <div class="card-body">
                    <ul class="mb-0 ps-3 d-grid gap-2 text-muted">
                        <li>Nama perusahaan sesuai identitas resmi.</li>
                        <li>Alamat perusahaan lengkap dan mudah dibaca.</li>
                        <li>Email dan phone aktif untuk buyer inquiry.</li>
                        <li>Bank info tidak typo dan sudah final.</li>
                        <li>Nama penandatangan sesuai jabatan.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
