<footer class="text-center text-lg-start bg-light text-muted" style="width: 100%">
  <!-- Section: Social media -->
  <div class="row text-center mt-5 py-5 border-top">
    <div class="col">
        <i class="fa-solid fa-truck" style="font-size:90px; color:#1cc88a"></i>
        <div class="mt-3"
            style="color:#000000; font-size:20px; font-weight:600; font-family:Helvetica Neue,Helvetica,Arial,sans-serif;">
            Entrega internacional y rápida</div>
        <div>por transportistas especializados.</div>
    </div>
    <div class="col">
        <i class="fa-solid fa-palette" style="font-size:90px; color:#1cc88a"></i>
        <div class="mt-3"
            style="color:#000000; font-size:20px; font-weight:600; font-family:Helvetica Neue,Helvetica,Arial,sans-serif;">
            Artistas seleccionados
        </div>
        <div>reconocidos y talentosos.</div>
    </div>
    <div class="col">
        <i class="fa-solid fa-lock" style="font-size:90px; color:#1cc88a"></i>
        <div class="mt-3"
            style="color:#000000; font-size:20px; font-weight:600; font-family:Helvetica Neue,Helvetica,Arial,sans-serif;">
            Pagos seguros</div>
        <div>con tarjeta o transferencia.</div>
    </div>
</div>
  <!-- Section: Links  -->
  <section class="p-3 border-bottom border-top">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <img src="\css\img\chani.png" width="220" height="90" alt="">
          </h6>
          <p>
            Lorem ipsum
            dolor sit amet, consectetur adipisicing elit. Lorem ipsum
            dolor sit amet, consectetur adipisicing elit.
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Nuestros estilos
          </h6>
          @forelse($styles as $style)

          <p><a class=" footerLink" href="{{ route('obras.style', $style->id) }}" style="text-decoration:none"> {{
              $style->name }} </a></p>

          @empty
          @endforelse


        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            ¿Quienes Somos?
          </h6>

          <p>
            <a class="footerLink" href="{{ route('info') }}" class="text-reset" style="text-decoration: none">Acerca de
              nosotros</a>
          </p>
          <p>
            <a class="footerLink" href="{{ route('info') }}" class="text-reset" style="text-decoration: none">El
              Equipo</a>
          </p>
          <p>
            <a class="footerLink" href="#!" class="text-reset" style="text-decoration: none">Nuestros Artistas</a>
          </p>
          <p>
            {{-- QUE APAREZCA UN CUADRO PARA MANDAR UN EMAIL --}}
            <a class="footerLink" href="#!" class="text-reset" style="text-decoration: none">Contacto</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Información
          </h6>
          <p><i class="fas fa-home me-3"></i> Zaragoza, Avenida Valencia, 27, Spain</p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            infochani@gmail.com
          </p>
          <p><i class="fas fa-phone me-3"></i> + 34 665 71 37 89</p>
          <p><i class="fas fa-phone me-3"></i> + 976 47 26 23</p>
        </div>
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4 ">
          <span>Encuentranos en nuestras redes sociales:</span>

          <div class="mx-auto mt-2 text-center">
            <a href="" class="me-4 text-reset">
              <i class="fab fa-facebook-f footerLink"></i>
            </a>
            <a href="" class="me-4 text-reset">
              <i class="fab fa-twitter  footerLink"></i>
            </a>
            <a href="" class="me-4 text-reset">
              <i class="fab fa-google  footerLink"></i>
            </a>
            <a href="" class="me-4 text-reset">
              <i class="fab fa-instagram  footerLink"></i>
            </a>
          </div>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2022 Copyright:
    <a class="text-reset fw-bold" href="{{route('home')}}" style="text-decoration: none">CHANI</a>
  </div>
  <!-- Copyright -->
</footer>