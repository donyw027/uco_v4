<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h4 class="fw-bold mb-1">Inquiry Detail</h4>
        <div class="text-muted small">
            Pesan dari <?= htmlspecialchars((string)($row['full_name'] ?? '-'), ENT_QUOTES, 'UTF-8'); ?>.
        </div>
    </div>
    <a href="<?= site_url('contact_messages'); ?>" class="btn btn-outline-secondary rounded-pill px-4">Back</a>
</div>

<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success rounded-4">
        <?= htmlspecialchars((string)$this->session->flashdata('success'), ENT_QUOTES, 'UTF-8'); ?>
    </div>
<?php endif; ?>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between gap-3 mb-3">
                    <div>
                        <div class="text-muted small">Subject</div>
                        <h4 class="fw-bold mb-0">
                            <?= htmlspecialchars((string)($row['subject'] ?? '-'), ENT_QUOTES, 'UTF-8'); ?>
                        </h4>
                    </div>

                    <?php
                    $status = $row['status'] ?? 'new';
                    $badge = 'info';
                    if ($status === 'new') $badge = 'warning text-dark';
                    if ($status === 'replied') $badge = 'success';
                    if ($status === 'archived') $badge = 'secondary';
                    ?>

                    <span class="badge align-self-start rounded-pill bg-<?= $badge; ?>">
                        <?= htmlspecialchars(ucfirst((string)$status), ENT_QUOTES, 'UTF-8'); ?>
                    </span>
                </div>

                <hr>

                <div class="text-muted small mb-2">Message</div>
                <div class="p-4 bg-light rounded-4" style="white-space:pre-wrap;">
                    <?= htmlspecialchars((string)($row['message'] ?? '-'), ENT_QUOTES, 'UTF-8'); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">Sender Info</h5>

                <div class="mb-3">
                    <div class="text-muted small">Full Name</div>
                    <div class="fw-semibold">
                        <?= htmlspecialchars((string)($row['full_name'] ?? '-'), ENT_QUOTES, 'UTF-8'); ?>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="text-muted small">Email</div>
                    <?php $email = $row['email'] ?? ''; ?>
                    <a href="mailto:<?= htmlspecialchars((string)$email, ENT_QUOTES, 'UTF-8'); ?>">
                        <?= htmlspecialchars((string)$email, ENT_QUOTES, 'UTF-8'); ?>
                    </a>
                </div>

                <div class="mb-3">
                    <div class="text-muted small">Phone</div>
                    <div>
                        <?= htmlspecialchars((string)(!empty($row['phone']) ? $row['phone'] : '-'), ENT_QUOTES, 'UTF-8'); ?>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="text-muted small">Received At</div>
                    <div>
                        <?= !empty($row['created_at']) ? date('d M Y H:i', strtotime($row['created_at'])) : '-'; ?>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <a class="btn btn-dark rounded-pill"
                        href="mailto:<?= htmlspecialchars((string)$email, ENT_QUOTES, 'UTF-8'); ?>?subject=Re: <?= rawurlencode((string)($row['subject'] ?? 'Inquiry')); ?>">
                        Reply by Email
                    </a>

                    <?php if (!empty($row['phone'])): ?>
                        <a class="btn btn-outline-success rounded-pill"
                            target="_blank"
                            href="https://wa.me/<?= preg_replace('/[^0-9]/', '', (string)$row['phone']); ?>">
                            Open WhatsApp
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3">Update Status</h5>

                <form action="<?= site_url('contact_messages/status/' . (int)($row['id'] ?? 0)); ?>" method="post" class="d-grid gap-3">
                    <select name="status" class="form-select rounded-4">
                        <?php foreach (['new' => 'New', 'read' => 'Read', 'replied' => 'Replied', 'archived' => 'Archived'] as $key => $label): ?>
                            <option value="<?= $key; ?>" <?= (($row['status'] ?? '') === $key) ? 'selected' : ''; ?>>
                                <?= $label; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <button class="btn btn-outline-dark rounded-pill" type="submit">
                        Save Status
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>