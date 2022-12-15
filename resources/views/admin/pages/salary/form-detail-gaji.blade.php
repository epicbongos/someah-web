@extends('admin.layouts.layout')

@section('title')
@endsection

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Detail Gaji Pegawai</h4>
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
                        <a href="{{ route('salary.show', $detail->salary_id) }}">Penggajian Pegawai</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Detal Gaji</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row" class="justify-content-between">
                                <div class="col-md-6">
                                    <h2 class="mb-0">{{ $detail->employee->nama }}
                                        ({{ $detail->employee->nip }})</h2>

                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-success" style="float: right"
                                        id="generate-bpjs"><span>Generate BPJS</span></button>

                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Rincian Penerimaan</h5>
                                </div>
                                <div class="col-md-6">
                                    <h5>Rincian Potongan</h5>
                                </div>
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
                            <form action="{{ route('salary_detail.update', $detail->id) }}" method="post"
                                enctype="multipart/form-data">
                                @method('put')

                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="gapok">Gaji Pokok</label>
                                        <input type="text" class="form-control mask gajtunj"
                                            value="{{ $detail->gapok }}{{ old('gapok') }}" name="gapok"
                                            placeholder="gapok" id="gapok">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="pph21">Pajak PPH Pasal 21</label>
                                        <input type="text" class="form-control mask gajian"
                                            value="{{ $detail->pph21 }}{{ old('pph21') }}" name="pph21"
                                            placeholder="pph21" id="pph21">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="tunj_hari_raya">Tunjangan Hari Raya</label>
                                        <input type="text" class="form-control mask gajian"
                                            value="{{ $detail->tunj_hari_raya }}{{ old('tunj_hari_raya') }}"
                                            name="tunj_hari_raya" placeholder="tunj_hari_raya" id="tunj_hari_raya">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="iuran_bpjs_someah">Iuran BPJS Kesehatan Someah</label>
                                        <input type="text" class="form-control mask gajian"
                                            value="{{ $detail->iuran_bpjs_someah }}{{ old('iuran_bpjs_someah') }}"
                                            name="iuran_bpjs_someah" placeholder="iuran_bpjs_someah" id="iuran_bpjs_someah">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="tunj_transport">Tunjangan Transportasi</label>
                                        <input type="text" class="form-control mask gajian"
                                            value="{{ $detail->tunj_transport }}{{ old('tunj_transport') }}"
                                            name="tunj_transport" placeholder="0" id="tunj_transport">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="iuran_bpjs_kes1">Iuran BPJS Kesehatan - 1%</label>
                                        <input type="text" class="form-control mask gajian"
                                            value="{{ $detail->iuran_bpjs_kes1 }}{{ old('iuran_bpjs_kes1') }}"
                                            name="iuran_bpjs_kes1" placeholder="iuran_bpjs_kes1" id="iuran_bpjs_kes1">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="tunj_bpjs_kes">Tunjangan BPJS Kesehatan</label>
                                        <input type="text" class="form-control mask gajian"
                                            value="{{ $detail->tunj_bpjs_kes }}{{ old('tunj_bpjs_kes') }}"
                                            name="tunj_bpjs_kes" placeholder="tunj_bpjs_kes" id="tunj_bpjs_kes">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="iuran_bpjs_jkk">Iuran BPJS JKK, JKM, JHT - 4.24%</label>
                                        <input type="text" class="form-control mask gajian"
                                            value="{{ $detail->iuran_bpjs_jkk }}{{ old('iuran_bpjs_jkk') }}"
                                            name="iuran_bpjs_jkk" placeholder="iuran_bpjs_jkk" id="iuran_bpjs_jkk">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="tunj_bpjs_jkk">Tunjangan BPJS JKK 0.24%</label>
                                        <input type="text" class="form-control mask gajian"
                                            value="{{ $detail->tunj_bpjs_jkk }}{{ old('tunj_bpjs_jkk') }}"
                                            name="tunj_bpjs_jkk" placeholder="tunj_bpjs_jkk" id="tunj_bpjs_jkk">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="iuran_bpjs_jht">Iuran BPJS JHT - 2% </label>
                                        <input type="text" class="form-control mask gajian"
                                            value="{{ $detail->iuran_bpjs_jht }}{{ old('iuran_bpjs_jht') }}"
                                            name="iuran_bpjs_jht" placeholder="iuran_bpjs_jht" id="iuran_bpjs_jht">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="tunj_bpjs_jkm">Tunjangan BPJS JKM 0.30%</label>
                                        <input type="text" class="form-control mask gajian"
                                            value="{{ $detail->tunj_bpjs_jkm }}{{ old('tunj_bpjs_jkm') }}"
                                            name="tunj_bpjs_jkm" placeholder="tunj_bpjs_jkm" id="tunj_bpjs_jkm">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="salary_cut">Potongan </label>
                                        <input type="text" class="form-control mask gajian"
                                            value="{{ $detail->salary_cut }}{{ old('salary_cut') }}" name="salary_cut"
                                            placeholder="salary_cut" id="salary_cut">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="tunj_bpjs_jht">Tunjangan BPJS JHT 3.70%</label>
                                        <input type="text" class="form-control mask gajian"
                                            value="{{ $detail->tunj_bpjs_jht }}{{ old('tunj_bpjs_jht') }}"
                                            name="tunj_bpjs_jht" placeholder="tunj_bpjs_jht" id="tunj_bpjs_jht">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="kehadiran_potongan">Potongan Kehadiran</label>
                                        <input type="text" class="form-control mask gajian"
                                            value="{{ $detail->kehadiran_potongan }}{{ old('kehadiran_potongan') }}"
                                            name="kehadiran_potongan" placeholder="0" id="kehadiran_potongan">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="tunj_jabatan">Tunjangan Jabatan</label>
                                        <input type="text" class="form-control mask gajtunj"
                                            value="{{ $detail->tunj_jabatan }}{{ old('tunj_jabatan') }}"
                                            name="tunj_jabatan" placeholder="tunj_jabatan" id="tunj_jabatan">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="total_potongan">TOTAL POTONGAN</label>
                                        <input type="text" class="form-control mask"
                                            value="{{ $detail->total_potongan }}{{ old('total_potongan') }}"
                                            name="total_potongan" placeholder="total_potongan" id="total_potongan"
                                            readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="bonus">Bonus</label>
                                        <input type="text" class="form-control mask gajian"
                                            value="{{ $detail->bonus }}{{ old('bonus') }}" name="bonus"
                                            placeholder="bonus" id="bonus">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="lembur">Lembur</label>
                                        <input type="text" class="form-control mask gajian"
                                            value="{{ $detail->lembur }}{{ old('lembur') }}" name="lembur"
                                            placeholder="lembur" id="lembur">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="reimburse">Perjalanan Dinas</label>
                                        <input type="text" class="form-control mask gajian"
                                            value="{{ $detail->reimburse }}{{ old('reimburse') }}" name="reimburse"
                                            placeholder="reimburse" id="reimburse">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="insentif_project">Insentif Project</label>
                                        <input type="text" class="form-control mask gajian"
                                            value="{{ $detail->insentif_project }}{{ old('insentif_project') }}"
                                            name="insentif_project" placeholder="insentif_project" id="insentif_project">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="total_gaji">TOTAL PENERIMAAN</label>
                                        <input type="text" class="form-control mask"
                                            value="{{ $detail->total_gaji }}{{ old('total_gaji') }}" name="total_gaji"
                                            placeholder="total_gaji" id="total_gaji" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="transferred">JUMLAH DITERIMA</label>
                                        <input type="text" class="form-control mask"
                                            value="{{ $detail->transferred }}{{ old('transferred') }}"
                                            name="transferred" placeholder="transferred" id="transferred" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="terbilang">TERBILANG</label>
                                        <input type="text" class="form-control mask"
                                            value="{{ $detail->terbilang }}{{ old('terbilang') }}" name="terbilang"
                                            placeholder="terbilang" id="terbilang" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ route('salary.show', $detail->salary_id) }}" class="btn btn-warning"
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
            $('.mask').mask("#.##0", {
                reverse: true
            });
            hitungTerbilang();
            $('#generate-bpjs').click(function() {
                hitungBpjs();
                hitungTot();
                hitungDiterima();
            });

            $('.gajian').keyup(function() {
                hitungTot();
                hitungDiterima();
            });

            $('.gajtunj').keyup(function() {
                hitungTot();
                hitungDiterima();
            });

            function hitungDiterima() {
                var penerimaan = parseInt($('#total_gaji').cleanVal());
                var potongan = parseInt($('#total_potongan').cleanVal());
                var total_diterima = penerimaan - potongan;
                $('#transferred').val(mask(total_diterima));
                hitungTerbilang();
            }

            function hitungTerbilang() {
                var transferred = $('#transferred').cleanVal();
                $('#terbilang').val(terbilang(transferred));
            }

            function hitungBpjs() {
                var gapok = parseInt($('#gapok').cleanVal());
                var tunj_jabatan = parseInt($('#tunj_jabatan').cleanVal());

                var total_gaji = gapok + tunj_jabatan;
                $('#tunj_bpjs_kes').val(mask(0.04 * total_gaji));
                $('#tunj_bpjs_jkk').val(mask(0.0024 * total_gaji));
                $('#tunj_bpjs_jkm').val(mask(0.0030 * total_gaji));
                $('#tunj_bpjs_jht').val(mask(0.037 * total_gaji));
                $('#iuran_bpjs_someah').val(mask(0.04 * total_gaji));
                $('#iuran_bpjs_kes1').val(mask(0.01 * total_gaji));
                $('#iuran_bpjs_jkk').val(mask(0.0424 * total_gaji));
                $('#iuran_bpjs_jht').val(mask(0.02 * total_gaji));
            }

            function hitungTot() {
                var gapok = parseInt($('#gapok').cleanVal());
                var tunj_jabatan = parseInt($('#tunj_jabatan').cleanVal());

                var bonus = parseInt($('#bonus').cleanVal());
                var reimburse = parseInt($('#reimburse').cleanVal());
                var insentif_project = parseInt($('#insentif_project').cleanVal());
                var lembur = parseInt($('#lembur').cleanVal());
                var tunj_bpjs_jkk = parseInt($('#tunj_bpjs_jkk').cleanVal());
                var tunj_bpjs_kes = parseInt($('#tunj_bpjs_kes').cleanVal());
                var tunj_bpjs_jkm = parseInt($('#tunj_bpjs_jkm').cleanVal());
                var tunj_bpjs_jht = parseInt($('#tunj_bpjs_jht').cleanVal());
                var tunj_hari_raya = parseInt($('#tunj_hari_raya').cleanVal());
                var tunj_transport = parseInt($('#tunj_transport').cleanVal());

                var total_penerimaan = gapok + tunj_jabatan + bonus + reimburse + insentif_project + lembur +
                    tunj_bpjs_jkk + tunj_bpjs_kes + tunj_bpjs_jkm + tunj_bpjs_jht + tunj_hari_raya + tunj_transport;
                $('#total_gaji').val(mask(total_penerimaan));

                var pph21 = parseInt($('#pph21').cleanVal());
                var iuran_bpjs_someah = parseInt($('#iuran_bpjs_someah').cleanVal());
                var iuran_bpjs_jkk = parseInt($('#iuran_bpjs_jkk').cleanVal());
                var iuran_bpjs_jht = parseInt($('#iuran_bpjs_jht').cleanVal());
                var iuran_bpjs_kes1 = parseInt($('#iuran_bpjs_kes1').cleanVal());
                var salary_cut = parseInt($('#salary_cut').cleanVal());
                var kehadiran_potongan = parseInt($('#kehadiran_potongan').cleanVal());


                var total_potongan = pph21 + iuran_bpjs_someah + iuran_bpjs_jkk + iuran_bpjs_jht + iuran_bpjs_kes1 +
                    salary_cut + kehadiran_potongan;
                $('#total_potongan').val(mask(total_potongan));
            }
        });
    </script>
@endpush
