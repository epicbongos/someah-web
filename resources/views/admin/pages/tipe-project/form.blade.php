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
                        <a href="{{ url('admin/tipe-project') }}">Data Tipe</a>
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
                            <h6>{{@$type ? 'Ubah Tipe Project': 'Tambah Tipe Project'}}</h6>
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
                            <form
                                action="{{ @$type ? url('/admin/tipe-project/update/' . $type->slug) : url('/admin/tipe-project/store')}}"
                                method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row" id="form-added-1">
                                    <div class="input-file input-file-image col-md-12">
                                        <img class="img-upload-preview" width="150"
                                             src="{{@$type ? asset("uploaded/tipe_project/$type->gambar") : 'http://placehold.it/150x150'}}"
                                             alt="preview">
                                        <input type="file" class="form-control form-control-file" id="gambar"
                                               name="gambar" accept="image/*">
                                        <label for="gambar" class="  label-input-file btn btn-default btn-round">
                                    <span class="btn-label">
                                        <i class="fa fa-file-image"></i>
                                    </span>
                                            Upload Gambar Project
                                        </label>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-0 pt-0">
                                            <label for="tipe_project"> Kategori Project</label>
                                            <input type="text" class="form-control w-100 mt-2" name="tipe_project"
                                                   id="tipe_project" aria-describedby="helpId"
                                                   placeholder="Masukkan Kategori Project"
                                                   value="{{ old('tipe_project',@$type->tipe_project) }}">

                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mb-0 pt-0">
                                            <label for="desc"> Deskripsi</label>
                                            <textarea name="desc" id="desc" class="form-control"
                                                      rows="5">{{old('desc',@$type->desc)}}</textarea>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <hr>
                                        <h6>Detail Tipe Projek</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="kdgroup repeater">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12 text-right">
                                                        <button type="button" class="btn btn-primary"
                                                                data-repeater-create
                                                                type="button">
                                                            <i class="fa fa-plus"></i> Tambah
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div data-repeater-list="detail">
                                                <div data-repeater-item>
                                                    <label class="control-label col-sm-2 label-urutan" for="kd3">Bahasa
                                                        Pemrograman 1</label>
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            @if(@$type)
                                                                <input type="hidden" name="id_project_detail">
                                                            @endif
                                                            <div class="form-group">
                                                                <input type="text" name="bahasa_pemrograman" class="form-control" value="">
                                                            </div>

                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <input type="file" name="logo" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <button type="button" class="btn btn-danger btn-sm"
                                                                        data-repeater-delete><i class="fa fa-trash"></i>
                                                                </button>
                                                            </div>

                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
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
    <script src="{{asset('assets/admin/')}}/js/jquery.repeater.min.js"></script>

    <script>
        $(document).ready(function () {
            var $repeater = $('.repeater').repeater({
                show: function () {
                    $(this).slideDown();
                    refreshLabel();
                },
                hide: function (el) {
                    $(this).slideUp(el);
                    refreshLabel();

                }
            });

            function refreshLabel() {
                $.each($(".label-urutan"), function (i, e) {
                    $(e).html('Bahasa Pemrograman ' + (i + 1));
                });
            }

            @if(!empty($type))
            $repeater.setList({!! json_encode($detail) !!})
            @endif


        })
    </script>
@endpush
