@extends('admin.layouts.layout')

@section('title')

    Kontak

@endsection

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Kontak</h4>
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
                        <a href="#">Kontak</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-6">
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
                            <form action="{{url('admin/contact/update/'.$kontak->id)}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col ">
                                        <div class="form-group">
                                            <label for="alamat_link">Link Alamat (Google Maps)</label>
                                            <input type="text" class="form-control" value="{{@$kontak->alamat_link}}"
                                                   name="alamat_link" placeholder="https://google.maps.com">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col ">
                                        <div class="form-group ">
                                            <label for="alamat">Alamat</label>
                                            <textarea type="text" class="ckeditor" name="alamat"
                                                   id="alamat"
                                                      placeholder="Tuliskan Alamat Kantor">{{$kontak->alamat}}</textarea>

                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col ">
                                        <div class="form-group ">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" value="{{@$kontak->email}}"
                                                   name="email" placeholder="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col ">
                                        <div class="form-group ">
                                            <label for="telepon">Nomor Telepon</label>
                                            <input type="number" class="form-control" value="{{@$kontak->telepon}}"
                                                   name="telepon" placeholder="62888XXXXX">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col ">
                                        <div class="form-group ">
                                            <label for="instagram">Link Instagram</label>
                                            <input type="text" class="form-control" value="{{@$kontak->instagram}}"
                                                   name="instagram" placeholder="https://instagram.com/">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col ">
                                        <div class="form-group ">
                                            <label for="linkedin">Link Linkedin</label>
                                            <input type="text" class="form-control" value="{{@$kontak->linkedin}}"
                                                   name="linkedin" placeholder="https://linkedin.com/">
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
