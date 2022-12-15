@extends('admin.layouts.layout')

@section('title')

@if($status == "insert")
Tambah Portfolio
@else
Ubah {{$carrer->job_position}}
@endif

@endsection

@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Data Lowongan</h4>
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
                    <a href="{{url('admin/karir')}}">Data Karir</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">@if($status == 'insert') Tambah Lowongan @else Update Lowongan @endif</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
{{--                        <button class="btn btn-success" id="btn-tambah-form" disabled>--}}
{{--                            <span class="btn-label pr-1">--}}
{{--                                <i class="fa fa-plus"></i>--}}
{{--                            </span>--}}
{{--                            Tambah Kolom--}}
{{--                        </button>--}}
                    </div>
                    <div class="card-body">
                        <form @if($status=="insert" ) action="{{ url('/admin/karir/insert-karir/store') }}" @else
                            action="{{ url('/admin/karir/update-karir/update/' . $carrer->slug ) }}" @endif
                            method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col pr-0">
                                    <div class="form-group mb-0 pr-0">
                                        <label for="job_position">@if($status == 'insert') Masukkan @else Ubah @endif
                                            Job Position</label>
                                        <input type="text" class="form-control w-100" name="job_position"
                                            id="job_position" aria-describedby="helpId"
                                            placeholder="Masukkan Job Position"
                                            @if($status=='update' ) value="{{ $carrer->job_position }}" @endif
                                            value="{{ old('job_position') }}">
                                            @if($errors->has('job_position'))
                                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                                {{ $errors->first('job_position') }}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-md-4 pl-2 ">
                                    <div class="form-group">
                                        <label for="cat">Pilih Kategori</label><br>
                                        <select class="select-move" id="cat" multiple name="categories[]">
                                            @foreach($tipekarir as $tk)
                                            <option value="{{ $tk->id }}" @if($status=='update'
                                                ){{ (in_array($tk->id,$categories)) ? 'selected' : '' }}@endif>
                                                {{ $tk->tipe_karir }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('categories'))
                                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                            {{ $errors->first('categories') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-0">
                                        <label for="desc">@if($status == 'insert') Masukkan @else Ubah @endif
                                            Deskripsi</label>
                                        <textarea class="ckeditor" id="ckedtor" name="desc">
                                            @if($status == 'update') {{ $carrer->desc }} @endif {{ old('desc') }}
                                        </textarea>
                                        @if($errors->has('desc'))
                                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                            {{ $errors->first('desc') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end d-flex mt-2">
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

@push('extras-css')
<style>
    .tail-select {
        width: 100%;
    }
</style>
@endpush

@push('extras-js')
<script>
    tail.select(".select-move", {
        search: true,
        descriptions: true,
        hideSelected: true,
        hideDisabled: true,
        multiShowCount: false,
        multiContainer: true,
    });
</script>
@endpush
