@extends('admin.layouts.layout')

@section('title')

{{@$type ? 'Ubah Tipe Project': 'Tambah Tipe Project'}}

@endsection

@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Data Tipe Project</h4>
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
                    <a href="{{ url('admin/tipe-karir') }}">Data Tipe</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#}">{{@$type ? 'Ubah Tipe Project': 'Tambah Tipe Project'}}</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ @$type ? url('/admin/tipe-karir/update/' . $type->slug) : url('/admin/tipe-karir/store')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row" id="form-added-1">

                                <div class="col">
                                    <div class="form-group mb-0 pt-0">
                                        <label for="tipe_karir"> Tipe Karir</label>
                                        <input type="text" class="form-control w-100 mt-2" name="tipe_karir"
                                            id="tipe_karir" aria-describedby="helpId"
                                            placeholder="Masukkan Kategori Project"
                                            value="{{ old('tipe_karir',@$type->tipe_karir) }}">

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
$(document).ready(function(){
    var i = 0;
    $('#btn-tambah-form').on('click', function(){
        i++;
        var template = $('<div class="row mt-2" id="form-added-' + (i+1) +'">' +
                            '<div class="col pr-0">' +
                                '<div class="form-group mb-0 pt-0">' +
                                     '<input type="text" class="form-control w-100" name="tipeproject[]"' +
                                        'id="job_position" aria-describedby="helpId"' +
                                        'placeholder="Masukkan Kategori Project">' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-md-1" style="padding-left: 0px !important;">' +
                                '<button type="button" class="btn btn-danger close-form" id="'+ (i+1) +'">' +
                                    '<i class="fa fa-window-close" aria-hidden="true"></i>' +
                                '</button>' +
                            '</div>' +
                        '</div>' );

        template.insertAfter('#form-added-' + i);
        console.log('#form-added-' + i);
    });

    $(document).on('click','.close-form', function(){
        i--;
        var id_button = $(this).attr('id');
        $('#form-added-'+id_button+'').remove();
        console.log(i);
    });
})
</script>
@endpush
