@extends('admin.layouts.layout')

@section('title', 'Dashboard')

@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Dashboard</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ url('admin/') }}">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
            </ul>
        </div>
{{--        <div class="row mt-2">--}}
{{--            <div class="col-12">--}}
{{--                <div class="card">--}}
{{--                    <ul class="nav nav-line nav-color-success" id="myTab" role="tablist">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link active" id="slider-tab" data-toggle="tab" href="#slider" role="tab"--}}
{{--                                aria-controls="home" aria-selected="true">Portfolio Slider</a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" id="client-tab" data-toggle="tab" href="#client" role="tab"--}}
{{--                                aria-controls="profile" aria-selected="false">Client</a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}

{{--                    <div class="col-12 mt-2">--}}
{{--                        <div class="tab-content">--}}
{{--                            <div class="tab-pane port-slider" id="slider" role="tabpanel" aria-labelledby="home-tab">--}}
{{--                                <div class="card-body pl-0 pr-0">--}}
{{--                                    <div class="table-responsive">--}}
{{--                                        <table id="tablePortfolio" class="table table-striped table-bordered"--}}
{{--                                            style="width:100%">--}}
{{--                                            <thead>--}}
{{--                                                <tr align="center">--}}
{{--                                                    <th>No</th>--}}
{{--                                                    <th>Nama Portofolio</th>--}}
{{--                                                    <th style="width: 25% !important;">Deskripsi</th>--}}
{{--                                                    <th>Gambar Produk</th>--}}
{{--                                                    <th>Mini Logo</th>--}}
{{--                                                    <th>Status</th>--}}
{{--                                                </tr>--}}
{{--                                            </thead>--}}
{{--                                        </table>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="tab-pane client" id="client" role="tabpanel" aria-labelledby="client-tab">--}}
{{--                                <div class="card-body pl-0 pr-0">--}}
{{--                                    <div class="table-responsive">--}}
{{--                                        <table id="tableKlien" class="table table-striped table-bordered"--}}
{{--                                            style="width:100%">--}}
{{--                                            <thead>--}}
{{--                                                <tr align="center">--}}
{{--                                                    <th>No</th>--}}
{{--                                                    <th>Nama Perusahaan</th>--}}
{{--                                                    <th>Logo</th>--}}
{{--                                                    <th width="170px !important;">Status</th>--}}
{{--                                                </tr>--}}
{{--                                            </thead>--}}
{{--                                        </table>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</div>
@endsection

@push('extras-css')
<style>
    td {
        top: 0;
        bottom: 0px;
        height: 100% !important;
    }

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

    $(document).on('change', '#change_status_client', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id = $(this).attr('data-id');
        var status = $(this).prop('checked') == true ? 1 : 0;
        $.ajax({
            url: '/admin/dashboard/client/update/' + id,
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

    $(document).on('change', '#change_status_portfolio', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id = $(this).attr('data-id');
        var status = $(this).prop('checked') == true ? 1 : 0;
        $.ajax({
            url: '/admin/dashboard/portfolio/update/' + id,
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

    $(function () {
        $('#tableKlien').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'admin/dashboard/jsonklien',
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
                    data: 'gambar_logo',
                    name: 'gambar_logo'
                },
                {
                    data: 'status',
                    name: 'status'
                },
            ]
        });
    });

    $(function () {
        $('#tablePortfolio').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'admin/dashboard/jsonportfolio',
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
                    data: 'deskripsi',
                    name: 'deskripsi'
                },
                {
                    data: 'gambar',
                    name: 'gambar'
                },
                {
                    data: 'mini_logo',
                    name: 'mini_logo'
                },
            ]
        });
    });
</script>
@endpush
