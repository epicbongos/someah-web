@extends('admin.layouts.layout')

@section('title')
@endsection

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">{{ @$posisi ? 'Ubah' : 'Tambah' }} Posisi / Jabatan</h4>
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
                        <a href="#">{{ @$posisi ? 'Ubah' : 'Tambah' }} Posisi / Jabatan</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="mb-0">Jabatan Pegawai</h2>
                        </div>
                        <div class="card-body">
                            <form
                                action="{{ @$posisi ? route('position.update', $posisi->id) : route('position.store') }}"
                                method="post" enctype="multipart/form-data">
                                @if (@$posisi)
                                    @method('put')
                                @endif
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="nama_jabatan">Nama Jabatan</label>
                                        <input type="text" class="form-control" value="{{ @$posisi->nama_jabatan }}"
                                            name="nama_jabatan" placeholder="Nama Jabatan">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="status_posisi">Status</label>
                                        <select class="form-control" name="status_posisi" id="status_posisi">
                                            <option>Pilih Status ...</option>
                                            <option value="Tetap"
                                                {{ old('status_posisi', @$posisi->status_posisi) == 'Tetap' ? 'Selected' : '' }}>
                                                Tetap
                                            </option>
                                            <option value="Contract"
                                                {{ old('status_posisi', @$posisi->status_posisi) == 'Contract' ? 'Selected' : '' }}>
                                                Contract
                                            </option>
                                        </select>
                                        {{-- <input type="text" class="form-control" value="{{ @$posisi->nama_jabatan }}"
                                            name="nama_jabatan" placeholder="Nama Jabatan"> --}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="gapok">Gaji Pokok</label>
                                        <input type="text" class="form-control money-format" id="gapok"
                                            value="{{ @$posisi->gapok }}" name="gapok" placeholder="Gaji Pokok">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="tunj_jabatan">Tunjangan Jabatan</label>
                                        <input type="text" class="form-control money-format" id="tunj_jabatan"
                                            value="{{ @$posisi->tunj_jabatan }}" name="tunj_jabatan"
                                            placeholder="Tunjangan">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="tunj_jabatan">Tunjangan Transportasi</label>
                                        <input type="text" class="form-control money-format" id="tunj_jabatan"
                                            value="{{ @$posisi->tunj_transportasi }}" name="tunj_transportasi"
                                            placeholder="Tunjangan">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ url('/admin/position') }}" class="btn btn-warning"
                                            style="padding: 8px 30px;">Back</a>
                                        <button type="submit" class="btn btn-success"
                                            style="padding: 8px 30px;">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
            $('.money-format').mask("#.##0", {
                reverse: true
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
    </script>
@endpush
