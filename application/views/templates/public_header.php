<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= e($title ?? 'UCO Trading Solution'); ?></title>
  <link rel="icon" href="<?= base_url('assets/img/favicon.png'); ?>">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <style>
    :root {
      --pub-navy: #081121;
      --pub-blue: #0f3d91;
      --pub-cyan: #0ea5e9;
      --pub-gold: #fbbf24;
      --pub-soft: #f8fbff;
      --pub-text: #0f172a;
      --pub-muted: #64748b;
      --pub-line: #e2e8f0;
      --pub-shadow: 0 22px 60px rgba(15, 23, 42, .10);
    }

    body {
      font-family: Poppins, sans-serif;
      background: #fff;
      color: var(--pub-text)
    }

    .topbar {
      background: linear-gradient(90deg, #07111f, #0f2650);
      color: #dbeafe;
      font-size: 13px
    }

    .topbar a {
      color: #dbeafe;
      text-decoration: none
    }

    .site-header {
      position: sticky;
      top: 0;
      z-index: 999;
      background: rgba(255, 255, 255, .92);
      backdrop-filter: blur(12px);
      border-bottom: 1px solid rgba(15, 23, 42, .05)
    }

    .navbar-brand {
      font-weight: 800;
      font-size: 1.15rem;
      color: var(--pub-navy)
    }

    .navbar-brand span {
      color: var(--pub-blue)
    }

    .nav-link {
      font-weight: 600;
      color: #334155 !important
    }

    .nav-link:hover {
      color: var(--pub-blue) !important
    }

    .btn-quote {
      background: linear-gradient(135deg, #0f172a, #0f3d91);
      color: #fff;
      border: none;
      border-radius: 999px;
      padding: .72rem 1.15rem;
      font-weight: 600
    }

    .btn-quote:hover {
      color: #fff;
      opacity: .96
    }

    .hero-shell {
      position: relative;
      overflow: hidden;
      background: linear-gradient(135deg, #06101f 0%, #0c2045 45%, #0f3d91 100%)
    }

    .hero-shell:before {
      content: "";
      position: absolute;
      width: 520px;
      height: 520px;
      border-radius: 50%;
      top: -180px;
      right: -140px;
      background: radial-gradient(circle, rgba(14, 165, 233, .28), transparent 65%)
    }

    .hero-shell:after {
      content: "";
      position: absolute;
      width: 380px;
      height: 380px;
      border-radius: 50%;
      bottom: -180px;
      left: -120px;
      background: radial-gradient(circle, rgba(251, 191, 36, .18), transparent 64%)
    }

    .hero-label {
      display: inline-flex;
      gap: 8px;
      align-items: center;
      padding: 10px 16px;
      border-radius: 999px;
      background: rgba(255, 255, 255, .12);
      color: #fff;
      border: 1px solid rgba(255, 255, 255, .12);
      font-size: 12px;
      font-weight: 600
    }

    .hero-title {
      font-size: clamp(2.15rem, 5vw, 4.3rem);
      font-weight: 800;
      line-height: 1.06;
      color: #fff
    }

    .hero-text {
      color: rgba(255, 255, 255, .78);
      font-size: 1.04rem
    }

    .hero-panel,
    .soft-card {
      background: #fff;
      border-radius: 28px;
      box-shadow: var(--pub-shadow);
      border: 1px solid rgba(15, 23, 42, .05)
    }

    .hero-metric {
      padding: 16px 18px;
      border-radius: 20px;
      background: rgba(255, 255, 255, .08);
      border: 1px solid rgba(255, 255, 255, .10);
      color: #fff
    }

    .hero-metric .num {
      font-size: 1.7rem;
      font-weight: 700;
      line-height: 1;
      margin-bottom: 5px
    }

    .section-space {
      padding: 90px 0
    }

    .section-kicker {
      display: inline-flex;
      padding: 8px 14px;
      border-radius: 999px;
      background: #eff6ff;
      color: #1d4ed8;
      font-size: 12px;
      font-weight: 700;
      letter-spacing: .03em;
      text-transform: uppercase
    }

    .section-title {
      font-size: clamp(1.75rem, 3vw, 2.6rem);
      font-weight: 800;
      margin: 14px 0 10px
    }

    .section-text {
      color: var(--pub-muted)
    }

    .icon-badge {
      width: 58px;
      height: 58px;
      border-radius: 18px;
      background: linear-gradient(135deg, #dbeafe, #eff6ff);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #0f3d91;
      font-size: 22px
    }

    .feature-card,
    .trust-card,
    .timeline-card,
    .contact-tile,
    .product-card {
      height: 100%;
      transition: .25s ease
    }

    .feature-card:hover,
    .trust-card:hover,
    .timeline-card:hover,
    .contact-tile:hover,
    .product-card:hover {
      transform: translateY(-6px)
    }

    .gradient-panel {
      background: linear-gradient(135deg, #081121, #0f2650 48%, #0ea5e9 180%);
      color: #fff;
      border-radius: 28px;
      box-shadow: var(--pub-shadow)
    }

    .cta-btn {
      border-radius: 999px;
      padding: .85rem 1.25rem;
      font-weight: 700
    }

    footer a {
      text-decoration: none
    }

    .page-hero {
      padding: 88px 0 54px;
      background: linear-gradient(180deg, #f8fbff 0%, #fff 100%)
    }

    .small-muted {
      color: var(--pub-muted);
      font-size: 13px
    }

    #preloader {
      position: fixed;
      inset: 0;
      background: #fff;
      z-index: 99999;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: opacity .35s ease, visibility .35s ease
    }

    #preloader.hide {
      opacity: 0;
      visibility: hidden
    }

    .loader-logo {
      width: 155px;
      max-width: 34vw;
      animation: floatPulse 1.55s ease-in-out infinite
    }

    @keyframes floatPulse {
      0% {
        transform: scale(1) translateY(0)
      }

      50% {
        transform: scale(1.06) translateY(-4px)
      }

      100% {
        transform: scale(1) translateY(0)
      }
    }

    @media(max-width:991.98px) {
      .section-space {
        padding: 70px 0
      }

      .site-header .navbar-collapse {
        padding-top: 14px
      }
    }
  </style>
</head>

<body>
  <div id="preloader"><img src="<?= base_url('assets/img/uco.png'); ?>" class="loader-logo" alt="UCO"></div>
  <div class="topbar py-2">
    <div class="container d-flex flex-wrap justify-content-between gap-2">
      <div><i class="fa-solid fa-envelope me-2"></i><a href="mailto:sales@ucotradingsolution.com">sales@ucotradingsolution.com</a></div>
      <div><i class="fa-solid fa-globe me-2"></i>Reliable partner for used cooking oil export and documentation flow</div>
    </div>
  </div>
  <header class="site-header">
    <nav class="navbar navbar-expand-lg py-3">
      <div class="container">
        <a href="<?= site_url(); ?>" class="navbar-brand">UCO <span>Trading Solution</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="mainNav">
          <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
            <li class="nav-item"><a class="nav-link" href="<?= site_url(); ?>">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= site_url('about'); ?>">About</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= site_url('products'); ?>">Products</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= site_url('contact'); ?>">Contact</a></li>
            <li class="nav-item ms-lg-2"><a href="mailto:sales@ucotradingsolution.com" class="btn btn-quote">Send Inquiry</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </header>