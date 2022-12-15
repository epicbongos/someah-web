@extends('admin.layouts.layout')

@section('title', 'Karir')

@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Tipe Lingkup</h4>
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
                    <a href="{{ url('admin/tipe') }}">Tipe Lingkup</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ url('/admin/tipe/insert-tipelingkup') }}" class="btn btn-success">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Tambah Data
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tablelingkup" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr align="center">
                                    <th>No</th>
                                    <th>Tipe Lingkup</th>
                                    <th>Slug</th>
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
</style>
@endpush

@push('extras-js')
<script>



    $(function () {
        $('#tablelingkup').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'tipe/jsonlingkup',
            columns: [{
                    data: 'id',
                    name: 'id',
                    render: function (data, type, row, meta) {
                        if (data == 0) {} else {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    }
                },
                {
                    data: 'tipe_lingkup',
                    name: 'tipe_lingkup'
                },
                {
                    data: 'slug',
                    name: 'slug'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                }
            ]
        });
    });

    function deleteDataKarir(id) {
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
                        url: '/admin/tipe/delete-tipe-karir/destroy/' + id,
                        type: 'POST',
                        success: function (data) {
                            swal("Data Berhasil Dihapus!", {
                                icon: "success",
                            });
                            $('#tablekarir').DataTable().ajax.reload();
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

    function deleteDataProject(id) {
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
                        url: '{{url('/admin/tipe/delete-tipe-project/destroy/')}}/'  + id,
                        type: 'POST',
                        success: function (data) {
                            swal("Data Berhasil Dihapus!", {
                                icon: "success",
                            });
                            $('#tableproject').DataTable().ajax.reload();
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

    function deleteDataLingkup(id) {
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
                        url: '/admin/tipe/delete-tipe-lingkup/destroy/' + id,
                        type: 'POST',
                        success: function (data) {
                            swal("Tipe Lingkup Berhasil Dihapus!", {
                                icon: "success",
                            });
                            $('#tablelingkup').DataTable().ajax.reload();
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
