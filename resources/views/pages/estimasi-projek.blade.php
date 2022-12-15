@extends('layout.layout2')
@section('title','Hubungi Kami')

@section('content2')
<div class="container-fluid color-gray">

    <!-- judul -->

    <div class="container">
        <div class="col-12">
            <div class="row justify-content-center wrapper-container">
                <p class="judul-page">estimasi proyek</p>
                <p class="desc text-center">Deskripsikan kebutuhan anda pada kolom di bawah ini.
                    Tim kami akan segera menghubungi anda untuk membahas langkah selanjutnya.</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">

                <form action="estimasi-project/store" method="post">

                    {{ csrf_field() }}

                    <!-- layanan apa yang dibutuhkan -->

                    <div class="row">
                        <div class="col-md-2">
                            <hr class="upline">
                            <p class="text-dark judul-section font-weight-bold">Layanan Apa Yang Ada Butuhkan?</p>
                        </div>
                        <div class="col-md-10">
                            <div class="row section-option" style="margin-left: 16px;">
                                <div class="col-md-3">
                                    <label for="appmobile"
                                        class="layanan-item w-100 mr-0 d-flex justify-content-center">
                                        <i class="fas fa-check-circle"></i>
                                        <img src="{{ asset('assets') }}/images/ic_mobile.svg" style="margin-top: -35px;"
                                            alt="">
                                        <h6 class="text-dark text-center font-weight-bold">Aplikasi Mobile</h5>
                                    </label>
                                    <input type="checkbox" name="tipeproject[]" class="tipeproject" id="appmobile"
                                        value="1">
                                </div>
                                <div class="col-md-3">
                                    <label for="appwebsite"
                                        class="layanan-item w-100 mr-0 d-flex justify-content-center">
                                        <i class="fas fa-check-circle"></i>
                                        <img src="{{ asset('assets') }}/images/ic_website.svg"
                                            style="margin-top: -35px;" alt="">
                                        <h6 class="text-dark text-center font-weight-bold">Aplikasi Website</h5>
                                    </label>
                                    <input type="checkbox" name="tipeproject[]" class="tipeproject" id="appwebsite"
                                        value="2">
                                </div>
                                <div class="col-md-3">
                                    <label for="appdesktop"
                                        class="layanan-item w-100 mr-0 d-flex justify-content-center">
                                        <i class="fas fa-check-circle"></i>
                                        <img src="{{ asset('assets') }}/images/ic_desktop.svg"
                                            style="margin-top: -35px;" alt="">
                                        <h6 class="text-dark text-center font-weight-bold">Aplikasi Desktop</h5>
                                    </label>
                                    <input type="checkbox" name="tipeproject[]" class="tipeproject" id="appdesktop"
                                        value="3">
                                </div>
                                <div class="col-md-3">
                                    <label for="sisinformasi"
                                        class="layanan-item w-100 mr-0 d-flex justify-content-center">
                                        <i class="fas fa-check-circle"></i>
                                        <img src="{{ asset('assets') }}/images/ic_is.svg" style="margin-top: -35px;"
                                            alt="">
                                        <h6 class="text-dark text-center font-weight-bold">Sistem Informasi</h5>
                                    </label>
                                    <input type="checkbox" name="tipeproject[]" class="tipeproject" id="sisinformasi"
                                        value="4">
                                </div>
                                @if($errors->has('tipeproject'))
                                <div class="col-md-11">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('tipeproject') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- lingkup proyek -->

                    <div class="row mt-5">
                        <div class="col-md-2">
                            <hr class="upline">
                            <p class="text-dark judul-section font-weight-bold">Apa lingkup proyek anda?</p>
                        </div>

                        <div class="col-md-10">
                            <div class="row ml-3 section-option">
                                <div class="col-md-5">
                                    <label for="lingkupnew" class="lingkup-item w-100 h-100 position-relative">
                                        <p class="text-center text-dark">Membuat aplikasi baru.</p>
                                        <i class="fas fa-check-circle"></i>
                                    </label>
                                    <input type="radio" name="tipelingkup" id="lingkupnew" value="1">
                                </div>
                                <div class="col-md-5">
                                    <label for="lingkupupdate" class="lingkup-item w-100 h-100 position-relative">
                                        <p class="text-center text-dark">Mengembangkan produk/aplikasi yang sudah ada.</p>
                                        <i class="fas fa-check-circle"></i>
                                    </label>
                                    <input type="radio" name="tipelingkup" id="lingkupupdate" value="2">
                                </div>
                                @if($errors->has('tipelingkup'))
                                <div class="col-md-11 mt-3">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('tipelingkup') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- deskripsikan tentang anda -->

                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-2">
                                    <hr class="upline">
                                    <p class="judul-section text-dark font-weight-bold">Deskripsikan tentang anda</p>
                                </div>
                                <div class="col-md-10 form" style="padding-left: 30px;">
                                    <div class="row two-sided">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="namadepan">Nama Anda</label>
                                                <input type="text" class="form-control w-100" placeholder="Nama Anda"
                                                    @if($errors->has('nama')) autofocus @endif
                                                name="nama" id="namadepan" value="{{old('nama')}}" >
                                                @if($errors->has('nama'))
                                                <div class="alert alert-danger alert-dismissible fade show"
                                                    role="alert">
                                                    {{ $errors->first('nama') }}
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="namaperusahaan">Nama Perusahaan</label>
                                                <input type="text" class="form-control w-100"
                                                    placeholder="Nama Perusahaan" name="perusahaan" id="namaperusahaan"
                                                    value="{{old('perusahaan')}}">
                                                @if($errors->has('perusahaan'))
                                                <div class="alert alert-danger alert-dismissible fade show"
                                                    role="alert">
                                                    {{ $errors->first('perusahaan') }}
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="bidangperusahaan">Bidang Perusahaan</label>
                                                <input type="text" class="form-control w-100"
                                                    placeholder="Pakaian, Restoran, dll" name="bidang_perusahaan"
                                                    id="bidangperusahaan" value="{{old('bidang_perusahaan')}}">
                                                @if($errors->has('bidang_perusahaan'))
                                                <div class="alert alert-danger alert-dismissible fade show"
                                                    role="alert">
                                                    {{ $errors->first('bidang_perusahaan') }}
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="alamatsurel">Alamat Email</label>
                                                <input type="text" class="form-control w-100"
                                                    placeholder="Alamat Email Anda/Perusahaan" id="email" name="email"
                                                    value="{{old('email')}}">
                                                @if($errors->has('email'))
                                                <div class="alert alert-danger alert-dismissible fade show"
                                                    role="alert">
                                                    {{ $errors->first('email') }}
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="namaseluler">No. Telepon</label>
                                                <input type="text" class="err form-control w-100"
                                                    value="{{old('nama_seluler')}}"
                                                    placeholder="Nomor Telepon Anda / Perusahaan" name="nama_seluler"
                                                    id="namaseluler">
                                                @if($errors->has('nama_seluler'))
                                                <div class="alert alert-danger alert-dismissible fade show"
                                                    role="alert">
                                                    {{ $errors->first('nama_seluler') }}
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="asalperusahaan">Asal Perusahaan</label>
                                                <input type="text" class="form-control w-100"
                                                    placeholder="Asal Perusahaan" name="asal_perusahaan"
                                                    @if($errors->has('asal_perusahaan')) autofocus="autofocus" @endif
                                                id="asalperusahaan" value="{{old('asal_perusahaan')}}">
                                                @if($errors->has('asal_perusahaan'))
                                                <div class="alert alert-danger alert-dismissible fade show"
                                                    role="alert">
                                                    {{ $errors->first('asal_perusahaan') }}
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="ide_anda" class="mt-3">Ide Anda</label>
                                        <textarea placeholder="Ceritakan Ide Anda Disini" rows="5"
                                            class="form-control custom-textarea" name="ide_anda"
                                            id="ide_anda">{{old('ide_anda')}}</textarea>
                                        @if($errors->has('ide_anda'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $errors->first('ide_anda') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif
                                    </div>
                                    <p class="mt-3">
                                        Someah Kreatif Nusantara akan melindungi data pribadi anda.
                                        Informasi yang disimpan hanya akan digunakan untuk kepentingan mengembangkan ide dan kebutuhan proyek anda.
                                        Kami akan menghubungi anda dan menyampaikan produk dan layanan terbaru kami berdasarkan data yang anda simpan.
                                        Silakan centang kotak di bawah ini, bila anda setuju agar kami segera memproses dan menghubungi anda kembali.
                                    </p>
                                    <label class="check-wrapper mb-4 mt-4">Saya setuju untuk membicarakan proyek saya
                                        dengan Someah Kreatif Nusantara.
                                        <input type="checkbox" name="persetujuan1">
                                        <span class="checkmark"></span>
                                    </label>

                                    <label class="check-wrapper">Saya setuju untuk menerima komunikasi lain dari
                                        Someah Kreatif Nusantara.
                                        <input type="checkbox" name="persetujuan2">
                                        <span class="checkmark"></span>
                                    </label>
                                    <button type="submit" id="btn-estimasi" class="estimasi mt-3">Estimasi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
    @push('extras-css')
    <style>
        .alert alert-danger {
            color: #CC0000;
        }

        input[type="radio"] {
            display: none;
            opacity: 0;
            position: absolute;
        }

        .section-option>.col-md-3 {
            padding-right: 0px !important;
        }

        .layanan-item>h6 {
            bottom: 20px;
            position: absolute;
            width: 76%;
        }

        .swal-footer {
            margin-top: -1px;
            margin-bottom: 4px;
            text-align: center;
        }

        .form-control:focus {
            background: #F5F5F5;
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }

        .col-md-11 {
            flex: 0 0 97% !important;
            max-width: 97% !important;
        }

        @media (min-width: 992px) and (max-width: 1200px) {
            .col-md-3.layanan-item {
                flex: 0 0 23% !important;
                max-width: 40%;
                height: 193px;
            }

            .col-md-2>p {
                font-size: 23px;
            }

            .layanan-item>h5 {
                margin-top: 4px;
                font-size: 14px;
            }

            .layanan-item>img {
                width: 120px;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            .lingkup-item>p {
                font-size: 16px;
            }

            .col-md-10 {
                flex: 0 0 80%;
                max-width: 80%;
            }

            .col-md-3.layanan-item {
                flex: 0 0 47% !important;
                max-width: 100%;
                margin-right: 15px;
                height: 180px;
            }

            .col-md-3.layanan-item:nth-child(n+3) {
                margin-top: 10px;
            }

            .col-md-5>label {
                margin-right: 0px !important;
                margin-bottom: 0px !important;
            }

            .col-md-5 {
                padding-right: 0px !important;
                flex: 0 0 50% !important;
                max-width: 50%;
                height: 150px;
            }

            .col-md-2>p {
                font-size: 16px;
            }

            .layanan-item>h5 {
                margin-top: 20px;
                font-size: 16px;
            }

            .layanan-item>img {
                width: 110px;
            }
        }

        @media (max-width: 768px) {

            .form .two-sided .col {
                flex: 0 0 100% !important;
                max-width: 100%;
            }

            .col-md-10 {
                padding-left: 0px !important;
            }

            .col-md-2 {
                padding-left: 0px !important;
                flex: 0 0 100% !important;
                max-width: 100%;
            }

            .row.two-sided>.col {
                padding-left: 0px !important;
            }

            .row,
            .col-md-10.form {
                padding-left: 0px !important;
                margin-left: 0px !important;
            }

            .col-md-3:nth-child(n+2),
            .col-md-5:nth-child(n+2) {
                margin-top: 30px;
            }

            .col-md-3,
            .col-md-5 {
                padding-left: 0px !important;
                flex: 0 0 94% !important;
                max-width: 94%;
            }

            .col-md-10 {
                flex: 0 0 100% !important;
                max-width: 100%;
            }
        }

        @media (max-width: 368px) {
            .judul-section {
                font-weight: 500;
                font-size: 18pt !important;
            }

            .col-md-12 {
                padding-left: 0px !important;
                margin-left: 0px !important;
            }
        }

        @media (max-width: 273px) {
            .col-md-3>img {
                width: 100px;
            }

            .col-md-3>h5 {
                font-size: 14px;
            }

            .col-md-3,
            .col-md-5 {
                height: 170px;
            }

            .judul-section {
                font-size: 17pt !important;
            }
        }
    </style>
    @endpush

    @push('extras-js')
    <script>
        $('#btn-estimasi').click(function () {
            if ($("input[name=persetujuan1]").prop('checked') == false || $("input[name=persetujuan2]").prop(
                    'checked') == false) {
                swal({
                    icon: 'error',
                    title: 'Error',
                    text: 'Klik Persetujuan Terlebih Dahulu',
                });
                return false;
            }
        });

        $(document).on('click', '.tipeproject', function () {
            if ($(this).prop('checked') == true) {
                $(this).prev().addClass('active');
                $(this).prev().find("i").css('display', 'block');
            } else {
                $(this).prev().removeClass('active');
                $(this).prev().find("i").css('display', 'none');
            }
        })

        $('.lingkup-item').on('click', function () {
            $('.lingkup-item').removeClass('active');
            $('.lingkup-item > i').css('display', 'none');
            $(this).addClass('active');
            $(this).find("i").css('display', 'block');
        })
    </script>
    @endpush
