@extends('layout.layout')
@section('title','Tentang Kami')

@section('content')
    <div class="container-fluid">

        <!-- judul -->
        <div class="row">
            <div class="container wrapper-container">
                <h1 class="judul-page">
                    <span style="color: #008A85;">Tentang</span>
                    Kami
                </h1>
                <hr class="underline-center">
                <p>{{$about->tentang_kami}}</p>
            </div>
        </div>

        <!-- visi misi -->
        <div class="row bg-white p-5 mt-3">
            <div class="container" style="position: relative;">
                <h1 class="judul-page">
                    <span style="color: #008A85;">Visi</span>
                </h1>
                <hr class="underline-center">
                <p class="mb-5">{{$about->visi}}</p>

                <h1 class="judul-page">Misi</h1>
                <hr class="underline-center" style="background-color: #343a40 !important;">

                <div>
                    @php echo htmlspecialchars_decode($about->misi) @endphp
                </div>
            </div>
        </div>
    </div>

    <!-- tim kami -->

    <div class="row mt-4 mb-5">
        <div class="container text-center">
{{--            <p class="judul-page mt-5"><span style="color: #0E9D4B;">Tim</span> Kami</p>--}}
            <p class="judul-page mt-5"><span style="color: #008A85;">Tim</span> Kami</p>
            <hr class="underline-center">
            <p>Kami disebut ahli karena kami memiliki keterampilan, pengetahuan,
                dan keyakinan bahwa penemuan kreatif tidak pernah mengenal batas.</p>

            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                @foreach($teams as $team)
                    <div class="col-md-3 team">
                        <img class="image-profil" style="max-width: 500px; object-fit: cover; object-position: top;" src="{{ asset('uploaded/team/'. $team->photo ) }}" alt="">
                        <h5>{{ $team->name }}</h5>
                        <p>{{ $team->position }}</p>
                    </div>
                @endforeach
            </div>
        </div>

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

                .container-fluid {
                    color: #666666;
                }

                ol.text-left {
                    padding: 0 !important;
                }

                ol > li {
                    padding-left: 10px;
                }

                ol {
                    margin-right: 5px;
                    display: table;
                    margin: auto;
                }

                .image-profil {
                    width: 210px;
                    height: 260px;
                    border-radius: 10px;
                    display: block;
                    margin-left: auto;
                    margin-right: auto;
                    margin-bottom: 20px;
                }

                .team > h5,
                .team > p {
                    text-align: center;
                }

                .team {
                    margin-top: 20px;
                }

                @media (max-width: 991px) {
                    .col-md-3.team {
                        flex: 0 0 50%;
                        max-width: 100%;
                    }
                }

                @media (max-width: 530px) {
                    .wrapper-container {
                        margin-top: 160px;
                    }

                    .top-footer .container > h1 {
                        font-size: 25px;
                    }
                }

                @media (max-width: 458px) {
                    .col-md-3.team {
                        flex: 0 0 100%;
                        max-width: 100%;
                    }
                }

            </style>
        @endpush
