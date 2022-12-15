@extends('admin.layouts.layout')

@section('title')
@endsection

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">{{ @$pegawai ? 'Ubah' : 'Tambah' }} Pegawai</h4>
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
                        <a href="#">{{ @$pegawai ? 'Ubah' : 'Tambah' }} Pegawai</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="mb-0">Detail Pegawai</h2>
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
                            <form
                                action="{{ @$pegawai ? route('employee.update', $pegawai->id) : route('employee.store') }}"
                                method="post" enctype="multipart/form-data">
                                @if (@$pegawai)
                                    @method('put')
                                @endif
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="input-file input-file-image col-md-12" align="center">
                                        <img class="img-upload-preview" width="250"
                                            src="{{ @$pegawai ? asset("uploaded/employee/$pegawai->photo") : asset('assets/images/employee-placeholder.png') }}"
                                            alt="preview">
                                        <input type="file" class="form-control form-control-file" id="photo" name="photo"
                                            accept="image/*">
                                        <label for="photo" class="  label-input-file btn btn-default btn-round">
                                            <span class="btn-label">
                                                <i class="fa fa-file-image"></i>
                                            </span>
                                            Upload Photo Pegawai
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="nip">NIP</label>
                                        <input type="text" class="form-control"
                                            value="{{ old('nip') ?? @$pegawai->nip }}" name="nip" placeholder="NIP">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="nama">Nama Pegawai</label>
                                        <input type="text" class="form-control"
                                            value="{{ @$pegawai->nama }}{{ old('nama') }}" name="nama"
                                            placeholder="Nama Pegawai">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="npwp">NPWP</label>
                                        <input type="text" class="form-control"
                                            value="{{ old('npwp') ?? @$pegawai->npwp }}" name="npwp"
                                            placeholder="Nomor NPWP">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="ktp">Nomor KTP</label>
                                        <input type="text" class="form-control"
                                            value="{{ @old('ktp') ?? @$pegawai->ktp }}" name="ktp"
                                            placeholder="Nomor KTP">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="email">Email Pegawai</label>
                                        <input type="email" class="form-control"
                                            value="{{ @old('email') ?? @$pegawai->email }}" name="email"
                                            placeholder="email@someah.id">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="position_id">Posisi</label>
                                        <select class="form-control" name="position_id" id="position_id">
                                            <option value="">Pilih posisi...</option>
                                            @foreach ($posisi as $val)
                                                <option value="{{ $val->id }}"
                                                    {{ (@old('position_id') ?? @$pegawai->position_id) == @$val->id ? 'selected' : '' }}>
                                                    {{ $val->id }}. {{ $val->nama_jabatan }} |
                                                    {{ $val->status_posisi }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="tempat">Tempat Lahir</label>
                                        <input type="text" class="form-control"
                                            value="{{ @$pegawai->tempat }}{{ old('tempat') }}" name="tempat"
                                            placeholder="Tempat Lahir">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="tgl_lahir">Tanggal Lahir</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                                value="{{ old('tgl_lahir',@$pegawai ? \Carbon\Carbon::createFromFormat('Y-m-d', $pegawai->tgl_lahir)->format('d/m/Y') : '') }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="fa fa-calendar-check"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="bank">Bank Digunakan</label>
                                        <select class="form-control" name="bank" id="bank">
                                            <option value="">Pilih Bank...</option>
                                            <option value="BCA"
                                                {{ old('bank', @$pegawai->bank) == 'BCA' ? 'selected' : '' }}>BCA
                                            </option>
                                            <option value="BNI"
                                                {{ old('bank', @$pegawai->bank) == 'BNI' ? 'selected' : '' }}>BNI
                                            </option>
                                            <option value="BNI SYARIAH"
                                                {{ old('bank', @$pegawai->bank) == 'BNI SYARIAH' ? 'selected' : '' }}>BNI
                                                SYARIAH</option>
                                            <option value="BRI"
                                                {{ old('bank', @$pegawai->bank) == 'BRI' ? 'selected' : '' }}>BRI
                                            </option>
                                            <option value="BRI SYARIAH"
                                                {{ old('bank', @$pegawai->bank) == 'BRI SYARIAH' ? 'selected' : '' }}>BRI
                                                SYARIAH</option>
                                            <option value="BSI"
                                                {{ old('bank', @$pegawai->bank) == 'BSI' ? 'selected' : '' }}>BSI (BANK
                                                SYARIAH INDONESIA)</option>
                                            <option value="JENIUS"
                                                {{ old('bank', @$pegawai->bank) == 'JENIUS' ? 'selected' : '' }}>
                                                JENIUS/BTPN</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="no_rekening">Nomor Rekening</label>
                                        <input type="text" class="form-control" id="no_rekening"
                                            value="{{ old('no_rekening') ?? @$pegawai->no_rekening }}" name="no_rekening"
                                            placeholder="Nomor Rekening">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="no_telepon">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="no_rekening"
                                            value="{{ old('no_telepon') ?? @$pegawai->no_telepon }}" name="no_telepon"
                                            placeholder="Nomor Telepon">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="nama_ibu">Nama Gadis Ibu</label>
                                        <input type="text" class="form-control" id="nama_ibu"
                                            value="{{ old('nama_ibu') ?? @$pegawai->nama_ibu }}" name="nama_ibu"
                                            placeholder="Nama Gadis Ibu">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="alamat">Alamat Tinggal</label>
                                        <textarea name="alamat" id="alamat" class="form-control"
                                            rows="5">{{ @$pegawai->alamat }}{{ old('alamat') }}</textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="status_pegawai">Status Pegawai</label>
                                        <select class="form-control form-control " name="status_pegawai"
                                            id="status_pegawai">
                                            <option value="">Pilih Status...</option>
                                            <option value="aktif"
                                                {{ old('status_pegawai', @$pegawai->status_pegawai) == 'aktif' ? 'selected' : '' }}>
                                                Aktif
                                            </option>
                                            <option value="non-aktif"
                                                {{ old('status_pegawai', @$pegawai->status_pegawai) == 'non-aktif' ? 'selected' : '' }}>
                                                Non-Aktif
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <a href="{{ url('/admin/admin') }}" class="btn btn-warning"
                                            style="padding: 8px 30px;">Back</a>
                                        <button type="submit" class="btn btn-success"
                                            style="padding: 8px 30px;">Submit</button>
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


            $('#tgl_lahir').datetimepicker({
                {{-- defaultDate: "{{$pegawai ? \Carbon\Carbon::createFromFormat('Y-m-d',$pegawai->tgl_lahir)->format('d/m/Y') : '' }}", --}}
                format: 'DD/MM/YYYY',

            });

            $('.changer').on('click', function() {
                $('#ubahphoto').show();
                alert(1)
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
        });
    </script>
@endpush
