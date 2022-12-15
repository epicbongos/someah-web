@extends('admin.layouts.layout')

@section('title')
    @if ($status == 'insert')
        Tambah Tipe karir
    @else
        Ubah {{ $type->tipe_karir }}
    @endif
@endsection

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Tipe Karir</h4>
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
                        <a href="{{ url('admin/tipe') }}">Data Tipe</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/tipe/insert-tipekarir') }}">
                            @if ($status == 'insert')
                                Masukkan
                            @else
                                Ubah
                            @endif Tipe Karir
                        </a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <button class="btn btn-success" id="btn-tambah-form"
                                @if ($status == 'update') disabled @endif>
                                <span class="btn-label pr-1">
                                    <i class="fa fa-plus"></i>
                                </span>
                                Tambah Kolom
                            </button>
                        </div>
                        <div class="card-body">
                            <form
                                @if ($status == 'insert') action="{{ url('/admin/tipe/insert-tipekarir/store') }}" @else action="{{ url('/admin/tipe/update-tipe-karir/update/' . $type->slug) }}" @endif
                                method="POST">
                                {{ csrf_field() }}
                                <div class="row" id="form-added-1">
                                    <div class="col">
                                        <div class="form-group mb-0 pt-0">
                                            <label for="job_position">
                                                @if ($status == 'insert')
                                                    Masukkan
                                                @else
                                                    Ubah
                                                @endif Kategori Karir
                                            </label>
                                            <input type="text" class="form-control w-100 mt-2"
                                                @if ($status == 'insert') name="tipekarir[]" @else name="tipekarir" @endif
                                                id="job_position" aria-describedby="helpId"
                                                placeholder="Masukkan Kategori Karir"
                                                @if ($status == 'update') value="{{ $type->tipe_karir }}" @endif
                                                value="{{ old('tipekarir.0') }}">
                                            @if ($errors->has('tipekarir.0'))
                                                <div class="alert alert-danger alert-dismissible fade show mt-3"
                                                    role="alert">
                                                    {{ $errors->first('tipekarir.0') }}
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-end d-flex mt-3">
                                    <button type="submit" class="btn btn-success mr-4">
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
@endsection

@push('extras-js')
    <script>
        $(document).ready(function() {
            var i = 0;
            $('#btn-tambah-form').on('click', function() {
                i++;
                var template = $('<div class="row mt-2" id="form-added-' + (i + 1) + '">' +
                    '<div class="col pr-0">' +
                    '<div class="form-group mb-0 pt-0">' +
                    '<input type="text" class="form-control w-100" name="tipekarir[]"' +
                    'id="tipekarir" aria-describedby="helpId"' +
                    'placeholder="Masukkan Kategori Karir">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-1" style="padding-left: 0px !important;">' +
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
