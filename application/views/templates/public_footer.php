<footer style="background:#081121;color:#cbd5e1;">
  <div class="container" style="padding:80px 0 26px;">
    <div class="row g-4">
      <div class="col-lg-4">
        <h4 class="text-white fw-bold mb-3">UCO Trading Solution</h4>
        <p class="mb-3">Professional partner for used cooking oil export, structured documentation handling, and sustainable renewable energy supply chain support.</p>
        <div class="small-muted text-white-50">Built for a more trusted and informative trading presence.</div>
      </div>
      <div class="col-lg-2 col-md-4">
        <h6 class="text-white fw-bold mb-3">Navigation</h6>
        <div class="d-grid gap-2">
          <a href="<?= site_url(); ?>" class="text-light-emphasis">Home</a>
          <a href="<?= site_url('about'); ?>" class="text-light-emphasis">About</a>
          <a href="<?= site_url('products'); ?>" class="text-light-emphasis">Products</a>
          <a href="<?= site_url('contact'); ?>" class="text-light-emphasis">Contact</a>
        </div>
      </div>
      <div class="col-lg-3 col-md-4">
        <h6 class="text-white fw-bold mb-3">Core strengths</h6>
        <div class="d-grid gap-2">
          <span>Export-ready documentation</span>
          <span>Global shipment coordination</span>
          <span>Supply consistency support</span>
          <span>Clean corporate presentation</span>
        </div>
      </div>
      <div class="col-lg-3 col-md-4">
        <h6 class="text-white fw-bold mb-3">Contact</h6>
        <div class="d-grid gap-2">
          <span><i class="fa-solid fa-envelope me-2"></i>sales@ucotradingsolution.com</span>
          <span><i class="fa-solid fa-location-dot me-2"></i>Indonesia</span>
          <span><i class="fa-solid fa-business-time me-2"></i>Mon - Fri, 08:00 - 17:00</span>
        </div>
      </div>
    </div>
    <div class="d-flex flex-wrap justify-content-between align-items-center pt-4 mt-4 border-top border-secondary-subtle">
      <div>© <?= date('Y'); ?> UCO Trading Solution. All Rights Reserved.</div>
      <div class="small-muted text-white-50">V4 public refresh — trusted export website style</div>
    </div>
  </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
window.addEventListener('load', function(){
  var p = document.getElementById('preloader');
  if (!p) return;
  setTimeout(function(){ p.classList.add('hide'); }, 200);
});
</script>
</body>
</html>
