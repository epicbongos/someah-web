@extends('admin.layouts.layout')

@section('title', 'Klien')

@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Data Klien</h4>
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
                    <a href="{{ url('admin/client') }}">Klien</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ url('admin/client/insert-client') }}" class="btn btn-success">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Tambah Data
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="mytable" class="table table-striped table-bordered" style="width: 100%;">
                                <thead align="center">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Perusahaan</th>
                                        <th style="width: 20% !important;">Deskripsi</th>
                                        <th>Website</th>
                                        <th>Logo</th>
                                        <th>Mini Logo</th>
                                        <th>Status</th>
                                        <th style="width: 20% !important;">Aksi</th>
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
    $(function () {
        $('#mytable').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'client/json',
            columns: [{
                    data: 'id',
                    name: 'id',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'company_name',
                    name: 'company_name'
                },
                {
                    data: 'deskripsi',
                    name: 'deskripsi'
                },
                {
                    data: 'website',
                    name: 'website'
                },
                {
                    data: 'gambar_logo',
                    name: 'gambar_logo'
                },
                {
                    data: 'gambar_mini_logo',
                    name: 'gambar_mini_logo'
                },
                {
                    data: 'status',
                    name: 'status'
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
                        url: '{{url('/admin/client/delete-client/destroy/')}}/' + id,
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

    $(document).on('change', '#change_status_client', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id = $(this).attr('data-id');
        var status = $(this).prop('checked') == true ? 1 : 0;
        $.ajax({
            url: '{{url('/admin/dashboard/client/update/')}}/' + id,
            type: 'post',
            data: {
                status: status
            },
            success: function (data) {
                swal("Status Berhasil Diubah", {
                    icon: "success",
                });
                console.log('Berhasil' + data);
            },
            error: function (err) {
                console.log('Gagal' + err);
            }
        })
    })

</script>
@endpush
