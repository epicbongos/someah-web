<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['posisi'] = Position::all();
        if (session('success_message')) {
            Alert::success('Berhasil', session('success_message'));
        }
        return view('admin.pages.position.list', $data);
    }
    public function json()
    {
        $posisi = Position::select('positions.*');
        //        $clients = Client::all();

        return DataTables::eloquent($posisi)
            ->addColumn('aksi', function ($posisi) {
                return  '<div style="width: 100% !important; justify-content: center !important; display: flex; align-items: center;">' .
                    '<a href="' . route("position.edit", $posisi->id) . '" style="padding: 7px; width:40%;" class="mr-2 float-left btn btn-success text-light">Edit</a>' .
                    '<button style="padding: 7px; width: 40%;" class="btn btn-danger float-left" id="btn-hapus" onclick="deleteData(' . $posisi->id . ')">Hapus</button>' .
                    '</div>';
            })
            ->addColumn('gapok', function ($posisi) {
                return 'Rp. ' . number_format($posisi->gapok, 0);
            })
            ->addColumn('tunj_jabatan', function ($posisi) {
                return 'Rp. ' . number_format($posisi->tunj_jabatan, 0);
            })
            ->addColumn('tunj_transportasi', function ($posisi) {
                return 'Rp. ' . number_format($posisi->tunj_transportasi, 0);
            })
            ->rawColumns(['status_posisi', 'gapok', 'tunj_jabatan', 'aksi', 'tunj_transportasi'])
            ->toJson();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.position.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_jabatan' => 'required',
            'status_posisi' => 'required',
            'gapok' => 'required',
            'tunj_jabatan' => 'required',
            'tunj_transportasi' => 'required'
        ]);
        $input = $request->all();

        $gapok = explode('.', $request->gapok);
        $input['gapok'] = implode('', $gapok);

        $tunj_jabatan = explode('.', $request->tunj_jabatan);
        $input['tunj_jabatan'] = implode('', $tunj_jabatan);

        $tunj_transportasi = explode('.', $request->tunj_transportasi);
        $input['tunj_transportasi'] = implode('', $tunj_transportasi);

        $status = Position::create($input);
        if ($status) {
            return redirect('/admin/position')->with(Session::flash('success_message', 'Data Berhasil Diubah'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['posisi'] = Position::find($id);
        return view('admin.pages.position.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_jabatan' => 'required',
            'status_posisi' => 'required',
            'gapok' => 'required',
            'tunj_jabatan' => 'required',
            'tunj_transportasi' => 'required'
        ]);

        $posisi = Position::find($id);
        $posisi->nama_jabatan = $request->nama_jabatan;

        $gapok = explode('.', $request->gapok);
        $gapok = implode('', $gapok);

        $tunj_jabatan = explode('.', $request->tunj_jabatan);
        $tunj_jabatan = implode('', $tunj_jabatan);

        $tunj_transportasi = explode('.', $request->tunj_transportasi);
        $tunj_transportasi = implode('', $tunj_transportasi);

        $posisi->gapok = $gapok;
        $posisi->status_posisi = $request->status_posisi;
        $posisi->tunj_jabatan = $tunj_jabatan;
        $posisi->tunj_transportasi = $tunj_transportasi;
        $status = $posisi->save();
        if ($status) {

            return redirect('/admin/position')->with(Session::flash('success_message', 'Data Berhasil Diubah'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posisi = Position::find($id);
        $status = $posisi->delete();
        if ($status) {

            return redirect('/admin/position')->with(Session::flash('success_message', 'Data Berhasil Dihapus'));
        }
    }
}