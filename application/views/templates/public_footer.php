<?php
$publicCompany = isset($company) && is_array($company) ? $company : [];
$publicCompanyName = $publicCompany['company_name'] ?? 'UCO Exportindo Consulting';
$publicEmail = trim((string)($publicCompany['email'] ?? 'sales@ucoexportindo.com'));
$publicPhone = trim((string)($publicCompany['phone'] ?? ''));
$publicAddress = trim((string)($publicCompany['address'] ?? 'Indonesia'));
?>

<style>
  .uco-public-footer {
    background: #081121;
    color: #cbd5e1;
    overflow: hidden;
  }

  .uco-public-footer a {
    color: #cbd5e1;
    text-decoration: none;
    transition: color .2s ease, transform .2s ease;
  }

  .uco-public-footer a:hover {
    color: #ffffff;
  }

  .uco-public-footer .footer-wrap {
    padding: 76px 0 28px;
  }

  .uco-public-footer .footer-brand-title {
    color: #ffffff;
    font-weight: 800;
    letter-spacing: -.02em;
    margin-bottom: 14px;
  }

  .uco-public-footer .footer-desc {
    max-width: 420px;
    line-height: 1.75;
    margin-bottom: 16px;
  }

  .uco-public-footer .footer-heading {
    color: #ffffff;
    font-size: 15px;
    font-weight: 800;
    margin-bottom: 16px;
  }

  .uco-public-footer .footer-list {
    display: grid;
    gap: 11px;
  }

  .uco-public-footer .footer-contact-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    line-height: 1.55;
  }

  .uco-public-footer .footer-contact-item i {
    width: 18px;
    min-width: 18px;
    margin-top: 4px;
    color: #ffffff;
    text-align: center;
  }

  .uco-public-footer .footer-bottom {
    border-top: 1px solid rgba(148, 163, 184, .25);
    margin-top: 34px;
    padding-top: 22px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    color: rgba(255, 255, 255, .74);
  }

  .uco-public-footer .footer-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 13px;
    border: 1px solid rgba(148, 163, 184, .25);
    border-radius: 999px;
    color: rgba(255, 255, 255, .78);
    background: rgba(255, 255, 255, .04);
    font-size: 13px;
  }

  @media (max-width: 767.98px) {
    .uco-public-footer .footer-wrap {
      padding: 42px 18px 22px !important;
    }

    .uco-public-footer .row {
      row-gap: 30px;
    }

    .uco-public-footer .footer-brand-title {
      font-size: 22px;
    }

    .uco-public-footer .footer-desc {
      font-size: 14.5px;
      line-height: 1.7;
      max-width: 100%;
    }

    .uco-public-footer .footer-heading {
      margin-bottom: 12px;
    }

    .uco-public-footer .footer-list {
      gap: 9px;
      font-size: 14.5px;
    }

    .uco-public-footer .footer-contact-item {
      font-size: 14.5px;
      word-break: break-word;
    }

    .uco-public-footer .footer-bottom {
      display: block;
      margin-top: 28px;
      padding-top: 18px;
      font-size: 13.5px;
      line-height: 1.6;
    }

    .uco-public-footer .footer-badge {
      margin-top: 12px;
    }
  }
</style>

<footer class="uco-public-footer">
  <div class="container footer-wrap">
    <div class="row g-4">
      <div class="col-lg-5 col-md-12">
        <h4 class="footer-brand-title"><?= e($publicCompanyName); ?></h4>
        <p class="footer-desc text-white-50">
          Professional partner for used cooking oil export, structured documentation handling, and sustainable renewable energy supply chain support.
        </p>
        <div class="footer-badge">
          <i class="fa-solid fa-shield-halved"></i>
          <span>Built with trust</span>
        </div>
      </div>

      <div class="col-lg-2 col-md-4 col-6">
        <h6 class="footer-heading">Navigation</h6>
        <div class="footer-list">
          <a href="<?= site_url(); ?>">Home</a>
          <a href="<?= site_url('about'); ?>">About</a>
          <a href="<?= site_url('products'); ?>">Products</a>
          <a href="<?= site_url('contact'); ?>">Contact</a>
        </div>
      </div>

      <!-- <div class="col-lg-2 col-md-4 col-6">
        <h6 class="footer-heading">Core Strengths</h6>
        <div class="footer-list">
          <span>Export-ready documentation</span>
          <span>Global shipment coordination</span>
          <span>Supply consistency support</span>
          <span>Clean corporate presentation</span>
        </div>
      </div> -->

      <div class="col-lg-5 col-md-4 col-12">
        <h6 class="footer-heading">Contact</h6>
        <div class="footer-list">
          <span class="footer-contact-item">
            <i class="fa-solid fa-envelope"></i>
            <span><a href="mailto:<?= e($publicEmail); ?>"><?= e($publicEmail); ?></a></span>
          </span>

          <span class="footer-contact-item">
            <i class="fa-solid fa-envelope"></i>
            <span><a href="mailto:ucoexporindo@gmail.com">ucoexporindo@gmail.com</a></span>
          </span>

          <span class="footer-contact-item">
            <i class="fa-solid fa-location-dot"></i>
            <span><?= nl2br(e($publicAddress)); ?></span>
          </span>

          <?php if ($publicPhone !== ''): ?>
            <span class="footer-contact-item">
              <i class="fa-solid fa-phone"></i>
              <span><?= e($publicPhone); ?></span>
            </span>
          <?php endif; ?>

          <span class="footer-contact-item">
            <i class="fa-solid fa-business-time"></i>
            <span>Mon - Fri, 08:00 - 17:00</span>
          </span>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <div>© <?= date('Y'); ?> <?= e($publicCompanyName); ?>. All Rights Reserved.</div>
      <div class="footer-badge">Trusted export partner</div>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  window.addEventListener('load', function() {
    var p = document.getElementById('preloader');
    if (!p) return;
    setTimeout(function() {
      p.classList.add('hide');
    }, 200);
  });
</script>
</body>

</html>