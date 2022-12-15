<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Position;
use App\Salary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pegawai'] = Employee::all();
        if (session('success_message')) {
            Alert::success('Berhasil', session('success_message'));
        }
        return view('admin.pages.employee.list', $data);
    }
    public function json()
    {
        $pegawai = Employee::select('employees.*');
        //        $clients = Client::all();

        return DataTables::eloquent($pegawai)
            ->addColumn('aksi', function ($pegawai) {
                return  '<div style="width: 100% !important; justify-content: center !important; display: flex; align-items: center;">' .
                    '<a href="' . route("employee.edit", $pegawai->id) . '" style="padding: 7px; width:40%;" class="mr-2 float-left btn btn-success text-light"><i class="fas fa-eye"></i></a>' .
                    '<button style="padding: 7px; width: 40%;" class="btn btn-danger float-left" id="btn-hapus" onclick="deleteData(' . $pegawai->id . ')"><i class="fas fa-trash-alt"></i></button>' .
                    '</div>';
            })
            ->addColumn('ttl', function ($pegawai) {
                return $pegawai->tempat . ', ' . date('d M Y', strtotime($pegawai->tgl_lahir));;
            })
            ->addColumn('photo', function ($pegawai) {
                return '<img width="70px !important;" src="' . asset("uploaded/employee/$pegawai->photo") . '" alt="">';
            })
            ->addColumn('rekening', function ($pegawai) {
                return '(' . $pegawai->bank . ') ' . $pegawai->no_rekening;
            })
            ->addColumn('posisi', function ($pegawai) {
                return $pegawai->position->nama_jabatan . " | " . $pegawai->position->status_posisi;
            })

            ->addColumn('status_pegawai', function ($pegawai) {
                $myStatus = $pegawai->status_pegawai;

                if ($myStatus == 'aktif') {
                    $status_checkbox = 'checked';
                } else {
                    $status_checkbox = '';
                }

                return
                    '<div class="custom-control custom-switch">' .
                    '<input style="z-index:1; width:30px; position:relative;" type="checkbox" class="custom-control-input toggle"
                    name="status_pegawai" data-id="' . $pegawai->id . '"  id="status_pegawai" ' . $status_checkbox . ' value="' . $pegawai->status_pegawai . '" >' .

                    '<label style="z-index:-1; width:5px; position:relative;" class="custom-control-label" for="status_pegawai"></label>' .
                    '</div>';
            })

            ->rawColumns(['posisi', 'ttl', 'photo', 'aksi', 'status_pegawai'])
            ->toJson();
    }

    public function updateStatus(Request $request)
    {
        $pegawai = Employee::find($request->id);

        $pegawai->status_pegawai = $request->status_pegawai;
        $pegawai->save();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['posisi'] = Position::all();
        return view('admin.pages.employee.form', $data);
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
            'nip' => 'required|unique:employees',
            'nama' => 'required',
            'email' => 'required',
            'npwp' => 'required',
            'ktp' => 'required',
            'position_id' => 'required',
            'tempat' => 'required',
            'tgl_lahir' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg',
            'status_pegawai' => 'required',
            'bank' => 'required',
            'no_rekening' => 'required',
            'no_telepon' => 'required',
            'nama_ibu' => 'required',
        ]);

        $input = $request->all();
        $input['tgl_lahir'] = Carbon::createFromFormat('d/m/Y', $request->tgl_lahir);
        $namaFoto = Str::random(16);

        if ($request->hasFile('photo')) {
            $input['photo'] = $this->uploadImage($request, $namaFoto);
        }

        $status = Employee::create($input);

        if ($status) {
            return redirect('/admin/employee')->with(Session::flash('success_message', 'Data Berhasil Ditambah'));
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
        $data['pegawai'] = Employee::find($id);
        $data['posisi'] = Position::all();
        return view('admin.pages.employee.form', $data);
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
            'nip' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'npwp' => 'required',
            'ktp' => 'required',
            'position_id' => 'required',
            'tempat' => 'required',
            'tgl_lahir' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg',
            'bank' => 'required',
            'status_pegawai' => 'required',
            'no_rekening' => 'required',
            'no_telepon' => 'required',
            'nama_ibu' => 'required',
        ]);


        $pegawai = Employee::find($id);

        $pegawai->nip = $request->nip;
        $pegawai->nama = $request->nama;
        $pegawai->ktp = $request->ktp;
        $pegawai->npwp = $request->npwp;
        $pegawai->email = $request->email;
        $pegawai->position_id = $request->position_id;
        $pegawai->tempat = $request->tempat;
        $pegawai->alamat = $request->alamat;
        $pegawai->tgl_lahir = Carbon::createFromFormat('d/m/Y', $request->tgl_lahir);
        $pegawai->bank = $request->bank;
        $pegawai->no_rekening = $request->no_rekening;
        $pegawai->no_telepon = $request->no_telepon;
        $pegawai->status_pegawai = $request->status_pegawai;
        $pegawai->nama_ibu = $request->nama_ibu;
        $namaFoto = Str::random(16);
        if ($request->hasFile('photo')) {
            File::delete('uploaded/employee/' . $pegawai->photo);
            $pegawai->photo = $this->uploadImage($request, $namaFoto);
        }
        $status = $pegawai->save();
        if ($status) {
            return redirect('/admin/employee')->with(Session::flash('success_message', 'Data Berhasil Diubah'));
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
        $pegawai = Employee::find($id);
        $status = $pegawai->delete();
        if ($status) {
            File::delete('uploaded/employee/' . $pegawai->photo);
            return 1;
        } else {
            return 0;
        }
    }

    private function uploadImage(Request $request, $name)
    {
        $image = $request->file('photo');
        $ext = $image->getClientOriginalExtension();

        if ($request->file('photo')->isValid()) {
            $upload_path = 'uploaded/employee';
            $imagename = $name . '.' . $ext;
            $request->file('photo')->move($upload_path, $imagename);
            return $imagename;
        }
        return false;
    }
}