@extends('layout.layout')
@section('title','Detail karir')

@section('content')
<div class="container-fluid color-gray">

    <!-- Judul -->

    <div class="row mb-4">
        <div class="container wrapper-container text-center">
            <p class="judul-page">{{ $karir->job_position }}</p>
            <p class="mt-3">
                @foreach($karir->tipekarir as $tk)
                <span>{{$tk->tipe_karir}},</span>
                @endforeach
            </p>
        </div>
    </div>

    <!-- penjelasan back end developer -->

    <div class="row">
        <div class="container">
            <div class="row card-detailkarir p-5">
                <div>
                @php echo htmlspecialchars_decode($karir->desc) @endphp
                </div>
                <div class="container">
                    <hr class="underline-dotted mb-4 mt-4">
                    <h4 class="font-weight-bold color-darkgreen mb-5 mt-5 text-capitalize">lamar pekerjaan ini</h4>
                    <form action="{{ url('karir/detail-karir/store') }}" method="post" enctype="multipart/form-data"
                        id="myform">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="namadepan" for="namadepan">Nama Depan</label>
                                    <input type="hidden" name="karir_id" value="{{$karir->id}}">
                                    <input type="text" class="w-100 form-control " placeholder="Nama Depan Anda"
                                        name="namadepan" id="namadepan" value="{{ old('namadepan') }}">
                                    @if($errors->has('namadepan'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('namadepan') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @endif
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="namabelakang">Nama Belakang</label>
                                    <input type="text" class="w-100 form-control " placeholder="Nama Belakang"
                                        name="namabelakang" id="namabelakang" value="{{ old('namabelakang') }}">
                                    @if($errors->has('namabelakang'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('namabelakang') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nomorseluler">Nomor Seluler</label>
                                    <input type="text" class="w-100 form-control " placeholder="Nomor Seluler"
                                           name="telp" id="nomorseluler" value="{{ old('telp') }}">
                                    @if($errors->has('telp'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $errors->first('telp') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="alamatsurel">Alamat Email</label>
                                    <input type="text" class="w-100 form-control " placeholder="Alamat Surel"
                                           name="email" id="alamatsurel" value="{{ old('email') }}">
                                    @if($errors->has('email'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ $errors->first('email') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="container">
                                <div class="form-group">
                                    <label for="tentanganda">Tentang Anda</label>
                                    <textarea placeholder="Ceritakan Tentang Anda" name="desc" id="tentanganda"
                                        class="form-control custom-textarea" rows="5">{{ old('desc') }}</textarea>
                                    @if($errors->has('desc'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('desc') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="">Resume</label><br>
                                    <label for="infile" class="infile-label">Pilih File<i
                                            class="far fa-file"></i></label>
                                    <span class="filename text-capitalize ml-3">tidak ada data</span>
                                    <input type="file" name="attachment" id="infile" class="infile"><br>
                                    @if($errors->has('attachment'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $errors->first('attachment') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @endif
                                    <small>File berekstensi jpeg/jpg/png</small>
                                </div>

                                <label class="check-wrapper mt-3">Saya setuju untuk dihubungi oleh Somearch Nusantara
                                    melalui email atau telepon.
                                    <input type="checkbox" name="persetujuan" id="check">
                                    <span class="checkmark"></span>
                                </label>
                                <button type="submit" id="btn-submit" class="btn-dark-apply mt-3">Apply</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jelajahi peluang lain -->

    <div class="row justify-content-center mb-5 pb-5">
        <h1 class="m-5 pt-3 text-dark text-capitalize font-weight-bold">jelajahi peluang lain</h1>
        <div class="col-12 outline-peluang-wrapper">
            <div class="row justify-content-center peluang-wrapper">
                @foreach($relate as $rel)
                <div class="col-md-3 item">
                    <h3 class="text-dark"><b>{{ $rel->job_position }}</b></h3>
                    @foreach($rel->tipekarir as $tk)
                    <span>{{$tk->tipe_karir}},</span>
                    @endforeach
                    <a href="{{ url('/detail-karir/' . $rel->slug) }}" class="btn-apply">Apply</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- mulai proyek -->

<div class="row top-footer p-5 mb-4 mt-4">
    <div class="container">
        <h2 class="text-center text-light">Mulai proyek Anda bersama kami</h2><br>
        <a href="{{ url('/estimasi-project') }}">
            Estimasi Proyek
        </a>
    </div>
</div>

@endsection

@push('extras-js')
<script>
    $('.infile-label').on('click', function () {
        $('.infile').show();
        $('.infile').on('change', function () {
            var filename = $('.infile').val();
            if (filename.substring(3, 11) == 'fakepath') {
                filename = filename.substring(12);
            }
            $('.filename').html(filename);
        });
    });

    $('#btn-submit').click(function () {
        if ($("input[name=persetujuan]").prop('checked') == false) {
            swal({
                icon: 'error',
                title: 'Error',
                text: 'Klik Persetujuan Terlebih Dahulu',
            });
            return false;
        }
    });
</script>
@endpush

@push('extras-css')
<style>
    .form-control:focus {
        background: #F5F5F5;
        border-color: #28a745 !important;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25) !important;
    }

    .swal-footer {
        margin-top: -1px;
        margin-bottom: 4px;
        text-align: center;
    }

    .card-detailkarir {
        background: white;
        min-width: 180px;
        margin-left: 100px;
        margin-right: 100px;
        border-radius: 30px;
        box-shadow: 0px 2.3px 12px rgba(0, 0, 0, 0.1);
    }

    .item {
        padding: 25px;
        background: white;
        border-radius: 30px;
        margin-right: 23px;
        border: 1px solid #CCCCCC;
    }

    .col-md-3.item {
        flex: 0 0 26% !important;
        max-width: 26%;
        min-height: 240px;
    }

    @media (max-width: 991px) {

        .card-detailkarir {
            padding: 48px !important;
            margin-left: 15px !important;
            margin-right: 15px !important;
        }

        .top-footer .container>h1 {
            font-size: 28px;
        }

        .input-form>.col {
            flex: 0 0 100% !important;
            max-width: 100%;
        }

        .peluang-wrapper>.item {
            flex: 0 0 85% !important;
            height: 210px;
            max-width: 100%;
            margin-right: 0% !important;
            margin-top: 20px;
        }

        .col-md-3.item>h3 {
            font-size: 25px;
        }

        .outline-peluang-wrapper {
            margin-top: -1px !important;
        }
    }

    @media (max-width: 768px) {

        .card-detailkarir {
            margin-left: -20px !important;
            margin-right: -20px !important;
        }
    }

    @media (max-width: 568px) {
        .card-detailkarir {
            margin-left: 35px !important;
            margin-right: 35px !important;
        }
    }

    @media (max-width: 467px) {

        .card-detailkarir {
            margin-left: 15px !important;
            margin-right: 15px !important;
        }

        .col-md-3.item {
            height: 210px;
        }
    }

    @media (max-width: 450px) {
        .infile-label i {
            margin-top: 3px;
        }

        .infile-label {
            width: 100% !important;
            display: flex;
            justify-content: center;
        }

        .check-wrapper {
            margin-top: 0px !important;
        }

        .filename {
            display: flex;
            justify-content: center;
            margin-left: 0 !important;
        }

        .btn-dark-apply {
            width: 100% !important;
        }
    }
</style>
@endpush
