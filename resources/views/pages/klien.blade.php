@extends('layout.layout')
@section('title','Klien Kami')

@section('content')
<div class="container-fluid color-gray">

    <!-- judul -->

    <div class="row">
        <div class="container wrapper-container">
{{--            <p class="judul-page"><span style="color: #0E9D4B;">Klien</span> Kami</p>--}}
            <p class="judul-page"><span style="color: #008A85;">Klien</span> Kami</p>
            <hr class="underline-center">
            <p class="ml-5 mr-5 mt-4 text-center">Puluhan klien telah mempercayakan kebutuhan solusi digital dan IT nya
                kepada kami, dari berbagai kategori bisnis dan segmen. Berikut ini adalah beberapa klien yang telah
                bekerjasama dengan kami:</p>
        </div>
    </div>
    <div class="container">

        <!-- daftar klien -->

        <div class="row">
            <div class="col-12 mb-5">
                <div class="row justify-content-center">
                    @foreach($clients as $client)
                    <div class="col-md-3 item-klien">
                        <a href="{{ url('/klien/detail-klien/' . $client->slug) }}">
                            <img src="{{ asset('uploaded/client/' . $client->mini_logo) }}" class="img-fluid"
                                alt="{{ $client->company_name }}">
                        </a>
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
    .item-klien {
        display: flex;
        justify-content: center;
        margin-top: 15px;
    }

    @media (max-width: 468px) {
        .wrapper-container {
            margin-top: 160px;
            margin-bottom: 30px;
        }

        .top-footer .container>h1 {
            font-size: 28px;
        }
    }

    @media (min-width: 469px) and (max-width: 768px) {
        .item-klien {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }

</style>
@endpush
