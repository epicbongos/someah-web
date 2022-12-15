@extends('admin.layouts.layout')

@section('title', 'Penggajian')

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Gaji</h4>
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
                        <a href="{{ url('admin/salary') }}">Pegawai </a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="#" id="tambah-gaji" class="btn btn-success">
                                <span class="btn-label">
                                    <i class="fa fa-plus"></i>
                                </span>
                                Buat Penggajian
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="mytable" class="table table-striped table-bordered" style="width:100%;">
                                    <thead>
                                        <tr align="center">
                                            <th>No</th>
                                            <th>Bulan & Tahun</th>
                                            <th>Total Transferred</th>
                                            <th>Subject Email</th>
                                            <th>Status</th>
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



    <div id="modal-tambah" class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header" style="background-color: #008A85;color: white;">
                    <h5 class="modal-title" id="exampleModalLabel">Buat Penggajian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('salary.store') }}" enctype="multipart/form-data" method="post">

                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="tanggal">Tanggal:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="tanggal" name="tanggal">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar-check"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="keterangan" class="col-form-label">Subject Email:</label>
                            <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="table-responsive">
                                <table id="mytable2" class="table table-striped table-bordered" style="width:100%;">
                                    <thead>
                                        <tr align="center">
                                            <th>No</th>
                                            <th>Nama Pegawai</th>
                                            <th>Jabatan</th>
                                            <th>Gaji Pokok</th>
                                            <th>Tunjangan Jabatan</th>
                                            <th>Tunjangan Transportasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pegawai as $val)
                                            {{-- {{ dd($pegawai) }} --}}
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $val->nama }}</td>
                                                {{-- <td>{{ $val['nama'] }}</td> --}}
                                                <td>{{ $val->position->nama_jabatan }}</td>
                                                <td>{{ number_format($val->position->gapok) }}</td>
                                                <td>{{ number_format($val->position->tunj_jabatan) }}</td>
                                                <td>{{ number_format($val->position->tunj_transportasi) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Generate Gaji</button>
                    </div>


                </form>

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
        var table = null;
        // $(document).ready(function() {
        //     var table = $('#mytable2').DataTable({});

        //     $('form').on('submit', function(e) {
        //         var $form = $(this);

        //         // Iterate over all checkboxes in the table
        //         table.$('input[type="checkbox"]').each(function() {
        //             // If checkbox doesn't exist in DOM
        //             if (!$.contains(document, this)) {
        //                 // If checkbox is checked
        //                 if (this.checked) {
        //                     // Create a hidden element
        //                     $form.append(
        //                         $('<input>')
        //                         .attr('type', 'hidden')
        //                         .attr('name', this.name)
        //                         .val(this.value)
        //                     );
        //                 }
        //             }
        //         });
        //     });
        // });
        $(function() {
            var dateNow = new Date();
            $('#tanggal').datetimepicker({
                defaultDate: dateNow,
                format: 'DD/MM/YYYY',
            });
        })

        $(document).on('click', '#tambah-gaji', function() {
            $('#modal-tambah').modal('show');
        });

        $(function() {
            table = $('#mytable').DataTable({
                processing: true,
                serverSide: true,
                ajax: 'salary/json',
                columns: [{
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            if (data == 0) {} else {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        }
                    },

                    {
                        data: 'bulan',
                        name: 'bulan'
                    },
                    {
                        data: 'total_transferred',
                        name: 'total_transferred'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
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

        function sendEmail(id) {
            swal({
                title: "Kirim Email",
                text: "Anda yakin ingin mengirim email?",
                icon: "info",
                buttons: true,
            }).then((willSend) => {
                if (willSend) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ url('/admin/salary/send-email/') }}/' + id,
                        type: 'GET',
                        success: function(data) {
                            swal("Email Berhasil Dikirim", {
                                icon: "success",
                            });
                            table.ajax.reload();
                        },
                        error: function(err) {
                            console.log(err);
                        }
                    })
                } else {
                    swal("Mengirim Email dibatalkan", {
                        icon: "error",
                    });
                }
            })
        }

        // add these at first line of script:
        // add, var table = null;


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
                            url: '{{ url('/admin/salary/') }}/' + id,
                            type: 'POST',
                            'data': {
                                '_method': 'DELETE',
                                '_token': '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                swal("Data Berhasil Dihapus!", {
                                    icon: "success",
                                });
                                table.ajax.reload();
                                // window.setTimeout(function() {
                                //     location.reload();
                                // }, 1000);
                            },
                            error: function(err) {
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
