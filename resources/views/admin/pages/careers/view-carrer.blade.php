@extends('admin.layouts.layout')

@section('title', 'Karir')

@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Data Lowongan Pekerjaan</h4>
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
                    <a href="{{ url('admin/karir') }}">Data Lowongan Pekerjaan</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ url('/admin/karir/insert-karir') }}" class="btn btn-success">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Tambah Data
                        </a>
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive">
                            <table id="tableCarrer" class="table table-striped table-bordered"
                                style="width: 100%;">
                                <thead>
                                    <tr align="center">
                                        <th>No</th>
                                        <th>Job Position</th>
                                        <th style="width: 23% !important;">Deskripsi</th>
                                        <th>slug</th>
                                        <th>Type</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('extras-css')
<style>
    .clearfix {
        clear: both;
    }

    tbody>tr {
        text-align: center;
    }

    tbody>tr>td:last-child {
        justify-content: center;
        align-items: center;
        display: flex;
    }

    .custom-select {
        width: 45% !important;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 30px;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 24px;
        width: 24px;
        left: 3.5px;
        bottom: 3px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #35CD3A;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(18px);
        -ms-transform: translateX(18px);
        transform: translateX(18px);
    }

    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
@endpush

@push('extras-js')
<script>

    {{--function download(id) {--}}
    {{--    $.ajax({--}}
    {{--        url: '{{url('/admin/karir/download/')}}/' + id,--}}
    {{--        type: 'post',--}}
    {{--        'data' : {--}}
    {{--            '_method' :'post',--}}
    {{--            '_token' :'{{csrf_token()}}'--}}
    {{--        },--}}
    {{--        success: function (data) {--}}

    {{--        },--}}
    {{--        error: function (err) {--}}
    {{--            console.log(err);--}}
    {{--        }--}}
    {{--    })--}}
    {{--}--}}

    $(function () {
        $('#tableApplicant').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'karir/jsonApplicants',
            columns: [{
                    data: 'id',
                    name: 'id',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'first_name',
                    name: 'first_name'
                },
                {
                    data: 'last_name',
                    name: 'last_name'
                },
                {
                    data: 'telp',
                    name: 'telp'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'desc',
                    name: 'desc'
                },
                {
                    data: 'attachment',
                    name: 'attachment'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                }
            ]
        });
    });

    $(function () {
        $('#tableCarrer').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'karir/jsonCarrer',
            columns: [{
                    data: 'id',
                    name: 'id',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'job_position',
                    name: 'job_position'
                },
                {
                    data: 'desc',
                    name: 'desc'
                },
                {
                    data: 'slug',
                    name: 'slug'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                }
            ]
        });
    });

    function deleteApplicant(id) {
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
                        url: '{{url('/admin/karir/delete-pelamar/destroy/')}}/' + id,
                        type: 'POST',
                        success: function (data) {
                            swal("Data Berhasil Dihapus!", {
                                icon: "success",
                            });
                            $('#tableApplicant').DataTable().ajax.reload();
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
    }

    function deleteKarir(id) {
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
                        url: '{{url('/admin/karir/delete-karir/destroy/')}}/' + id,
                        type: 'POST',
                        success: function (data) {
                            swal("Data Berhasil Dihapus!", {
                                icon: "success",
                            });
                            $('#tableCarrer').DataTable().ajax.reload();
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
    }


</script>
@endpush
