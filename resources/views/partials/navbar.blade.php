<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-nav">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img class="nav-logo" src="{{ asset('assets') }}/images/logo/someah-logo-white-mini.png" style="max-width: 160px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown-7"
            aria-controls="navbarNavDropdown-7" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown-7">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mx-4"><a class="nav-link" href="{{ url('/tentang-kami') }}">Tentang Kami</a></li>
                <li class="nav-item mx-4"><a class="nav-link" href="{{ url('/layanan') }}">Layanan</a></li>
                <li class="nav-item mx-4"><a class="nav-link" href="{{ url('/portofolio') }}">Portofolio</a></li>
                <li class="nav-item mx-4"><a class="nav-link" href="https://products.someah.id/">Produk</a></li>
                <li class="nav-item mx-4"><a class="nav-link" href="{{ url('/klien') }}">Klien</a></li>
                <li class="nav-item mx-4"><a class="nav-link" href="{{ url('/hubungi-kami') }}">Kontak</a></li>
            </ul>
            <!-- <a class="btn btn-white btn-hubungikami mx-4" href="{{ url('/hubungi-kami') }}">Hubungi Kami</a> -->
        </div>
    </div>
</nav>
