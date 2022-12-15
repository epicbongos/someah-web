<html>

<body style="background-color:#e2e1e0;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;">
<table style="max-width:800px;margin:50px auto 10px;background-color:#fff;padding:20px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 8px #008A85; border-bottom: solid 17px #008A85;">
    <thead>
    <tr>
        <th style="text-align:left;" colspan="2"><img style="max-width: 100px;" src="{{asset('uploaded/logo.png')}}" alt="PT. Someah Kreatif Nusantara" ></th>
    </tr>
    <tr>
        <th style="text-align:right;font-size: 14px;font-weight: 300;" colspan="2">{{Carbon\Carbon::createFromFormat('Y-m-d',$salary_detail->salary->tanggal)->format('d M Y')}}

        </th>
    </tr>
    <tr>
{{--        <th style="text-align:left;font-weight:400;">Bidang Operasional</th>--}}
    </tr>
    </thead>
    <tbody>
    <tr>
        <td style="height:15px;"></td>
    </tr>
    <tr>
        <td colspan="2" style="border: solid 1px #ddd; padding:10px 20px;">
            <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:150px;color:#21383E">{{$salary_detail->salary->keterangan}}</span></p>
            <br>
            <p style="font-size:12px;margin:0 0 0 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Nama Pegawai</span>: {{$salary_detail->employee->nama}}</p>
            <p style="font-size:12px;margin:0 0 0 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">NIP</span>: {{$salary_detail->employee->nip}}</p>
            <p style="font-size:12px;margin:0 0 0 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Nama Bank</span>: {{$salary_detail->employee->bank}}</p>
            <p style="font-size:12px;margin:0 0 0 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">No. Rekening</span>: {{$salary_detail->employee->no_rekening}}</p>
        </td>
    </tr>
    <tr>
        <td style="height:10px;"></td>
    </tr>

    <tr>
        <td style="padding:10px;vertical-align:top;">
            <p style="margin:0 0 10px 0;padding:0;font-size:16px;"><span style="display:block;font-weight:bold;font-size:16px;color: #21383E">Rincian Penerimaan</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Gaji Pokok</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Tunjangan Jabatan</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Bonus</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Insentif Project</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Reimburse</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Lembur</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Tunjangan BPJS Kesehatan</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Tunjangan BPJS JKK 0.24%</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Tunjangan BPJS JKM 0.30%</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Tunjangan BPJS JHT 3.70%</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Tunjangan Hari Raya</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Tunjangan Transport</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;"><strong>Total Penerimaan</strong></span></p>

            <p style="margin-top:70px;padding:0;font-size:16px;"><span style="display:block;font-weight:bold;font-size:16px;color: #21383E">Rincian Potongan</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Pajak PPH Pasal 21</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Iuran BPJS Kesehatan	Someah</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Iuran BPJS Kesehatan - 1%</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Iuran BPJS JKK,JKM,JHT - 4.24%</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Iuran BPJS JHT - 2%</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Potongan Kehadiran</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Potongan Lainnya</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;"><strong>Total Potongan</strong></span></p>

        </td>
        <td style="padding:10px;vertical-align:top;text-align:right;">
            <p style="margin:0 0 10px 0;padding:0;font-size:16px;"><span style="display:block;font-weight:bold;font-size:16px;color: white">Rincian Penerimaan</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Rp. {{number_format($salary_detail->gapok,0) }}</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Rp. {{number_format($salary_detail->tunj_jabatan,0) }}</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Rp. {{number_format($salary_detail->bonus,0) }}</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Rp. {{number_format($salary_detail->insentif_project,0) }}</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Rp. {{number_format($salary_detail->reimburse,0) }}</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Rp. {{number_format($salary_detail->lembur,0) }}</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Rp. {{number_format($salary_detail->tunj_bpjs_kes,0) }}</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Rp. {{number_format($salary_detail->tunj_bpjs_jkk,0) }}</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Rp. {{number_format($salary_detail->tunj_bpjs_jkm,0) }}</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Rp. {{number_format($salary_detail->tunj_bpjs_jht,0) }}</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Rp. {{number_format($salary_detail->tunj_hari_raya,0) }}</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Rp. {{number_format($salary_detail->tunj_transport,0) }}</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Rp. {{number_format($salary_detail->total_gaji,0) }}</span></p>
            <p style="margin-top:70px;padding:0;font-size:16px;"><span style="display:block;font-weight:bold;font-size:16px;color: white">Rincian Potongan</span></p>

            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Rp. {{number_format($salary_detail->pph21,0) }}</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Rp. {{number_format($salary_detail->iuran_bpjs_someah,0) }}</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Rp. {{number_format($salary_detail->iuran_bpjs_kes1,0) }}</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Rp. {{number_format($salary_detail->iuran_bpjs_jkk,0) }}</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Rp. {{number_format($salary_detail->iuran_bpjs_jht,0) }}</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Rp. {{number_format($salary_detail->kehadiran_potongan,0) }}</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Rp. {{number_format($salary_detail->salary_cut,0) }}</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Rp. {{number_format($salary_detail->total_potongan,0) }}</span></p>
        </td>
    </tr>
    <tr>
        <td style="padding:10px;vertical-align:top;margin-top:10px">
            <p style="margin:0 0 10px 0;padding:0;font-size:16px;"><span style="display:block;font-weight:bold;font-size:16px;color: #21383E">Jumlah Diterima</span></p>
        </td>
        <td style="padding:10px;vertical-align:top;text-align:right;">
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">Rp. {{number_format($salary_detail->transferred,0) }}</span></p>
            <p style="margin:0 0 10px 0;padding:0;font-size:12px;"><span style="display:block;font-size:12px;">{{ $salary_detail->terbilang  }}</span></p>
        </td>
    </tr>
    </tbody>
    <tfooter style="background-color: #0d8010">
        <tr>

            <td colspan="2" style="font-size:14px;padding:10px 15px 0 15px;">
                <hr>
                <strong style="display:block;margin-top:30px;">Regards,</strong> PT. Someah Kreatif Nusantara<br> Bidang Operasional<br><br>
            </td>
        </tr>
    </tfooter>
</table>
</body>

</html>
