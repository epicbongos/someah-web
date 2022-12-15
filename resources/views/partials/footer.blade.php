<footer>
  <div class="container pt-5">
    <div class="row">
      <div class="col-md-3 color-gray">
        <figure>
            <img src="{{ asset('assets') }}/images/logo/someah-logo-mini.png" alt="Somearch Logo" style="max-width: 200px;" class="img-fluid">
        </figure>
        <div class="mb-4">
          <ul class="list-unstyled">
            <li class="pb-2"><a href="{{@$kontakk->alamat_link}}" target="__blank" class="footer-link">{!!@$kontakk->alamat!!}</a></li>
            <li class="pb-2"><a href="mailto:{{@$kontakk->email}}" class="footer-link">{{@$kontakk->email}}</a></li>
            <li class="pb-2"><a href="https://api.whatsapp.com/send?phone={{@$kontakk->telepon}}" target="__blank" class="footer-link">+{{@$kontakk->telepon}}</a></li>
          </ul>
          <a href="{{@$kontakk->instagram}}" target="_blank" class="footer-link mr-2"><i class="fab fa-instagram fa-2x"></i></a>
          <a href="{{@$kontakk->linkedin}}" target="_blank" class="footer-link color-gray mr-2"><i class="fab fa-linkedin fa-2x"></i></a>
        </div>
      </div>
      <div class="col-md-3 footer-tengah">
        <h4 class="font-weight-bold color-black">Perusahaan</h4>
        <hr class="underline footer">
        <ul class="list-unstyled pt-3">
          <li class="pb-2"><a href="{{ url('/tentang-kami') }}" class="footer-link">Tentang Kami</a></li>
          <li class="pb-2"><a href="{{ url('/portofolio') }}" class="footer-link">Portofolio</a></li>
          <li class="pb-2"><a href="{{ url('/klien') }}" class="footer-link">Klien Kami</a></li>
          <li class="pb-2"><a href="https://products.someah.id/" class="footer-link">Produk</a></li>
          <li class="pb-2"><a href="{{ url('/karir') }}" class="footer-link">Karir</a></li>
          <li class="pb-2"><a href="{{ url('/hubungi-kami') }}" class="footer-link">Kontak</a></li>
        </ul>
      </div>
      <div class="col-md-3 footer-tengah">
        <h4 class="font-weight-bold color-black">Layanan</h4>
        <hr class="underline footer">
        <ul class="list-unstyled pt-3">
          <li class="pb-2"><a href="{{ url('/layanan') }}" class="footer-link">Aplikasi Mobile</a></li>
          <li class="pb-2"><a href="{{ url('/layanan') }}" class="footer-link">Aplikasi Website</a></li>
          <li class="pb-2"><a href="{{ url('/layanan') }}" class="footer-link">Aplikasi Desktop</a></li>
          <li class="pb-2"><a href="{{ url('/layanan') }}" class="footer-link">Sistem Informasi</a></li>
        </ul>
      </div>
      <div class="col-md-3 footer-tengah">
        <h4 class="font-weight-bold color-black">Produk</h4>
        <hr class="underline footer">
        <ul class="list-unstyled pt-3">

        </ul>
      </div>
    </div>
    <hr class="color-gray">
    <p class="color-gray text-center">© 2020 PT. Someah Kreatif Nusantara</p>
  </div>
</footer>
