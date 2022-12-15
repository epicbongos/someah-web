@extends('admin.layouts.layout')

@section('title', 'Detail Penggajian')

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Gaji Pegawai</h4>
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
                        <a href="#">Penggajian Pegawai</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Data Penggajian</h4>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('salary.update', $gaji->id) }}" method="post"
                                enctype="multipart/form-data">
                                @if (@$gaji)
                                    @method('put')
                                @endif
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="tanggal">Tanggal </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="tanggal" name="tanggal"
                                                value="{{ old('tanggal', @$gaji ? \Carbon\Carbon::createFromFormat('Y-m-d', $gaji->tanggal)->format('d/m/Y') : '') }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="fa fa-calendar-check"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="total_transferred">Total Transferred</label>
                                        <input type="text" class="form-control mask" readonly
                                            value="{{ old('total_transferred', @$gaji->total_transferred) }}"
                                            placeholder="total_transferred">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="keterangan_gaji">Keterangan</label>
                                        <textarea name="keterangan_gaji" id="keterangan_gaji" class="form-control"
                                            rows="5">{{ old('keterangan_gaji', @$gaji->keterangan) }}</textarea>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ url('/admin/salary') }}" class="btn btn-warning"
                                            style="padding: 8px 30px;">Back</a>
                                        <button type="submit" class="btn btn-success"
                                            style="padding: 8px 30px;">Submit</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Detail Gaji</h4>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="mytable" class="table table-striped table-bordered" style="width:100%;">
                                    <thead>
                                        <tr align="center">
                                            <th>No</th>
                                            <th>Nama Pegawai</th>
                                            {{-- <th>Jabatan</th> --}}
                                            <th>Gaji Pokok</th>
                                            <th>Tunjangan Jabatan</th>
                                            <th>Total Penerimaan</th>
                                            <th>Total Potongan</th>
                                            <th>Jumlah Diterima</th>
                                            {{-- <th>Keterangan</th> --}}
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detail_gaji as $val)
                                            {{-- {{dd($val)}}; --}}
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $val->employee->nama }}</td>
                                                {{-- <td>{{$val->employee->position->nama_jabatan}}</td> --}}
                                                <td>{{ number_format($val->gapok) }}</td>
                                                <td>{{ number_format($val->tunj_jabatan) }}</td>
                                                <td>{{ number_format($val->total_gaji) }}</td>
                                                <td>{{ number_format($val->total_potongan) }}</td>
                                                <td>{{ number_format($val->transferred) }}</td>
                                                {{-- <td>{{$val->keterangan}}</td> --}}
                                                <td>
                                                    <a href="{{ url('admin/salary/detail-gaji/' . $val->id) }}"
                                                        class="btn  btn-icon btn-warning round mr-1 mb-1"><i
                                                            class="fas fa-edit"></i></a>
                                                    <a href="#" data-id="{{ $val->id }}"
                                                        class="btn btn-send-email  btn-icon btn-primary round mr-1 mb-1"><i
                                                            class="far fa-paper-plane"></i></a>
                                                    <a href="#" data-id="{{ $val->id }}"
                                                        class="btn btn-del btn-icon btn-danger round mr-1 mb-1"><i
                                                            class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-edit" class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #0C8A42;color: white;">
                    <h5 class="modal-title" id="header-peg"></h5>
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
                <form id="form-detail" enctype="multipart/form-data" method="post">
                    <div class="modal-body">
                        @method('put')
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="form-group col-md-6" id="input-gapok"></div>
                            <div class="form-group col-md-6" id="input-tunj"></div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6" id="input-bonus"></div>
                            <div class="form-group col-md-6" id="input-insentif"></div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6" id="input-reimburs"></div>
                            <div class="form-group col-md-6" id="input-lembur"> </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6" id="input-total_gaji"></div>
                            <div class="form-group col-md-6" id="input-salary_cut"></div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6" id="input-transferred"></div>
                            <div class="form-group col-md-6" id="input-keterangan"></div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('extras-css')
    <style>
        .label {
            position: absolute;
            bottom: 10px;
            text-align: center;
            width: 100%;
            color: white;
            font-weight: bold;
            font-size: 14px;
        }

        .changer:hover {
            cursor: pointer;
            background: linear-gradient(transparent 20%, #ccc 80%);
        }

    </style>
@endpush

@push('extras-js')
    <script>
        $(document).ready(function() {

            $(document).on('keyup', '.keyUp', function() {
                tot_gaji();
                tot_transferred();
                $('#transferred').mask("#.##0", {
                    reverse: true
                });
            });

            $(document).on('keyup', '#salary_cut', function() {
                $('#transferred').mask("#.##0", {
                    reverse: true
                });
            });

            $(document).on('click', '.btn-del', function(e) {
                e.preventDefault();

                var id = $(this).data('id');

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
                                url: '{{ url('/admin/salary/delete-detail') }}/' + id,
                                type: 'GET',

                                success: function(response) {
                                    if (response == 1) {
                                        swal("Data berhasil dihapus!", {
                                            icon: "success",
                                        });
                                        table.ajax.reload();
                                        // window.setTimeout(function() {
                                        //     location.reload();
                                        // }, 1000);
                                    } else {
                                        swal("Data gagal dihapus!");
                                    }
                                }
                            })
                        }
                    });
            });

            $(document).on('click', '.btn-send-email', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                // alert(id);
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
                            url: '{{ url('/admin/salary/send-email-satuan/') }}/' + id,
                            type: 'GET',
                            success: function(data) {
                                swal("Email Berhasil Dikirim", {
                                    icon: "success",
                                });
                                window.setTimeout(function() {
                                    location.reload();
                                }, 1000)

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
            })

            $(document).on('click', '.btn-edit', function() {
                $('#modal-edit').modal('show');

                var id = $(this).data('id');

                var aksi = '{{ url('admin/salary/detail-update') }}/' + id;
                $('#form-detail').attr('action', aksi);
                $.ajax({
                    'url': '{{ url('admin/salary/show-detail-salary/') }}/' + id,
                    'type': 'get',
                    success: function(response) {
                        console.log(response);
                        var header = 'NIP (' + response.detail.employee.nip +
                            ') / ' + response
                            .detail.employee.nama;
                        $('#header-peg').html(header);

                        var gapok = '<label for="gapok">Gapok</label>\n' +
                            '<input type="text" class="form-control mask keyUp" value="' +
                            response.detail.gapok +
                            '" id="gapok" name="gapok" placeholder="">';
                        $('#input-gapok').html(gapok);

                        var tunj =
                            '<label for="tunj_jabatan">Tunjangan Jabatan</label>\n' +
                            '<input type="text" class="form-control mask keyUp" value="' +
                            response.detail.tunj_jabatan +
                            '" id="tunj_jabatan" name="tunj_jabatan" placeholder="">'
                        $('#input-tunj').html(tunj);

                        var bonus = '<label for="bonus">Bonus</label>\n' +
                            '<input type="text" class="form-control mask keyUp" value="' +
                            response.detail.bonus +
                            '" id="bonus" name="bonus" placeholder="">';
                        $('#input-bonus').html(bonus);

                        var insentif =
                            '<label for="insentif_project">Insentif</label>\n' +
                            '<input type="text" class="form-control mask keyUp" value="' +
                            response.detail.insentif_project +
                            '" id="insentif_project" name="insentif_project" placeholder="">';
                        $('#input-insentif').html(insentif);

                        var reimburs = '<label for="reimburs">Reimburse</label>\n' +
                            '<input type="text" class="form-control mask keyUp" value="' +
                            response.detail.reimburse +
                            '" id="reimburse" name="reimburse" placeholder="">';
                        $('#input-reimburs').html(reimburs);

                        var total_gaji =
                            '<label for="total_gaji">Total Gaji</label>\n' +
                            '<input type="text" class="form-control mask keyUp" readonly value="' +
                            response.detail.total_gaji +
                            '" id="total_gaji" name="total_gaji" placeholder="">';
                        $('#input-total_gaji').html(total_gaji);

                        var lembur = ' <label for="lembur">Lembur</label>\n' +
                            '<input type="text" class="form-control mask keyUp" value="' +
                            response.detail.lembur +
                            '" id="lembur" name="lembur" placeholder="">';
                        $('#input-lembur').html(lembur);

                        var salary =
                            ' <label for="salary_cut">Salary Cut</label>\n' +
                            '<input type="text" class="form-control mask keyUp" value="' +
                            response.detail.salary_cut +
                            '" id="salary_cut" name="salary_cut" placeholder="">';
                        $('#input-salary_cut').html(salary);


                        var transferred =
                            '<label for="transferred">Total Transferred</label>\n' +
                            '<input type="text" class="form-control mask keyUp" value="' +
                            response.detail.transferred +
                            '" readonly id="transferred" name="transferred" placeholder="">';
                        $('#input-transferred').html(transferred);

                        if (response.detail.keterangan != null) {
                            var ket = response.detail.keterangan;
                        } else {
                            var ket = '';
                        }
                        var keterangan =
                            '<label for="keterangan" class="col-form-label">Keterangan:</label>\n' +
                            '<textarea class="form-control" id="keterangan" name="keterangan" >' +
                            ket + '</textarea>'
                        $('#input-keterangan').html(keterangan);

                        tot_gaji();
                        tot_transferred();
                    }
                })
            });



            $('#mytable').DataTable();

            $('.mask').mask("#.##0", {
                reverse: true
            });



            $('#tanggal').datetimepicker({
                {{-- date: new Date({{@$gaji->tgl_lahir}}), --}}
                format: 'DD/MM/YYYY',
            });
        });
        $('.changer').on('click', function() {
            $('#ubahphoto').show();
            $('#ubahphoto').on('change', function() {
                var filename = $('#ubahphoto').val();
                if (filename.substring(3, 11) == 'fakepath') {
                    if (filename.length > 30) {
                        filename = filename.substring(12, 30) + '...';
                    } else {
                        filename = filename.substring(12, 30);
                    }
                }
                $('.changer').css('background', 'linear-gradient(transparent 20%, #ccc 80%)');
                $(this).prev().html(filename);
            });
        });

        function tot_gaji() {
            console.log(1);
            var tot_gaji;
            var gapok = $('#gapok').unmask().val();
            var tunj_jabatan = $('#tunj_jabatan').unmask().val();
            var bonus = $('#bonus').unmask().val();
            var insentif_project = $('#insentif_project').unmask().val();
            var reimburse = $('#reimburse').unmask().val();
            var lembur = $('#lembur').unmask().val();
            var salary_cut = $('#salary_cut').unmask().val();
            tot_gaji = Number(gapok) + Number(bonus) + Number(tunj_jabatan) + Number(insentif_project) + Number(
                    reimburse) +
                Number(lembur);

            $('#total_gaji').val(tot_gaji)
        }

        function tot_transferred() {
            var transferred = $('#total_gaji').unmask().val() - $('#salary_cut').unmask().val();
            console.log();
            $('#transferred').val(transferred);
            setInterval(() => {
                $('#transferred').mask("#.##0", {
                    reverse: true
                });
            }, 1);
        }
    </script>
@endpush
