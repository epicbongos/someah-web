@extends('admin.layouts.layout')

@section('title', 'Estimasi')

@section('content')
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Data Estimasi Project</h4>
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
                    <a href="{{ url('admin/estimasi') }}">Estimasi Project</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="estimasi-table" class="table table-striped table-bordered" style="width: 100%;">
                                <thead align="center">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nama</th>
                                        <th>Kontak</th>
                                        <th>Perusahaan</th>
                                        <th>Lingkup</th>
                                        <th>Gambaran Umum</th>
                                        <th width="150">Aksi</th>
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
        var table;
        table = $('#estimasi-table').DataTable({
            columnDefs: [
                { orderable: false, targets: [0,5,6] },
            ],
            deferRender: true,
            serverSide: true,
            processing: true,
            stateSave: true,
            ajax: {
                url: '{!! route('estimasi.get') !!}',
                type: 'POST',
                data: function (e) {
                    e._token = '{{ csrf_token() }}';
                    // Add filter disini
                    // e.country_id = $("#country_id").val();
                    // e.province_id = $("#province_id").val();
                    // e.city_id = $("#city_id").val();
                    // e.date = $("#DATE").VAL();
                    // return e;
                }
            },
            drawCallback: function (){
                // feather.replace();
            }
        });

        $('#mytable').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'estimasi/json',
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
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'perusahaan',
                    name: 'perusahaan'
                },
                {
                    data: 'nama_seluler',
                    name: 'nama_seluler'
                },
                {
                    data: 'bidang_perusahaan',
                    name: 'bidang_perusahaan'
                },
                {
                    data: 'asal_perusahaan',
                    name: 'asal_perusahaan'
                },
                {
                    data: 'ide_anda',
                    name: 'ide_anda'
                },
                {
                    data: 'lingkup',
                    name: 'lingkup'
                },
                {
                    data: 'project',
                    name: 'project'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                }
            ]
        });
    });

    function deleteEstimasi(id) {
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
                        url: '/admin/estimasi/delete-estimasi/destroy/' + id,
                        type: 'POST',
                        success: function (data) {
                            swal("Estimasi Berhasil Dihapus!", {
                                icon: "success",
                            });
                            $('#mytable').DataTable().ajax.reload();
                        },
                        error: function (err) {
                            console.log(err);
                        }
                    })
                } else {
                    swal("Team Gagal Dihapus!", {
                        icon: "error",
                    });
                }
            });
    }
</script>
@endpush
