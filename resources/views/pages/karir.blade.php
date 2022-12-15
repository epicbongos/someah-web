@extends('layout.layout')
@section('title','Karir')
@section('content')
<div class="container-fluid color-gray">

    <!-- judul -->

    <div class="row">
        <div class="container wrapper-container">
            <h1 class="judul-page"><span style="color: #008A85 !important;">Karir</span></h1>
            <hr class="underline-center">
            @if($carrers->isNotEmpty()))
                <p class="ml-5 mr-5 text-center">Kami saat ini mencari orang-orang berbakat yang bersemangat dan
                    bertanggung jawab terhadap pekerjaan mereka untuk mengisi posisi di bawah ini:</p>
            @else
                <p class="ml-5 mr-5 text-center">Maaf untuk saat ini belum ada karir yang tersedia.</p>
            @endif

        </div>
    </div>
    <div class="container">

        <!-- posisi -->

        <div class="row">
            <div class="col-md-12 mb-5">
                <div class="row">
                    @foreach($carrers as $carrer)
                        <div class="col-md-4 item">
                            <h3><b>{{ $carrer->job_position }}</b></h3>

                            @foreach($carrer->tipekarir as $tk)
                            <span>{{$tk->tipe_karir}},</span>
                            @endforeach
                            <a href="{{ url('/karir/detail-karir/' . $carrer->slug) }}" class="btn-apply">Apply</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- mulai proyek -->

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
    .wrapper-container>p {
        margin-left: 5% !important;
        margin-right: 5% !important;
        margin-top: 3% !important;
    }

    .item>h3 {
        font-size: 25px;
    }

    .wrapper-container {
        margin-top: 160px;
    }

    .col-md-4 {
        -ms-flex: 0 0 33.333333%;
        flex: 0 0 31.3% !important;
        max-width: 100%;
        margin-left: 10px;
        margin-right: 10px;
        margin-top: 30px;
        height: 200px;
        padding: 25px;
        background: white;
        border-radius: 30px;
        border: 1px solid #CCCCCC;
    }

    @media (min-width: 992px) and (max-width: 1200px) {
        .col-md-4 {
            flex: 0 0 47.9% !important;
        }
    }

    @media (min-width: 768px) and (max-width: 991px) {
        .col-md-4 {
            flex: 0 0 47.2% !important;
        }
    }

    @media (min-width: 569px) and (max-width: 768px) {
        .col-md-4 {
            flex: 0 0 46.2% !important;
        }

        .col-md-4>h3 {
            font-size: 19px;
        }

    }

    @media (max-width: 568px) {
        .col-md-4 {
            flex: 0 0 95% !important;
        }

        .col-md-4>h3 {
            font-size: 18px;
        }
    }
</style>
@endpush
