@extends('layout.layout')
@section('title')
    {{ $port->portofolio_name }}
@endsection

@section('content')
    <div class="container-fluid wrapper-container">

        <!-- judul -->

        <div class="row mb-5">
            <div class="container">
                <p class="judul-page text-uppercase">{{ $port->portofolio_name }}</p>
            </div>
        </div>

        <!-- ringkasan detail portofolio -->

        <div class="row bg-white pt-4 pb-4 pl-3 pr-3">
            <div class="container">
                <div class="row">
                    <div class="col-5 mr-5 text-layanan">
                        <h5 class="color-gray">Layanan</h5>
                        <h4>
                            <b>
                                @foreach($port->tipeprojects as $tp)
                                    <span>{{$tp->tipe_project}}</span>
                                @endforeach
                            </b>
                        </h4>
                    </div>
                    <div class="col-3 text-tahun">
                        <h5 class="color-gray">Tahun</h5>
                        <h4><b>{{ $port->year }}</b></h4>
                    </div>
                    <div class="col-3 text-klien">
                        <h5 class="color-gray">Klien</h5>
                        <h4><b>{{ $port->client->company_name    }}</b></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">

            <!-- tentang project -->

            <div class="row deskripsi-wrapper">
                <div class="col-3 judul-deskripsi">
                    <h4><b>Tentang Project</b></h4>
                </div>
                <div class="col-9 content-deskripsi mb-3">
                    <p>{{ $port->desc }}</p>
                </div>
            </div>

            <!-- tampilan project -->

            <div class="row section-content">
                <div class="col-3 judul-deskripsi">
                    <h4><b>Tampilan Project</b></h4>
                </div>
                <div class="col-9 content-deskripsi">
                    <img class="w-100 big-img" src="{{ asset('uploaded/portfolio/' . $port->product_img[0]) }}" alt="{{ $port->portofolio_name }}">
                    <div class="images">
                        @foreach ($port->product_img as $img)
                            <img src="{{ asset('uploaded/portfolio/' . $img) }}" alt="{{ $port->portofolio_name }}">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- mulai project -->

    <div class="row top-footer p-5 mb-4 mt-4">
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
        .images {
            max-width: 100%;
            margin-top: 10px;
        }

        .content-deskripsi > img {
            min-width: 120px;
        }

        .images > img {
            max-width: 24%;
            width: 24%;
            min-width: 32px;
            height: auto;
            transition: .2s;
        }

        .images > img.active {
            -webkit-filter: brightness(60%);
            filter: brightness(60%);
        }

        .images > img:hover {
            -webkit-filter: brightness(60%);
            filter: brightness(60%);
            cursor: pointer;
        }

        .images > img:not(:last-child) {
            margin-right: 7px;
        }

        @media (max-width: 1199px) {
            .images > img {
                width: 23.8%;
            }
        }

        @media (max-width: 991px) {
            .images > img {
                width: 23.3%;
            }
        }

        @media (max-width: 779px) {

            .text-layanan,
            .text-tahun,
            .text-klien {
                flex: 0 0 100% !important;
                max-width: 100%;
                margin-top: 10px;
            }

            .col-9.content-deskripsi {
                flex: 0 0 100% !important;
                max-width: 100%;
                margin-bottom: 10px;
            }

            .text-layanan > h4,
            .text-tahun > h4,
            .text-klien > h4 {
                font-size: 22px !important;
            }

            .col-9.content-deskripsi > img {
                flex: 0 0 100% !important;
                max-width: 100%;
                margin-bottom: 10px;
            }

            .section-content {
                margin-top: 30px;
            }

            .col-3.judul-deskripsi {
                flex: 0 0 100% !important;
                max-width: 100%;
                margin-bottom: 20px;
            }

            .col-3.judul-deskripsi:nth-child(2) {
                margin-top: 80px;
            }
        }

        @media (max-width: 567px) {
            .images > img {
                width: 23%;
            }
        }

        @media (max-width: 470px) {

            .images > img {
                width: 22.3%;
            }
        }

        @media (max-width: 388px) {
            .images > img {
                width: 21.5%;
            }
        }

        @media (max-width: 324px) {
            .images > img {
                width: 20%;
            }
        }

    </style>
@endpush

@push('extras-js')
    <script>
      $('.images > img').on('click', function (e) {
        e.preventDefault();
        $('.images > img').css('filter', 'none');
        $(this).css('filter', 'brightness(60%)');
        let src = $(this).attr('src');
        $('.big-img').fadeOut(200);
        $('.big-img').attr('src', src);
        $('.big-img').fadeIn(200);
      })

    </script>
@endpush
