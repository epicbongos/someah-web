@extends('admin.layouts.layout')

@section('title', 'Portofolio')

@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Data Portofolio</h4>
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
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ url('/admin/portfolio/insert-portfolio') }}" class="btn btn-success">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Tambah Data
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="mytable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr align="center">
                                        <th>No</th>
                                        <th>Nama Portofolio</th>
                                        <th style="width: 14% !important;">Tipe Project</th>
                                        <th>Client</th>
                                        <th>Tahun</th>
{{--                                        <th>Gambar Produk</th>--}}
                                        <th style="width: 20% !important;">Deskripsi</th>
                                        <th>Status</th>
{{--                                        <th>Keterangan</th>--}}
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
    $(document).ready(function () {
        $('.owl-carousel').owlCarousel({
            loop: false,
            margin: 10,
            nav: true,
            dots: false,
            lazyload: false,
            items: 1,
        })
    })

    console.log($('.owl-carousel').owlCarousel());

    $(function () {
        $('#mytable').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'portfolio/json',
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
                    data: 'portofolio_name',
                    name: 'portofolio_name'
                },

                {
                    data: 'type',
                    name: 'type'
                },

                {
                    data: 'client',
                    name: 'client'
                },

                {
                    data: 'year',
                    name: 'year'
                },
                // {
                //     data: 'gambar',
                //     name: 'gambar'
                // },

                {
                    data: 'deskripsi',
                    name: 'deskripsi'
                },
                // {
                //     data: 'keterangan',
                //     name: 'keterangan'
                // },

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
                        url: '{{url('/admin/portfolio/delete-portfolio/destroy')}}/' + id,
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

    $(document).on('change', '#change_status_portfolio', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id = $(this).attr('data-id');
        var status = $(this).prop('checked') == true ? 1 : 0;
        $.ajax({
            url: '{{url('/admin/dashboard/portfolio/update/')}}/' + id,
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
