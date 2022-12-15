@extends('layout.layout')
@section('title','Portofolio')

@section('content')
<div class="container-fluid">

    <!-- judul -->

    <div class="row">
        <div class="container wrapper-container">
{{--            <h1 class="text-center mb-3 font-weight-bold text-dark"><span style="color: #0E9D4B;">Portofolio</span> Kami--}}
            <h1 class="text-center mb-3 font-weight-bold text-dark"><span style="color: #008A85;">Portofolio</span> Kami
            </h1>
            <hr class="underline-center">
            <p class="ml-5 mr-5 mt-4 text-center">Perusahaan kami senantiasa memberikan layanan terbaik,
                memenuhi setiap kebutuhan dan mewujudkan apa yang anda harapkan. Berikut ini adalah produk yang telah kami kembangkan.</p>
        </div>
    </div>

    <!-- daftar tombol pilihan aplikasi -->

    <div class="row pilihan-button justify-content-center ml-2">

        <div class="float-left justify-content-center">

            <div class="row pilihan-button justify-content-center d-flex">
                <button class="item-button active-button" id="mobile">Aplikasi Mobile</button>
                <button class="item-button" id="website">Aplikasi Website</button>
                <button class="item-button" id="desktop">Aplikasi Desktop</button>
                <button class="item-button" id="informasi">Sistem Informasi</button>
            </div>

        </div>

        <!-- content aplikasi mobile -->

        <div class="col-12 mt-5 content content-mobile" style="min-height: 300px;">
            <div class="container">
                <div class="row justify-content-center">
                    @foreach($portfolio as $row)
                    @foreach($row->tipeprojects as $tp)
                    @if($tp->id == 1)
                    <div class="col-md-4 mt-4" style="max-width: 23%; flex: 0 0 23%;">
                        <a href="{{ url('portofolio/detail-portfolio/' . $row->slug) }}" class="item-portfolio">
                            <img class="demo-web" src="{{ asset('uploaded/portfolio/' . $row->product_img[0] ) }}" alt="">
                            <h3 class="font-weight-bold text-dark judul-item">{{ $row->portofolio_name }}</h3>
                            <p class="text-dark">{{ $row->keterangan }}</p>
                        </a>
                    </div>
                    @endif
                    @endforeach
                    @endforeach
                </div>
            </div>
        </div>

        <!-- content aplikasi website -->

        <div class="col-12 mt-5 content content-website" style="display: none; min-height: 300px;">
            <div class="container">
                <div class="row justify-content-center">
                    @foreach($portfolio as $row)
                    @foreach($row->tipeprojects as $tp)
                    @if($tp->id == 2)
                    <div class="col-md-4 mt-4" style="max-width: 23%; flex: 0 0 23%;">
                        <a href="{{ url('portofolio/detail-portfolio/' . $row->slug) }}" class="item-portfolio">
                            <img class="demo-web" src="{{ asset('uploaded/portfolio/' . $row->product_img[0] ) }}" alt="">
                            <h3 class="font-weight-bold text-dark judul-item">{{ $row->portofolio_name }}</h3>
                            <p class="text-dark">{{ $row->keterangan }}</p>
                        </a>
                    </div>
                    @endif
                    @endforeach
                    @endforeach
                </div>
            </div>
        </div>

        <!-- content aplikasi desktop -->

        <div class="col-12 mt-5 content content-desktop" style="display: none; min-height: 300px;">
            <div class="container">
                <div class="row justify-content-center">
                    @foreach($portfolio as $row)
                    @foreach($row->tipeprojects as $tp)
                    @if($tp->id == 3)
                    <div class="col-md-4 mt-4" style="max-width: 23%; flex: 0 0 23%;">
                        <a href="{{ url('portofolio/detail-portfolio/' . $row->slug) }}" class="item-portfolio">
                            <img class="demo-web" src="{{ asset('uploaded/portfolio/' . $row->product_img[0] ) }}" alt="">
                            <h3 class="font-weight-bold text-dark judul-item">{{ $row->portofolio_name }}</h3>
                            <p class="text-dark">{{ $row->keterangan }}</p>
                        </a>
                    </div>
                    @endif
                    @endforeach
                    @endforeach
                </div>
            </div>
        </div>

        <!-- content aplikasi informasi -->

        <div class="col-12 mt-5 content content-informasi" style="display: none; min-height: 300px;">
            <div class="container">
                <div class="row justify-content-center">
                    @foreach(@$portfolio as $row)
                        @foreach($row->tipeprojects as $tp)
                            @if($tp->id == 4)
                            <div class="col-md-4 mt-4" style="max-width: 23%; flex: 0 0 23%;">
                                <a href="{{ url('portofolio/detail-portfolio/' . @$row->slug) }}" class="item-portfolio">
                                    <img class="demo-web" src="{{ asset('uploaded/portfolio/' . @$row->product_img[0] ) }}" alt="">
                                    <h3 class="font-weight-bold text-dark judul-item">{{ @$row->portofolio_name }}</h3>
                                    <p class="text-dark">{{ @$row->keterangan }}</p>
                                </a>
                            </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- mulai proyek -->

<div class="row top-footer p-5 mb-4 mt-5">
    <div class="container mt-5 mb-5">
        <h2 class="text-center text-light">Mulai proyek Anda bersama kami</h2><br>
        <a href="{{ url('/estimasi-project') }}">
            Estimasi Proyek
        </a>
    </div>
</div>
@endsection

@push('extras-css')
<style>
    .col-md-4 {
        flex: 0 0 25%;
        max-width: 30%;
        margin-right: 35px;
    }

    .item-portfolio:hover {
        text-decoration: none;
    }

    .item-portfolio:hover>h3 {
        color: #008A85 !important;
    }

    .col-md-4:nth-child(1) {
        margin-left: 38px;
    }

    .col-md-4:hover>.judul-item {
        color: #008A85 !important;
    }

    .pilihan-button>button {
        background: transparent;
        border: 1px solid #008A85;
        color: #008A85;
        margin-right: 20px;
        transition: .3s;
        border-radius: 10px;
        padding: 10px 20px;
    }

    .pilihan-button>button:hover {
        background: #008A85;
        color: white;
    }

    @media (max-width: 991px) {
        .col-md-4 {
            flex: 0 0 40%;
            max-width: 40%;
        }

        .pilihan-button>button {
            width: 130px;
        }

        .pilihan-button>button:nth-child(n+1) {
            margin-top: 10px;
        }
    }

    @media (max-width: 768px) {
        .col-md-4 {
            flex: 0 0 60%;
            max-width: 60%;
        }

        .col-md-4:nth-child(n+1) {
            margin-left: 35px;
        }
    }

    @media (max-width: 667px) {
        .pilihan-button>button {
            width: 110px;
        }

        .pilihan-button>button:nth-child(n+1) {
            margin-top: 10px;
        }
    }

    @media(max-width: 542px) {
        .pilihan-button>button {
            width: 175px;
        }
    }
</style>
@endpush
