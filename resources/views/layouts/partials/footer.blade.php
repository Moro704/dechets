@if(!request()->routeIs('dashboard'))
<footer class="content-footer footer bg-footer-theme text-dark py-4 border-top">
  <div class="container-xxl d-flex flex-wrap justify-content-between align-items-center flex-md-row flex-column">

    <!-- Section gauche : copyright + slogan -->
    <div class="mb-3 mb-md-0 text-center text-md-start">
      <span class="fw-bold">© {{ date('Y') }} EcoFlux</span>
      <span class="ms-2 text-muted">| Pour une gestion responsable des déchets ♻️</span>
    </div>

    <!-- Section droite : liens rapides -->
    <div class="d-flex flex-wrap justify-content-center justify-content-md-end align-items-center">
      <a href="/license" class="footer-link text-dark me-3 mb-2"><i class="bx bx-file me-1"></i>License</a>
      <a href="/more-themes" class="footer-link text-dark me-3 mb-2"><i class="bx bx-palette me-1"></i>More Themes</a>
      <a href="/documentation" class="footer-link text-dark me-3 mb-2"><i class="bx bx-book me-1"></i>Documentation</a>
      <a href="/support" class="footer-link text-dark me-3 mb-2"><i class="bx bx-support me-1"></i>Support</a>
    </div>
    <!-- Section icônes sociales -->
    <div class="d-flex justify-content-center mt-3 mt-md-0">
      <a href="#" class="text-dark me-3 fs-5"><i class="bx bxl-facebook-square"></i></a>
      <a href="#" class="text-dark me-3 fs-5"><i class="bx bxl-twitter"></i></a>
      <a href="#" class="text-dark me-3 fs-5"><i class="bx bxl-linkedin-square"></i></a>
      <a href="#" class="text-dark fs-5"><i class="bx bxl-github"></i></a>
    </div>
  </div>
</footer>
@endif
