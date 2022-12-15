@extends('admin.layouts.layout')

@section('title')

    Visi & Misi Perusahaan

@endsection

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Visi & Misi Perusahaan</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{ url('admin/')}}">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Visi & Misi Perusahaan</a>
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
                            <form action="{{url('admin/about/update/'.$about->id)}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col pr-0">
                                        <div class="form-group mb-0 pr-0">
                                            <label for="tentang_kami">Tentang Kami</label>
                                            <textarea type="text" class="form-control" name="tentang_kami"
                                                   id="tentang_kami" aria-describedby="helpId"
                                                      placeholder="Tuliskan Tentang Kami"   >{{$about->tentang_kami}}</textarea>
                                            @if($errors->has('tentang_kami'))
                                                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                                    {{ $errors->first('tentang_kami') }}
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col pr-0">
                                        <div class="form-group mb-0 pr-0">
                                            <label for="visi">Visi</label>
                                            <textarea type="text" class="form-control" name="visi"
                                                      id="visi" aria-describedby="helpId"
                                                      placeholder="Tuliskan Visi">{{$about->visi}}</textarea>
                                            @if($errors->has('visi'))
                                                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                                    {{ $errors->first('visi') }}
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
                                            <label for="desc">Misi</label>
                                            <textarea class="ckeditor" id="ckedtor" name="misi">{{$about->misi}}
                                            </textarea>
                                            @if($errors->has('misi'))
                                                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                                    {{ $errors->first('misi') }}
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
