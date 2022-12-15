@extends('admin.layouts.layout')

@section('title', 'Anggota Tim')

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Data Pelatihan Pegawai</h4>
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
                        <a href="{{ route('training') }}">Pelatihan Pegawai</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('training.show.insert') }}">Tambah Pelatihan</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="col-md-14">
                                <form enctype="multipart/form-data" method="POST"
                                    action="{{ @$training ? route('training.update', $training->id) : route('training.insert.store') }}">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-5"
                                            style="padding-right: 100px !important;padding-left: 0px !important;">
                                            <div class="form-group">
                                                <label for="employee_id" class="mb-2 pb-2">
                                                    Masukkan id pelatihan
                                                </label>
                                                <br />
                                                <select class="form-control form-control " name="employee_id"
                                                    id="employee_id">
                                                    <option value="">Pilih Id Pegawai</option>
                                                    @foreach ($employees as $employee)
                                                        <option value="{{ $employee->id }}"
                                                            {{ @$training->employee_id == $employee->id ? 'selected' : '' }}>
                                                            {{ @$employee->id . ' - ' . $employee->nama }}
                                                        </option>
                                                    @endforeach
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5"
                                            style="padding-right: 100px !important;padding-left: 0px !important;">
                                            <div class="form-group">
                                                <label for="" class="mb-2 pb-2">Masukkan Nama
                                                    Pelatihan</label>
                                                <br />
                                                <input type="text" class="form-control w-100" name="nama_pelatihan"
                                                    id="nama_pelatihan" aria-describedby="helpId"
                                                    placeholder="Masukkan Nama Pelatihan"
                                                    value="{{ @$training->nama_pelatihan }} {{ old('nama_pelatihan') }}"
                                                    required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"
                                            style="padding-right: 0px !important;padding-left: 0px !important;">
                                            <div class="form-group">
                                                <label for="tipe_pelatihan" class="mb-2 pb-2">Masukkan Tipe
                                                    Pelatihan</label>
                                                <br />
                                                <select class="form-controlz form-control " name="tipe_pelatihan"
                                                    id="tipe_pelatihan">
                                                    <option value="">Pilih Bank ...</option>
                                                    <option value="Workshop"
                                                        {{ old('tipe_pelatihan', @$training->tipe_pelatihan) == 'Workshop' ? 'selected' : '' }}>
                                                        Workshop
                                                    </option>
                                                    <option value="Online Course"
                                                        {{ old('tipe_pelatihan', @$training->tipe_pelatihan) == 'Online Course' ? 'selected' : '' }}>
                                                        Online Course
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3"
                                            style="padding-right: 0px !important;padding-left: 0px !important;">
                                            <div class="form-group">
                                                <label for="penyelenggaraan" class="mb-2 pb-2">Masukkan
                                                    penyelenggaraan</label>
                                                <br />
                                                <input type="text" class="form-control w-100" name="penyelenggaraan"
                                                    id="penyelenggaraan" aria-describedby="helpId"
                                                    placeholder="Masukkan penyelenggaraan"
                                                    value="{{ @$training->penyelenggaraan }} {{ old('penyelenggaraan') }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-3"
                                            style="padding-right: 0px !important;padding-left: 0px !important;">
                                            <div class="form-group">
                                                <label for="biaya" class="mb-2 pb-2">Masukkan biaya</label> <br />
                                                <input type="text" class="form-control mask w-100" name="biaya" id="biaya"
                                                    data-type="currency" placeholder="Masukan Biaya"
                                                    aria-describedby="helpId"
                                                    value="{{ @$training->biaya }} {{ old('biaya') }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-6"
                                            style="padding-right: 0px !important;padding-left: 0px !important;">
                                            <div class="form-group">
                                                <label for="laporan" class="mb-2 pb-2">Masukkan laporan</label>
                                                <br />
                                                <input type="text" class="form-control w-100" name="laporan" id="laporan"
                                                    aria-describedby="helpId" placeholder="Masukkan laporan"
                                                    value="{{ @$training->laporan }} {{ old('laporan') }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-3"
                                            style="padding-right: 0px !important;padding-left: 0px !important;">
                                            <div class="form-group">
                                                <label for="mulai_pelatihan" class="mb-2 pb-2">Masukkan mulai
                                                    pelatihan</label>
                                                <br />
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="mulai_pelatihan"
                                                        name="mulai_pelatihan" autocomplete="off"
                                                        value="{{ old('mulai_pelatihan',@$training ? \Carbon\Carbon::createFromFormat('Y-m-d', $training->mulai_pelatihan)->format('m/d/Y') : '') }}" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-calendar-check"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3"
                                            style="padding-right: 0px !important;padding-left: 0px !important;">
                                            <div class="form-group">
                                                <label for="akhir_pelatihan" class="mb-2 pb-2">Masukkan akhir
                                                    pelatihan</label>
                                                <br />
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="akhir_pelatihan"
                                                        name="akhir_pelatihan" autocomplete="off"
                                                        value="{{ old('akhir_pelatihan',@$training ? \Carbon\Carbon::createFromFormat('Y-m-d', $training->akhir_pelatihan)->format('m/d/Y') : '') }}" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-calendar-check"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3"
                                            style="padding-right: 0px !important;padding-left: 0px !important;">
                                            <div class="form-group">
                                                <label for="pdf" class="mb-2 pb-2 form-label">Upload file PDF</label> <br>
                                                <input type="file" name="pdf" id="pdf" class="pdf form-control"
                                                    value="{{ @$training->pdf }} {{ old('pdf') }}" />
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="row justify-content-end d-flex mt-2">
                                <button type="submit" class="btn btn-success mr-4" id="submit">
                                    <span class="btn-label pr-1">
                                        <i class="fas fa-save"></i>
                                    </span>
                                    Submit
                                </button>
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
        input:not(:placeholder-shown) {
            background-color: #fff !important;
        }

        input:placeholder-shown {
            background-color: #fff !important;
        }

    </style>
@endpush

@push('extras-js')
    <script>
        var start = new Date();
        var end = new Date(new Date().setYear(start.getFullYear() + 1));

        $('#akhir_pelatihan').datepicker({
            format: 'DD/MM/YYYY',
        });
        $('#mulai_pelatihan').datepicker({
            startDate: start,
            endDate: end,
        }).on('changeDate', function() {
            // set the "akhir_pelatihan" start to not be later than "mulai_pelatihan" ends:
            $('#akhir_pelatihan'.datepicker('setStartDate', new Date($(this).val())));
        })
        $('.mask').mask("#.##0", {
            reverse: true,
            autoUnmask: true,
        });
    </script>
@endpush
