<?php
$publicCompany = isset($company) && is_array($company) ? $company : [];
$publicEmail = trim((string)($publicCompany['email'] ?? '<?= e($publicEmail); ?>'));
$publicPhone = trim((string)($publicCompany['phone'] ?? ''));
$publicAddress = trim((string)($publicCompany['address'] ?? 'Indonesia'));
?>
<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success rounded-4">
        <?= $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger rounded-4">
        <?= $this->session->flashdata('error'); ?>
    </div>
<?php endif; ?>

<section class="page-hero">
    <div class="container text-center">
        <span class="section-kicker">Contact us</span>
        <h1 class="section-title">Business inquiry and trade consultation</h1>
        <p class="section-text mx-auto" style="max-width:760px;">
            Contact UCO Exportindo Consulting for export coordination, import-export consulting, commodity sourcing, and international business inquiries.
        </p>
    </div>
</section>

<section class="section-space pt-0">
    <div class="container">
        <div class="row g-4 mb-4">

            <div class="col-lg-5">
                <div class="soft-card p-4 p-lg-5 h-100">
                    <span class="section-kicker mb-3">Contact information</span>
                    <h3 class="fw-bold mb-4">Let’s discuss your business needs</h3>

                    <div class="d-grid gap-3">
                        <div class="contact-tile soft-card p-3">
                            <strong><i class="fa-solid fa-envelope me-2 text-primary"></i>Email</strong>
                            <div class="small-muted mt-1"><?= e($publicEmail); ?></div>
                            <div class="small-muted mt-1">ucoexporindo@gmail.com</div>
                        </div>

                        <div class="contact-tile soft-card p-3">
                            <strong><i class="fa-solid fa-phone me-2 text-primary"></i>Phone</strong>
                            <div class="small-muted mt-1"><?= e($publicPhone !== '' ? $publicPhone : '-'); ?></div>
                        </div>

                        <div class="contact-tile soft-card p-3">
                            <strong><i class="fa-solid fa-location-dot me-2 text-primary"></i>Location</strong>
                            <div class="small-muted mt-1"><?= nl2br(e($publicAddress)); ?></div>
                        </div>

                        <div class="contact-tile soft-card p-3">
                            <strong><i class="fa-solid fa-clock me-2 text-primary"></i>Working hours</strong>
                            <div class="small-muted mt-1">Monday - Friday, 08:00 - 17:00</div>
                        </div>
                    </div>

                    <div class="gradient-panel p-4 mt-4 text-center">
                        <img src="<?= base_url('assets/img/uco.png'); ?>"
                            alt="UCO Exportindo Consulting"
                            class="img-fluid"
                            style="max-height:200px;filter:drop-shadow(0 15px 25px rgba(0,0,0,.22));">
                        <p class="text-white-50 mt-3 mb-0">
                            We support international buyers and businesses with reliable trade communication and structured inquiry handling.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="soft-card p-4 p-lg-5 h-100">
                    <span class="section-kicker mb-3">Inquiry form</span>
                    <h3 class="fw-bold mb-2">Send your inquiry</h3>
                    <p class="section-text mb-4">
                        Share your product, export, import, or consulting inquiry and our team will get back to you with the relevant information.
                    </p>

                    <form id="inquiry-form" action="<?= base_url('welcome/send_inquiry'); ?>" method="post">
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Full Name</label>
                                <input type="text" name="full_name" class="form-control rounded-4" placeholder="Enter your name" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email Address</label>
                                <input type="email" name="email" class="form-control rounded-4" placeholder="Enter your email" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Phone Number</label>
                                <input type="text" name="phone" class="form-control rounded-4" placeholder="Enter your phone">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Subject</label>
                                <input type="text" name="subject" class="form-control rounded-4" placeholder="Inquiry subject" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Message</label>
                                <textarea name="message" class="form-control rounded-4" rows="6" placeholder="Write your message" required></textarea>
                            </div>

                            <div class="col-12 d-flex flex-wrap gap-3 pt-2">
                                <button type="submit" class="btn btn-dark rounded-pill px-4">Send Inquiry</button>
                                <a href="mailto:<?= e($publicEmail); ?>" class="btn btn-outline-dark rounded-pill px-4">Direct Email</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

        </div>

        <div class="gradient-panel p-4 p-lg-5 text-center">
            <h2 class="section-title text-white mb-3">Let’s build reliable international cooperation</h2>
            <p class="text-white-50 mb-4">
                Contact UCO Exportindo Consulting for commodity inquiries, export coordination, import-export consulting, and long-term business collaboration.
            </p>
            <a href="mailto:<?= e($publicEmail); ?>" class="btn btn-warning cta-btn">Send Inquiry Now</a>
        </div>
    </div>
</section>