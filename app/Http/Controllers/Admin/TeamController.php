<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;
use Carbon\Carbon;
use App\Team;
use Session;
use Image;
use File;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function json()
    {
        $teams = Team::select('teams.*');

        return DataTables::eloquent($teams)
            ->addColumn('aksi', function ($team) {
                return  '<div style="width: 100% !important; justify-content: center; display: flex;">' .
                    '<a href="' . url("/admin/team/update-team/$team->slug") . '" style="padding: 7px; width: 25%;" class="mr-2 float-left btn btn-success text-light">Edit</a>' .
                    '<button style="padding: 7px; width: 25%;" class="btn btn-danger float-left" id="btn-hapus" onclick="deleteData(' . $team->id . ')">Hapus</button>' .
                    '</div>';
            })
            ->addColumn('gambar', function ($team) {
                return '<img width="70px !important;" src="' . asset("uploaded/team/$team->photo") . '" alt="">';
            })
            ->rawColumns(['aksi', 'gambar'])
            ->toJson();
    }

    public function index()
    {
        $teams = Team::all();
        if (Session::has('success_message')) {
            Alert::success('Berhasil', session('success_message'));
            Session::forget('success_message');
        }
        return view('admin.pages.teams.view-team', ['teams' => $teams]);
    }

    public function showInsert()
    {
        return view('admin.pages.teams.view-insert-team');
    }

    public function showUpdate($slug)
    {
        $person = Team::where('slug', $slug)->first();
        return view('admin.pages.teams.view-update-team', ['person' => $person]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'photo' => 'required',
            'photo.*' => 'image|mimes:jp,gif,svg',
            'name.*' => 'required',
            'role.*' => 'required',
        ]);

        $photo = $request->file('photo');
        $name = $request->name;
        $role = $request->role;

        for ($count = 0; $count < count($photo); $count++) {
            $path = "uploaded/team";
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
            $namaPhoto[$count] = 'photo' . Carbon::now()->format('Ymd') . ' at ' . Carbon::now()->format('His') . Str::random(20) . '.' . $photo[$count]->getClientOriginalExtension();
            Image::make(File::get($photo[$count]))->resize(1000, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save('uploaded/team/' . $namaPhoto[$count]);

            $data = array(
                'photo' => $namaPhoto[$count],
                'name' => $name[$count],
                'position' => $role[$count],
                'slug' => Str::slug($name[$count], '-'),
            );

            $insert_data[] = $data;
        }

        Team::insert($insert_data);

        return redirect('/admin/team')->with(Session::flash('success_message', 'Data Berhasil Ditambahkan'));
    }

    public function update(Request $request, $slug)
    {
        $anggota = Team::where('slug', $slug)->first();
        $anggota->name = $request->ubahname;
        $anggota->position = $request->ubahrole;
        $anggota->slug =  Str::slug($request->ubahname, '-');
        if ($request->hasfile('ubahphoto')) {
            $imagePhoto = public_path("uploaded/team/" . $anggota->photo);
            \File::delete($imagePhoto);
            $photo = $request->file('ubahphoto');
            $namaPhoto = 'photo' . Carbon::now()->format('Ymd') . ' at ' . Carbon::now()->format('His') .  Str::random(20) . '.' . $photo->getClientOriginalExtension();
            Image::make(File::get($photo))->resize(1000, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save('uploaded/team/' . $namaPhoto);
            $anggota->photo = $namaPhoto;
        }
        $anggota->update();
        return redirect('/admin/team')->with(Session::flash('success_message', 'Data Berhasil Diperbaharui'));
    }

    public function destroy($id)
    {
        $anggota = Team::where('id', $id)->first();
        $anggota->delete();
        return redirect()->back()->with(Session::flash('success_message', 'Data Berhasil Dihapus'));
    }
}