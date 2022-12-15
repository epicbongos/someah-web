<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Estimasi;
use DataTables;
use Session;

class EstimasiController extends Controller
{
    public function index()
    {
        $estimasi = Estimasi::all();
        if (session('success_message')) {
            Alert::success('Berhasil', session('success_message'));
        }
        return view('admin.pages.view-estimasi', ['estimasi' => $estimasi]);
    }

    public function json()
    {
        $estimasis = Estimasi::select('estimasis.*');
        return DataTables::eloquent($estimasis)
            ->addColumn('aksi', function ($estimasi) {
                return '<button style="padding: 7px 15px;" class="btn btn-danger" id="btn-hapus" onclick="deleteEstimasi(' . $estimasi->id . ')">Hapus</button>';
            })
            ->addColumn('lingkup', function ($estimasi) {
                return $estimasi->tipelingkup->tipe_lingkup;
            })
            ->addColumn('project', function ($estimasi) {
                $template = '';
                foreach ($estimasi->tipeproject as $cat) {
                    $template .= $cat->tipe_project . ', ';
                }
                return $template;
            })
            ->rawColumns(['aksi', 'lingkup', 'project'])
            ->toJson();
    }

    public function getAllEstimasi(Request $request)
    {
        if (!$request->ajax()) return response('Forbidden', 403);

        $input = $request->all();

        // DataTable Default
        $length = (int)@$input['length'] ?? 10;
        $start = (int)@$input['start'];
        $search = @$input['search'];
        $order = @$input['order'];
        $status = @$input['status'];
        $column = $order[0]['column'];


//        $data = Karakter::with('tipelingkup','tipeproject')->orderBy($column,$order[0]['dir']);
        $data = Estimasi::with('tipelingkup', 'tipeproject')->orderBy('created_at', 'DESC');


        $count = $data->count();
        $table = [];
        $table['recordsFiltered'] = $count;
        $table['recordsTotal'] = $count;

        // Search
        if (!empty($search) and !empty($search['value'])) {
            $data = $data->where(function ($query) use ($search) {
                $query->orWhere('nama', 'like', '%' . $search['value'] . '%');
                $query->orWhere('email', 'like', '%' . $search['value'] . '%');
                $query->orWhereHas('tipelingkup', function ($queryLingkup) use ($search) {
                    $queryLingkup->where('tipe_lingkup', 'like', '%' . $search['value'] . '%');
                });
                $query->orWhereHas('tipeproject', function ($queryLingkup) use ($search) {
                    $queryLingkup->where('tipe_project', 'like', '%' . $search['value'] . '%');
                });

            });

            $table['recordsFiltered'] = $data->count(); // Menghitung jumlah data yang ditemukan berdasarkan search. Di datatables nya nanti muncul Total xx From xx (Filtered from xxxx)
        }

        $data_tmp = $data->skip($start)->take($length);

        // Init
        $i = $start + 1;
        foreach ($data_tmp->get() as $row) {
            $d = [];
            $d[] = $i++;

            $d[] = Carbon::parse($row->created_at)->format('d M Y');
            $d[] = $row->nama;
            $d[] = $row->nama_seluler  . ' - ' . $row->email ;
            $d[] = $row->perusahaan . ' (' . $row->bidang_perusahaan . ')';
            $template = '';
            foreach ($row->tipeproject as $cat) {
                $template .= $cat->tipe_project . ', ';
            }
            $template;

            $d[] = '<b>' . $row->tipelingkup->tipe_lingkup . '</b>' . ' (' . $template . ')';
            $d[] = $row->ide_anda;

//            $btn = '<a href="' . route("estimasi.edit", $row->id) . '" class="btn  btn-warning btn-icon" style="margin-right: 2px"><i data-feather="edit"></i></a>';
            $btn = '<button style="padding: 7px 15px;" class="btn btn-danger" id="btn-hapus" onclick="deleteEstimasi(' . $row->id . ')">Hapus</button>';

            $d[] = sprintf('<span style="overflow: visible; position: relative; width: 110px;">%s</span>', $btn);

            $d["DT_RowId"] = ($i - 1) . '#' . $row['_id'];
            $table['data'][] = $d;
        }

        if (empty($table['data'])) {
            $table['recordsTotal'] = $count;
            $table['recordsFiltered'] = 0;
            $table['aaData'] = [];
        }

        return response()->json($table);
    }

    public function destroy($id)
    {
        Estimasi::where('id', $id)->delete();
        return redirect()->back()->with(Session::flash('success_message', 'Data Berhasil Dihapus'));
    }
}
