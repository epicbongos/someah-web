@extends('admin.layouts.layout')

@section('title')

@if($status == "insert")
    Tambah Tipe Project
@else
    Ubah {{$type->tipe_project}}
@endif

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
                    <a href="{{ url('admin/tipe') }}">Data Tipe</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/tipe/insert-tipeproject') }}">@if($status == 'insert') Tambah @else Ubah @endif Tipe Project</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-success" id="btn-tambah-form" @if($status == "update") disabled="disabled" @endif>
                            <span class="btn-label pr-1">
                                <i class="fa fa-plus"></i>
                            </span>
                            Tambah Kolom
                        </button>
                    </div>
                    <div class="card-body">
                        <form @if($status == "insert") action="{{ url('/admin/tipe/insert-tipeproject/store') }}" @else action="{{ url('/admin/tipe/update-tipe-project/update/' . $type->slug ) }}" @endif method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row" id="form-added-1">
                                <div class="input-file input-file-image col-md-12" >
                                    <img class="img-upload-preview" width="150" src="{{@$status== "update" ? asset("uploaded/tipe_project/$type->gambar") : 'http://placehold.it/150x150'}}" alt="preview">
                                    <input type="file" class="form-control form-control-file" id="gambar" name="gambar" accept="image/*" >
                                    <label for="gambar" class="  label-input-file btn btn-default btn-round">
                                    <span class="btn-label">
                                        <i class="fa fa-file-image"></i>
                                    </span>
                                        Upload Gambar Project
                                    </label>
                                </div>
                                <div class="col">
                                    <div class="form-group mb-0 pt-0">
                                        <label for="tipeproject">@if($status == 'update') Ubah @else Tambah @endif Kategori Project</label>
                                        <input type="text" class="form-control w-100 mt-2" @if($status == "insert") name="tipeproject" @else name="tipeproject" @endif
                                            id="tipeproject" aria-describedby="helpId"
                                            placeholder="Masukkan Kategori Project" @if($status == "update") value="{{ $type->tipe_project }}"  @endif
                                            value="{{ old('tipeproject') }}">

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group mb-0 pt-0">
                                        <label for="desc">@if($status == 'update') Ubah @else Tambah @endif Deskripsi</label>
                                        <textarea name="desc" id="desc" class="form-control" rows="5">@if($status == "update"){{$type->desc}}@endif</textarea>

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
