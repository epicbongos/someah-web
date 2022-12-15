@extends('admin.layouts.layout')

@section('title')

@if($status == "insert")
Tambah Portfolio
@else
Ubah {{ $portfolio->portofolio_name }}
@endif

@endsection

@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Data Portfolio</h4>
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
                    <a href="{{ url('admin/portfolio') }}">Portofolio</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">@if($status == "insert") Tambah @else Ubah
                        @endif Portfolio</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    {{--                    <div class="card-header"></div>--}}
                    <div class="card-body">
                        <form @if($status=="insert" ) action="{{ url('/admin/portfolio/insert-portfolio/store') }}"
                            @else action="{{ url('/admin/portfolio/update-portfolio/update/' . $portfolio->slug ) }}"
                            @endif method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-9 pr-0">
                                    <div class="form-group">
                                        <label for="n_portfolio">@if($status == "insert") Masukkan @else Ubah @endif
                                            Nama Portfolio</label>
                                        <input type="text" class="form-control w-100" name="n_portfolio"
                                            id="n_portfolio" aria-describedby="helpId"
                                            placeholder="Masukkan Nama Portfolio" @if($status=="update" )
                                            value="{{ $portfolio->portofolio_name }}" @endif
                                            value="{{ old('n_portfolio') }}">
                                        @if($errors->has('n_portfolio'))
                                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                            {{ $errors->first('n_portfolio') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3 pl-0">
                                    <div class="form-group">
                                        <label for="year">@if($status == "insert") Masukkan @else Ubah @endif
                                            Tahun</label>
                                        <input type="text" class="form-control w-100" name="year" id="year"
                                            aria-describedby="helpId" placeholder="Tahun" @if($status=="update" )
                                            value="{{ $portfolio->year }}" @endif value="{{ old('year') }}">
                                        @if($errors->has('year'))
                                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                            {{ $errors->first('year') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="deskripsi">@if($status == "insert") Masukkan @else Ubah @endif
                                            Deskripsi</label>
                                        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3"
                                            placeholder="Masukkan Deskripsi">{{old('deskripsi')}}@if($status == "update") {{ $portfolio->desc }} @endif</textarea>
                                        @if($errors->has('deskripsi'))
                                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                            {{ $errors->first('deskripsi') }}
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
                                    <div class="form-group">
                                        <label for="id_client">@if($status == "insert") PIlih @else Ubah @endif
                                            Client</label>
                                        <select class="custom-select" name="id_client" id="id_client">
                                            @if($status == "insert")
                                            <option value="#">Pilih Client</option>
                                            @endif
                                            @foreach($clients as $client)
                                            <option value="{{ $client->id }}" @if($status=="update"
                                                ){{ $client->id == $portfolio->client_id ? "selected" : "" }}@endif>
                                                {{ $client->company_name }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('id_client'))
                                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                            {{ $errors->first('id_client') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col pl-0">
                                    <div class="form-group">
                                        <label for="categories">@if($status == "insert") Pilih @else Ubah @endif
                                            Kategori</label><br>
                                        <select class="select-move" id="categories" multiple name="categories[]">
                                            @foreach($tipeprojects as $tp)
                                            <option value="{{ $tp->id }}" @if($status=='update'
                                                ){{ (in_array($tp->id,$categories)) ? 'selected' : '' }}@endif>
                                                {{ $tp->tipe_project }}</option>
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
{{--                            <div class="row">--}}
{{--                                <div class="col">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="keterangan">@if($status == "insert") Masukkan @else Ubah @endif--}}
{{--                                            Keterangan</label>--}}
{{--                                        <input type="text" class="form-control w-100" name="keterangan" id="keterangan"--}}
{{--                                            aria-describedby="helpId" placeholder="Keterangan" @if($status=="update" )--}}
{{--                                            value="{{ $portfolio->keterangan }}" @endif value="{{ old('keterangan') }}">--}}
{{--                                        @if($errors->has('keterangan'))--}}
{{--                                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">--}}
{{--                                            {{ $errors->first('keterangan') }}--}}
{{--                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                                                <span aria-hidden="true">&times;</span>--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            @if($status=="insert")
                            <div class="row" id="img-added-1">
                                <div class="col pr-0">
                                        <div class="form-group">
                                            <label for="gambarproduk">@if($status == "insert") Masukkan @else Ubah @endif
                                                Gambar Produk</label><br>
                                            <button class="btn btn-success" id="btn-tambah-img" type="button"
                                            ><i class="fa fa-plus pr-1"
                                                aria-hidden="true"></i>Tambah Gambar</button>
                                            <br>
                                            <br>
                                        <input type="file" class="form-control" name="gambarproduk[]" id="gambarproduk"
                                            aria-describedby="helpId">
                                        @if($errors->has('gambarproduk'))
                                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                            {{ $errors->first('gambarproduk') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
{{--                                <div class="col-md-1 pl-0" style="flex: 0 0 5% !important; max-width: 8%;">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <button class="btn btn-success" id="btn-tambah-img" type="button"--}}
{{--                                            style="margin-top: 35px;"><i class="fa fa-plus"--}}
{{--                                                aria-hidden="true"></i></button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                            @else
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="gambarproduk">@if($status == "insert") Masukkan @else Ubah @endif
                                            Gambar Produk</label><br>
                                        <button class="btn btn-success" id="btn-tambah-img" type="button"
                                                ><i class="fa fa-plus pr-1"
                                                aria-hidden="true"></i>Tambah Gambar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-0" id="img-added-1">
                                @php $i = 1;  @endphp
                                @foreach ($portfolio->product_img as $key => $_img)
                                <div class="col-md-4 row">
                                    <div class="form-group mb-1 " id="gambar-{{$key}}">
                                        <div class="col-md-11">
                                            <img src="{{ asset('uploaded/portfolio/' . $_img) }}" class="mb-3 w-100"  alt="">
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
{{--                                                <div class="col-md-9">--}}
{{--                                                    <input type="file" class="form-control" name="gambarproduk[]" id="gambarproduk"--}}
{{--                                                           aria-describedby="helpId">--}}
{{--                                                </div>--}}
                                                <div class="col-md-3">
                                                    <button type="button"  data-index="{{$key}}" data-id="{{$portfolio->id}}" class="btn close-form btn btn-danger mt-1 hapus-gambar" data-dismiss="alert" aria-label="Close">
                                                        <span class="btn-label pr-1">
                                                            <i class="fa fa-window-close" aria-hidden="true"></i>
                                                        </span>Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        @if($errors->has('gambarproduk'))
                                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                            {{ $errors->first('gambarproduk') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">Delete</span>
                                            </button>
                                        </div>
                                        @endif

                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                            <div class="row justify-content-end d-flex mr-2">
                                <button type="submit" class="btn btn-success">
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
    $(document).ready(function () {

        var i = 0;
        $('#btn-tambah-img').on('click', function () {
            i++;
            var template = $('<div class="row mt-0 pt-0" id="img-added-' + (i + 1) + '">' +
                '<div class="col pr-0">' +
                    '<div class="form-group mb-0">' +
                        '<input type="file" class="form-control" name="gambarproduk[]" id="gambarproduk"' +
                            'aria-describedby="helpId">' +
                    '</div>' +
                '</div>' +
                '<div class="col-md-1 pl-0" style="flex: 0 0 5% !important; max-width: 8%;">' +
                    '<div class="form-group">' +
                        '<button type="button" class="close-form btn btn-danger mt-1" type="button" id="' + (i + 1) +'"' +
                         '><i class="fa fa-window-close" aria-hidden="true"></i></button>' +
                    '</div>' +
                '</div>' +
                '</div>');
            template.insertAfter('#img-added-' + i);
            console.log('#img-added-' + i);
        });

        $(document).on('click', '.close-form', function () {
            i--;
            var id_button = $(this).attr('id');
            $('#img-added-' + id_button + '').remove();
            console.log(i);
        });

        $('.hapus-gambar').on('click', function () {
            var index = $(this).attr('data-index');
            var id = $(this).attr('data-id');
            swal({
                title: "Hapus",
                text: "Apakah anda yakin?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: '{{url('/admin/portofolio/delete-gambar')}}/' + id +'/'+index,
                            type: 'POST',
                            data: {
                                '_method' :'DELETE',
                                '_token' : '{{csrf_token()}}'
                            },
                            success: function (data) {
                                swal("Data Berhasil Dihapus!", {
                                    icon: "success",
                                });
                                $('#gambar-'+index).parent().remove();

                            },
                            error: function (err) {
                                console.log(err);
                            }
                        })
                    } else {
                        swal("Data Gagal Dihapus!", {
                            icon: "error",
                        });
                    }
                });
        });
    });

    tail.select(".select-move", {
        search: true,
        descriptions: true,
        hideSelected: true,
        hideDisabled: true,
        multiLimit: 15,
        multiShowCount: false,
        multiContainer: true,
    });
</script>
@endpush
