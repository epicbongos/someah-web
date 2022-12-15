@extends('admin.layouts.layout')

@section('title', 'Anggota Tim')

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
                        <a href="{{ url('admin/team') }}">Anggota Tim</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/team/insert-team') }}">Tambah Anggota Tim</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <button class="btn btn-success" id="btn-tambah-form">
                                <span class="btn-label pr-1">
                                    <i class="fa fa-plus"></i>
                                </span>
                                Tambah Kolom
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12 ">
                                <form enctype="tipart/form-data" method="POST"
                                    action="{{ url('/admin/team/insert-team/store') }}">
                                    {{ csrf_field() }}
                                    <div class="row" id="form-added-1">
                                        <div class="col-md-3"
                                            style="padding-right: 0px !important; padding-left: 0px !Important;">
                                            <div class="form-group">
                                                <label for="" class="mb-2 pb-2">Masukkan Foto</label> <br>
                                                <input type="file" name="photo[]" id="infile" class="infile"><br>
                                                @if ($errors->has('photo'))
                                                    <div class="alert alert-danger alert-dismissible fade show mt-4"
                                                        role="alert">
                                                        {{ $errors->first('photo') }}
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col"
                                            style="padding-right: 0px !important; padding-left: 0px !Important;">
                                            <div class="form-group">
                                                <label for="" class="mb-2 pb-2">Masukkan Nama Anggota</label> <br>
                                                <input type="text" class="form-control w-100" name="name[]" id="nama"
                                                    aria-describedby="helpId" placeholder="Masukkan Nama Anggota"
                                                    value="{{ old('name.0') }}">
                                                @if ($errors->has('name.0'))
                                                    <div class="alert alert-danger alert-dismissible fade show mt-3"
                                                        role="alert">
                                                        {{ $errors->first('name.0') }}
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col" style="padding-left: 0px !Important;">
                                            <div class="form-group">
                                                <label for="" class="mb-2 pb-2">Masukkan Peran Anggota</label> <br>
                                                <input type="text" class="form-control w-100" name="role[]" id="role"
                                                    aria-describedby="helpId" placeholder="Masukkan Role Anggota"
                                                    value="{{ old('role.0') }}">
                                                @if ($errors->has('role.0'))
                                                    <div class="alert alert-danger alert-dismissible fade show mt-3"
                                                        role="alert">
                                                        {{ $errors->first('role.0') }}
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-end d-flex mt-2">
                                        <button type="submit" class="btn btn-success mr-4" id="submit">
                                            <span class="btn-label pr-1">
                                                <i class="fas fa-save"></i>
                                            </span>
                                            Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('extras-css')
@endpush

@push('extras-js')
    <script>
        $(document).ready(function() {

            var i = 0;
            $('#btn-tambah-form').on('click', function() {
                i++;
                var template = $('<div class="row" id="form-added-' + (i + 1) + '">' +
                    '<div class="col-md-3"style="padding-right: 0px !important; padding-left: 0px !Important;">' +
                    '<div class="form-group">' +
                    '<input type="file" name="photo[]" id="infile" class="infile"><br>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col" style="padding-right: 0px !important; padding-left: 0px !Important;">' +
                    '<div class="form-group">' +
                    '<input type="text" class="form-control w-100" name="name[]" id="nama"' +
                    'aria-describedby="helpId" placeholder="Masukkan Nama Anggota">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col" style="padding-left: 0px !Important;">' +
                    '<div class="form-group">' +
                    '<input type="text" class="form-control w-100" name="role[]" id="role"' +
                    'aria-describedby="helpId" placeholder="Masukkan Role Anggota">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-1" style="padding-left: 0px !important; margin-top: 10px;">' +
                    '<button type="button" class="btn btn-danger close-form" id="' + (i + 1) + '">' +
                    '<i class="fa fa-window-close" aria-hidden="true"></i>' +
                    '</button>' +
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
