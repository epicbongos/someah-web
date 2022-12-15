@extends('admin.layouts.layout')

@section('title')
    @if ($status == 'insert')
        Tambah Client
    @else
        Ubah {{ $client->company_name }}
    @endif
@endsection

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Klien</h4>
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
                        <a href="{{ url('admin/client') }}">Klien</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/client/insert-client') }}">
                            @if ($status == 'insert')
                                Tambah
                            @else
                                Ubah
                            @endif Klien
                        </a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        {{-- <div class="card-header"></div> --}}
                        <div class="card-body ml-3">
                            <form
                                @if ($status == 'insert') action="{{ url('/admin/client/insert-client/store') }}" @else
                            action="{{ url('/admin/client/update-client/update/' . $client->slug . '') }}" @endif
                                method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row" id="form-added-1">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col"
                                                style="padding-right: 0px !important; padding-left: 0px !Important;">
                                                <div class="form-group">
                                                    <label for="company_name">
                                                        @if ($status == 'insert')
                                                            Masukkan
                                                        @else
                                                            Ubah
                                                        @endif Nama Perusahaan
                                                    </label>
                                                    <input type="text" class="form-control w-100"
                                                        @if ($status == 'update') name="company_name" @else name="company_name[]" @endif
                                                        @if ($status == 'update') value="{{ $client->company_name }}" @endif
                                                        id="company_name" aria-describedby="helpId"
                                                        value="{{ old('company_name.0') }}"
                                                        placeholder="Masukkan Nama Perusahaan">
                                                    @if ($errors->has('company_name.0'))
                                                        <div class="alert alert-danger alert-dismissible fade show mt-3"
                                                            role="alert">
                                                            {{ $errors->first('company_name.0') }}
                                                            <button type="button" class="close"
                                                                data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col" style="padding-left: 0px !Important;">
                                                <div class="form-group">
                                                    <label for="website">
                                                        @if ($status == 'insert')
                                                            Masukkan
                                                        @else
                                                            Ubah
                                                        @endif
                                                        Website
                                                    </label>
                                                    <input type="text" class="form-control w-100"
                                                        @if ($status == 'update') name="website" @else name="website[]" @endif
                                                        id="website" aria-describedby="helpId"
                                                        placeholder="Masukkan Website"
                                                        @if ($status == 'update') value="{{ $client->website }}" @endif
                                                        value="{{ old('website.0') }}">
                                                    @if ($errors->has('website.0'))
                                                        <div class="alert alert-danger alert-dismissible fade show mt-3"
                                                            role="alert">
                                                            {{ $errors->first('website.0') }}
                                                            <button type="button" class="close"
                                                                data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12" style="padding-left: 0px !Important;">
                                                <div class="form-group">
                                                    <label for="desc">
                                                        @if ($status == 'insert')
                                                            Masukkan
                                                        @else
                                                            Ubah
                                                        @endif
                                                        Deskripsi
                                                    </label>
                                                    <textarea class="form-control"
                                                        @if ($status == 'update') name="desc" @else
                                                    name="desc[]" @endif
                                                        id="desc" rows="3" placeholder="Masukkan Deskripsi">{{ old('desc.0') }}@if ($status == 'update')
    {{ $client->desc }}
    @endif
    </textarea>
                                                    @if ($errors->has('desc.0'))
                                                        <div class="alert alert-danger alert-dismissible fade show mt-3"
                                                            role="alert">
                                                            {{ $errors->first('desc.0') }}
                                                            <button type="button" class="close"
                                                                data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col pl-0">
                                                <div class="form-group">
                                                    <label for="infile_logo">
                                                        @if ($status == 'insert')
                                                            Masukkan
                                                        @else
                                                            Ubah
                                                        @endif Logo
                                                    </label><br>
                                                    @if ($status == 'update')
                                                        <img src="{{ asset('uploaded/client/' . $client->logo) }}"
                                                            class="mb-3" alt="">
                                                    @endif
                                                    <input type="file"
                                                        @if ($status == 'update') name="logo" @else
                                                    name="logo[]" @endif
                                                        id="infile_logo" class="form-control infile"><br>
                                                    @if ($errors->has('logo'))
                                                        <div class="alert alert-danger alert-dismissible fade show"
                                                            role="alert">
                                                            {{ $errors->first('logo') }}
                                                            <button type="button" class="close"
                                                                data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col pl-0">
                                                <div class="form-group">
                                                    <label for="infile_mini_logo">
                                                        @if ($status == 'insert')
                                                            Masukkan
                                                        @else
                                                            Ubah
                                                        @endif Mini Logo
                                                    </label><br>
                                                    @if ($status == 'update')
                                                        <img src="{{ asset('uploaded/client/' . $client->mini_logo) }}"
                                                            class="mb-3" alt="">
                                                    @endif
                                                    <input type="file"
                                                        @if ($status == 'update') name="mini_logo" @else
                                                    name="mini_logo[]" @endif
                                                        id="infile_mini_logo" class="form-control infile"><br>
                                                    @if ($errors->has('mini_logo'))
                                                        <div class="alert alert-danger alert-dismissible fade show"
                                                            role="alert">
                                                            {{ $errors->first('mini_logo') }}
                                                            <button type="button" class="close"
                                                                data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container-fluid">
                                    <div class="row justify-content-end d-flex">
                                        <button type="submit" class="btn btn-success mr-2">
                                            <span class="btn-label pr-1">
                                                <i class="fas fa-save"></i>
                                            </span>
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('extras-js')
    <script>
        $(document).ready(function() {

            var i = 0;
            $('#btn-tambah-form').on('click', function() {
                i++;
                var template = $('<div class="row" id="form-added-' + (i + 1) + '">' +
                    '<div class="container-fluid">' +
                    '<hr class="m-0 mt-4 mb-2">' +
                    '<div class="row pl-0 mb-3 justify-content-center align-items-center d-flex pt-0"> ' +
                    '<div class="col pl-0">' +
                    '<button type="button" class="btn btn-danger close-form btn-block" id="' + (i + 1) +
                    '">' +
                    '<i class="fa fa-window-close" aria-hidden="true"></i>' +
                    '</button>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col"' +
                    'style="padding-right: 0px !important; padding-left: 0px !Important;">' +
                    '<div class="form-group">' +
                    '<label for="">Masukkan Nama Perusahaan</label>' +
                    '<input type="text" class="form-control w-100" name="company_name[]"' +
                    'id="nama" aria-describedby="helpId"' +
                    'placeholder="Masukkan Nama Perusahaan">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col pl-0">' +
                    '<div class="form-group">' +
                    '<label for="">Masukkan Website</label>' +
                    '<input type="text" class="form-control w-100" name="website[]"' +
                    'id="website" aria-describedby="helpId"' +
                    'placeholder="Masukkan Website">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-12" style="padding-left: 0px !Important;">' +
                    '<div class="form-group">' +
                    '<label for="">Masukkan Deskripsi</label>' +
                    '<textarea class="form-control" name="desc[]" id="deskripsi" rows="3"' +
                    'placeholder="Masukkan Deskripsi"></textarea>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col pl-0 mr-1">' +
                    '<div class="form-group">' +
                    '<label for="">Masukkan Logo</label><br>' +
                    '<input type="file" name="logo[]" id="infile_logo" class="form-control infile"><br>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col pl-0">' +
                    '<div class="form-group">' +
                    '<label for="">Masukkan Mini Logo</label><br>' +
                    '<input type="file" name="mini_logo[]" id="infile_mini_logo"' +
                    'class="form-control infile"><br>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>');

                template.insertAfter('#form-added-' + i);
                console.log('#form-added-' + i);
            });

            $(document).on('click', '.close-form', function() {
                i--;
                var id_button = $(this).attr('id');
                $('#form-added-' + id_button + '').remove();
                console.log(i);
            });
        })
    </script>
@endpush
