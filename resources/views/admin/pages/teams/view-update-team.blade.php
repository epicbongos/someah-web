@extends('admin.layouts.layout')

@section('title')
    Ubah {{ $person->name }}
@endsection

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Anggota Tim</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{ url('admin/') }}">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Ubah Anggota Tim</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="mb-0">{{ $person->name }}</h2>
                        <z/div>
                        <div class="card-body">
                            <form action="{{ url('/admin/team/update-team/update/' . $person->slug) }}" method="post"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-2 ml-4"
                                        style="flex: 0 0 16% !important; max-width: 16% !important; padding: 0px; border: 1.5px solid #ccc;">
                                        <label for="ubahphoto" class="changer"
                                            style="width: 100% !important; height: 100%; justify-content: center; display: flex; align-items: center;">
                                            <img width="75% !important;"
                                                src="{{ asset('uploaded/team/' . $person->photo) }}" />
                                        </label>
                                        <span class="label"></span>
                                        <input id="ubahphoto" name="ubahphoto" type="file" class="d-none" />
                                    </div>
                                    <div class="col ml-2">
                                        <div class="form-group">
                                            <label for="">Ubah Nama</label>
                                            <input type="text" class="form-control" value="{{ $person->name }}"
                                                name="ubahname" placeholder="Ubah Nama Anggota Team">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Ubah Peran</label>
                                            <input type="text" class="form-control" value="{{ $person->position }}"
                                                name="ubahrole" placeholder="Ubah Peran Anggota Team">
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-end mr-2 mt-2">
                                    <button type="submit" class="btn btn-success" style="padding: 8px 30px;">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('extras-css')
    <style>
        .label {
            position: absolute;
            bottom: 10px;
            text-align: center;
            width: 100%;
            color: white;
            font-weight: bold;
            font-size: 14px;
        }

        .changer:hover {
            cursor: pointer;
            background: linear-gradient(transparent 20%, #ccc 80%);
        }

    </style>
@endpush

@push('extras-js')
    <script>
        $('.changer').on('click', function() {
            $('#ubahphoto').show();
            $('#ubahphoto').on('change', function() {
                var filename = $('#ubahphoto').val();
                if (filename.substring(3, 11) == 'fakepath') {
                    if (filename.length > 30) {
                        filename = filename.substring(12, 30) + '...';
                    } else {
                        filename = filename.substring(12, 30);
                    }
                }
                $('.changer').css('background', 'linear-gradient(transparent 20%, #ccc 80%)');
                $(this).prev().html(filename);
            });
        });
    </script>
@endpush