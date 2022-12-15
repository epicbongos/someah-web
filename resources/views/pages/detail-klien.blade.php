@extends('layout.layout')
@section('title','Detail Klien')

@section('content')

<div class="container-fluid" style="margin-top: 200px;">
    <div class="container">
        <div class="row">
            <div class="col-md-4 img" style="margin-left: 7%;">
                <img src="{{ asset('uploaded/client/' . $client->mini_logo) }}" style="width: 95%;" alt="">
            </div>
            <div class="col-md-7">
                <h3 class="text-uppercase text-left" style="font-weight: 600;">{{ $client->company_name }}</h3>
                <h6 class="mt-4 font-weight-bold" style="font-size: 18px;">Tentang Klien</h6>
                <p class="mt-3" style="color: #7E8387;">{{ $client->desc }}</p>

                <h6 class="mt-4 font-weight-bold" style="font-size: 18px;">Website Klien</h6>
                <a class="mt-4" href="{{ $client->website }}" target="__blank">{{ $client->website }}</a>
            </div>
        </div>
    </div>

    <div class="row justify-content-center pb-5 pt-5 mt-5" style="background: white;">
        <div class="container">
            <div class="row justify-content-center">
                @foreach($portfolio as $port)
                    <div class="col-md-4 mt-4">
                        <img class="demo-web" src="{{ asset('uploaded/portfolio/' . $port->product_img[0] ) }}" alt="">
                        <h3 class="font-weight-bold text-dark judul-item">{{ $port->portofolio_name }}</h3>
                        <p>{{ $port->keterangan }}</p>
                    </div>
                @endforeach
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
        flex: 0 0 27%;
        max-width: 27%;
        margin-right: 30px;
    }

    .row .col-md-4:nth-child(3) {
        margin-right: 0px !important;
    }

    @media screen and (max-width: 767px) {
        .col-md-4.img {
            margin-left: 0px !important;
            flex: 0 0 100% !important;
            max-width: 100% !important;
            margin-bottom: 50px;
            padding-right: 0px !important;
            margin-right: 0px !important;
        }
    }

    @media screen and (max-width: 571px) {
        .col-md-4.mt-4 {
            flex: 0 0 100% !important;
            max-width: 100% !important;
            margin-left: 25% !important;
            margin-right: 25% !important;
        }

        .row .col-md-4:nth-child(3) {
            flex: 0 0 96% !important;
            padding-left: 0px !important;
            margin-left: 30% !important;
            margin-right: 27% !important;
        }
    }
</style>
@endpush
