@extends('layout.layout')
@section('title','Layanan Kami')

@section('content')

<div class="container-fluid">

    <!-- judul -->

    <div class="row">
        <div class="container wrapper-container">
{{--            <p class="judul-page"><span style="color: #0E9D4B;">Aplikasi</span> Website</p>--}}

            <p class="judul-page">{{$tipe->tipe_project}}</p>
            <hr class="underline-center">
            <p class="ml-5 mr-5 mt-5 text-center">{{$tipe->desc}}</p>
        </div>

    </div>

    <div class="container section-keahlian-option mb-5 mt-5">

        <!-- teknologi -->

        <div class="row  justify-content-center">
            @foreach($tipe->tipe_project_detail as $value)

            <div class="col-md-2">
                <div class="text-center">
                    <img data-toggle="tooltip" data-placement="bottom" title="{{$value->bahasa_pemrograman}}"
                         src="{{asset('uploaded/tipe_project/'.$value->logo)}}" class="" style="width: 80%;padding: 15px;"/>
                </div>
            </div>
            @endforeach
{{--            <div class="col-md-3 item">--}}
{{--                <div class="logowrapper-dlayanan">--}}
{{--                    <i class="fab fa-vuejs"></i>--}}
{{--                </div>--}}
{{--                <div class="ket text-center">--}}
{{--                    <h4 class="mb-3"><b>Vue.js</b></h4>--}}
{{--                    <p>--}}
{{--                        Menerapkan antarmuka pengguna yang cantik dan responsif yang sangat interaktif dan memberi--}}
{{--                        pengguna--}}
{{--                        pengalaman seperti aslinya.</p>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>

    <!-- contoh website -->

    <div class="row bg-lgrey p-5">
        <div class="container">
            <h1 class="text-center font-weight-bold mt-4 mb-3 text-contohwebsite"><span>Contoh</span> Aplikasi</h1>
            <hr class="underline-center">
            <div class="row mt-4 contoh-web justify-content-center">
                @foreach($port as $val)
{{--                {{dd($val)}}--}}
                <div class="col-md-4 item-contoh-web">
                    <img class="demo-web" src="{{ asset('uploaded/portfolio/' . $val->portofolio->product_img[0]) }}" alt="">
                    <h3><b><a href="{{ url('portofolio/detail-portfolio/' . $val->portofolio->slug) }}">{{$val->portofolio->portofolio_name}}</a></b></h3>
                    <p>{{$val->portofolio->desc}}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Mulai proyek -->

<div class="row top-footer p-5 mb-4">
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
    body {
        background: white !important;
    }

    .item:hover .logowrapper-dlayanan>i,
    .item:hover .ket>h4 {
        color: #008A85;
    }

    .col-md-4.item-contoh-web {

        -ms-flex: 0 0 28%;
        flex: 0 0 29% !important;
        max-width: 30% !important;
    }

    .col-md-4.item-contoh-web:not(:last-child) {
        margin-right: 45px;
    }

    .col-md-3.item {

        -ms-flex: 0 0 25%;
        flex: 0 0 33% !important;
        max-width: 100% !important;
    }

    @media (max-width: 991px) {

        .col-md-3.item {

            -ms-flex: 0 0 25%;
            flex: 0 0 100% !important;
            max-width: 100% !important;
            margin-right: 0% !important;
        }

        .col-md-3.item:not(:first-child) {
            margin-top: 20px;
        }

        .wrapper-container>p:not(.judul-page) {
            font-size: 15px !important;
            margin-top: 40px !important;
            margin-left: 25px !important;
            margin-right: 25px !important;
        }

        .col-md-4.item-contoh-web {

            -ms-flex: 0 0 100%;
            flex: 0 0 52% !important;
            max-width: 52% !important;
            min-width: 250px;
        }

        .col-md-4.item-contoh-web:not(:last-child) {
            margin-bottom: 35px;
            margin-right: 0% !important;
        }

        .contoh-web {
            margin-top: -30px !important;
        }

        .text-contohwebsite {
            font-size: 26px;
        }
    }

</style>
@endpush
@push('extras-js')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endpush
