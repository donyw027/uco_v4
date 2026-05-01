<section class="page-hero">
    <div class="container text-center">
        <span class="section-kicker">Our products & services</span>
        <h1 class="section-title">Export products and trade support from Indonesia</h1>
        <p class="section-text mx-auto" style="max-width:760px;">
            Explore our product offerings and business support services designed to help international buyers and partners work with Indonesian suppliers more efficiently.
        </p>
    </div>
</section>

<section class="section-space pt-0" style="background:var(--pub-soft);">
    <div class="container">
        <div class="row g-4">
            <?php if (!$products): ?>
                <div class="col-12">
                    <div class="soft-card p-5 text-center">
                        <h4 class="fw-bold mb-2">No listings available yet</h4>
                        <p class="section-text mb-0">
                            Product or service information is not available at the moment. Please contact us directly for export, import, or consulting inquiries.
                        </p>
                    </div>
                </div>
                <?php else: foreach ($products as $p): ?>
                    <div class="col-md-6 col-xl-4">
                        <div class="soft-card product-card overflow-hidden">
                            <div class="p-4 pb-0 d-flex justify-content-between align-items-start gap-3">
                                <span class="section-kicker"><?= e($p['code']); ?></span>
                                <span class="badge text-bg-warning rounded-pill px-3 py-2">Product / Service</span>
                            </div>

                            <div class="text-center px-4 pt-3">
                                <?php
                                $productImage = trim((string)($p['image'] ?? ''));

                                $productImageUrl = ($productImage !== '' && file_exists(FCPATH . 'uploads/products/' . $productImage))
                                    ? base_url('uploads/products/' . $productImage)
                                    : base_url('assets/img/uco1.png');
                                ?>

                                <img src="<?= $productImageUrl; ?>"
                                    class="img-fluid"
                                    alt="<?= e($p['product_name']); ?>"
                                    style="height:200px;width:100%;object-fit:contain;filter:drop-shadow(0 14px 24px rgba(0,0,0,.14));">
                            </div>

                            <div class="p-4">
                                <h4 class="fw-bold mb-2"><?= e($p['product_name']); ?></h4>
                                <p class="section-text mb-4" style="min-height:72px;"><?= e($p['description']); ?></p>

                                <div class="d-flex justify-content-between align-items-end pt-3 border-top">
                                    <div>
                                        <div class="small-muted">Price information</div>
                                        <div class="fw-bold fs-6 text-success">
                                            Contact us for details
                                        </div>
                                    </div>
                                    <a href="<?= site_url('contact'); ?>" class="btn btn-outline-dark rounded-pill px-4">Contact</a>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php endforeach;
            endif; ?>
        </div>
    </div>
</section>