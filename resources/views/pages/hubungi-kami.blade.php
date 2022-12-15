@extends('layout.layout')
@section('title','Hubungi Kami')
@section('content')

<div class="container-fluid" style="background: #FAFAFA;">

    <!-- judul -->

    <div class="row">
        <div class="container wrapper-container">
{{--            <p class="judul-page"><span style="color: #0E9D4B;">Kontak Kami</p>--}}
            <p class="judul-page"><span style="color: #008A85;">Kontak Kami</p>
            <hr class="underline-center">
            <p class="mt-4 text-center deskripsi-header" style="color: #7E8387; margin-left: 20%; margin-right: 20%;">
                Segera kontak kami
                melalui beberapa pilihan kontak di bawah untuk mendiskusikan detil dari project Anda.</p>
        </div>
    </div>

    <div class="row" style="background: white; padding-top: 50px; padding-bottom: 35px;">
        <div class="container">
            <div class="row">
                <div class="col-md-3 item-kontak">
                    <h6 style="color: #7E8387 !important;">Alamat</h6>
                    <p><a href="{{$kontakk->alamat_link}}" target="__blank">{!!@$kontakk->alamat!!}</a></p>
                </div>
                <div class="col-md-3 item-kontak">
                    <h6 style="color: #7E8387 !important;">Surel</h6>
                    <p><a href="mailto:{{@$kontakk->email}}">{{$kontakk->email}}</a></p>
                </div>
                <div class="col-md-3 item-kontak">
                    <h6 style="color: #7E8387 !important;">Kontak Langsung</h6>
                    <p><a href="https://api.whatsapp.com/send?phone={{@$kontakk->telepon}}" target="__blank">+{{@$kontakk->telepon}}</a>
                    </p>
                </div>
                <div class="col-md-3 item-kontak">
                    <h6 style="color: #7E8387 !important;">Sosial Media</h6>
                    <a href="{{@$kontakk->instagram}}" target="__blank" class="float-left mr-2 pr-1">
                        <i class="fab fa-instagram fa-2x" aria-hidden="true"></i>
                    </a>
                    <a href="{{@$kontakk->linkedin}}" target="__blank" class="float-left">
                        <i class="fab fa-linkedin fa-2x" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container justify-content-center d-flex mt-5 mb-5">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.067779898005!2d107.61267111449959!3d-6.882484069257308!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e9ccfaa20b87%3A0x737853f7eedf64a9!2sSomearch%20Nusantara!5e0!3m2!1sen!2sid!4v1577679131823!5m2!1sen!2sid"
            width="80%" height="450" frameborder="0" style="border:0;" allowfullscreen="true"></iframe>
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
    .item-kontak>p>a:hover,
    .item-kontak>a:hover>i {
        color: #008A85;
    }

    @media screen and (max-width: 991px) {
        .deskripsi-header {
            margin-left: 5% !important;
            margin-right: 5% !important;
        }
    }
</style>
@endpush
