@extends('admin.layouts.layout')

@section('title', 'Karir')

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Pelamar</h4>
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
                        <a href="{{ url('admin/karir') }}">Data Pelamar</a>
                    </li>
                </ul>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
                        <div class="col-md-12 pb-3">
                            <div class="tab-content">
                                <div class="card-body pl-1 pr-1">
                                    <div class="table-responsive">
                                        <table id="tableApplicant" class="table table-striped table-bordered"
                                               style="width: 100%;">
                                            <thead>
                                            <tr align="center">
                                                <th>No</th>
                                                <th>Nama Depan</th>
                                                <th>Position</th>
                                                <th>Telepon</th>
                                                <th>Email</th>
                                                <th >Tentang Diri</th>
                                                <th>Attachment</th>
                                                <th style="width: 18%">Aksi</th>

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
                ajax: 'applicant/jsonApplicants',
                columns: [{
                    data: 'id',
                    name: 'id',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'posisi',
                        name: 'posisi'
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




    </script>
@endpush
