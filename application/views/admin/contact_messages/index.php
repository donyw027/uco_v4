<?php
if (!function_exists('e_inq')) {
    function e_inq($str)
    {
        return htmlspecialchars((string)$str, ENT_QUOTES, 'UTF-8');
    }
}
?>

<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h4 class="fw-bold mb-1">Website Inquiry Messages</h4>
        <div class="text-muted small">Pesan yang dikirim dari form Contact / Send Inquiry di halaman depan.</div>
    </div>
</div>

<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success rounded-4"><?= $this->session->flashdata('success'); ?></div>
<?php endif; ?>

<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body">
        <form method="get" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label fw-semibold">Search</label>
                <input type="text" name="q" value="<?= e_inq($keyword ?? ''); ?>" class="form-control rounded-4" placeholder="Name, email, subject, message...">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Status</label>
                <select name="status" class="form-select rounded-4">
                    <option value="">All Status</option>
                    <?php foreach (['new' => 'New', 'read' => 'Read', 'replied' => 'Replied', 'archived' => 'Archived'] as $key => $label): ?>
                        <option value="<?= $key; ?>" <?= (($filter_status ?? '') === $key) ? 'selected' : ''; ?>><?= $label; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-5 d-flex gap-2">
                <button class="btn btn-dark rounded-pill px-4" type="submit"><i class="bi bi-search me-1"></i> Filter</button>
                <a href="<?= site_url('contact_messages'); ?>" class="btn btn-outline-secondary rounded-pill px-4">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width:150px;">Date</th>
                    <th>Sender</th>
                    <th>Subject</th>
                    <th style="width:110px;">Status</th>
                    <th style="width:170px;" class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($rows)): ?>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <td><?= e_inq($row['created_at'] ?? '-'); ?></td>

                            <td>
                                <strong><?= e_inq($row['full_name'] ?? '-'); ?></strong><br>
                                <small class="text-muted">
                                    <?= e_inq($row['email'] ?? '-'); ?>
                                    <?php if (!empty($row['phone'])): ?>
                                        | <?= e_inq($row['phone']); ?>
                                    <?php endif; ?>
                                </small>
                            </td>

                            <td><?= e_inq($row['subject'] ?? '-'); ?></td>

                            <td>
                                <span class="badge bg-<?= ($row['status'] ?? '') === 'new' ? 'danger' : 'secondary'; ?>">
                                    <?= ucfirst($row['status'] ?? 'new'); ?>
                                </span>
                            </td>

                            <td class="text-end">
                                <a href="<?= site_url('contact_messages/view/' . $row['id']); ?>"
                                    class="btn btn-sm btn-primary rounded-pill">
                                    View
                                </a>

                                <a href="<?= site_url('contact_messages/delete/' . $row['id']); ?>"
                                    class="btn btn-sm btn-danger rounded-pill"
                                    onclick="return confirm('Yakin mau hapus inquiry ini?');">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">No data found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>