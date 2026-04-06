<section class="page-hero">
    <div class="container text-center">
        <span class="section-kicker">Our products</span>
        <h1 class="section-title">Export-ready products with cleaner corporate display</h1>
        <p class="section-text mx-auto" style="max-width:760px;">Halaman produk dibuat lebih premium supaya calon buyer lebih mudah membaca daftar produk dan menangkap positioning bisnis kamu.</p>
    </div>
</section>

<section class="section-space pt-0" style="background:var(--pub-soft);">
    <div class="container">
        <div class="row g-4">
            <?php if (!$products): ?>
                <div class="col-12">
                    <div class="soft-card p-5 text-center">
                        <h4 class="fw-bold mb-2">No products yet</h4>
                        <p class="section-text mb-0">Data produk belum tersedia. Tambahkan dari admin panel untuk menampilkan katalog publik.</p>
                    </div>
                </div>
            <?php else: foreach ($products as $p): ?>
                <div class="col-md-6 col-xl-4">
                    <div class="soft-card product-card overflow-hidden">
                        <div class="p-4 pb-0 d-flex justify-content-between align-items-start gap-3">
                            <span class="section-kicker"><?= e($p['code']); ?></span>
                            <span class="badge text-bg-warning rounded-pill px-3 py-2">UCO Product</span>
                        </div>
                        <div class="text-center px-4 pt-3">
                            <img src="<?= base_url('assets/img/uco.png'); ?>" class="img-fluid" alt="<?= e($p['product_name']); ?>" style="max-height:200px;filter:drop-shadow(0 14px 24px rgba(0,0,0,.14));">
                        </div>
                        <div class="p-4">
                            <h4 class="fw-bold mb-2"><?= e($p['product_name']); ?></h4>
                            <p class="section-text mb-4" style="min-height:72px;"><?= e($p['description']); ?></p>
                            <div class="d-flex justify-content-between align-items-end pt-3 border-top">
                                <div>
                                    <div class="small-muted">Indicative price</div>
                                    <div class="fw-bold fs-4 text-success"><?= format_money($p['sales_price']); ?></div>
                                </div>
                                <a href="<?= site_url('contact'); ?>" class="btn btn-outline-dark rounded-pill px-4">Contact</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</section>
