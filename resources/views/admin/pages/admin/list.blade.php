@extends('admin.layouts.layout')

@section('title', 'Admin')

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Admin</h4>
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
                        <a href="{{ url('admin/admin') }}">Admin </a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ url('/admin/admin/create/') }}" class="btn btn-success">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                                Tambah Data
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="mytable" class="table table-striped table-bordered" style="width:100%;">
                                    <thead>
                                    <tr align="center">
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
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

        .custom-select
        {
            width: 45% !important;
        }
    </style>
@endpush

@push('extras-js')
    <script>
        $(function () {
            $('#mytable').DataTable({
                processing: true,
                serverSide: true,
                ajax: 'admin/json',
                columns: [{
                    data: 'id',
                    name: 'id',
                    render: function (data, type, row, meta) {
                        if (data == 0)
                        {
                        } else {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    }
                },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    }
                ]
            });
        });

        function deleteData(id) {
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
                            url: '{{url('/admin/admin/delete')}}/' + id,
                            type: 'POST',
                            success: function (data) {
                                swal("Data Berhasil Dihapus!", {
                                    icon: "success",
                                });
                                $('#mytable').DataTable().ajax.reload();
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
