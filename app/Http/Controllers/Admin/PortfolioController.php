<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use RealRashid\SweetAlert\Facades\Alert;
use App\Portfolio;
use App\TipeProject;
use App\Client;
use DataTables;
use Carbon\Carbon;
use Session;
use Image;
use File;

class PortfolioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function json()
    {
        $portfolios = Portfolio::select('portfolios.*');

        return DataTables::eloquent($portfolios)
            ->addColumn('aksi', function ($portfolio) {
                return  '<div style="width: 100% !important; justify-content: center !important; display: flex">' .
                    '<a href="' . url("/admin/portfolio/update-portfolio/$portfolio->slug") . '" style="padding: 7px 11px;" class="mr-2 float-left btn btn-success text-light"><i class="fas fa-edit"></i></a>' .
                    '<button style="padding: 7px 13px;" class="btn btn-danger" id="btn-hapus" onclick="deleteData(' . $portfolio->id . ')"><i class="fas fa-trash-alt"></i></button>' .
                    '</div>';
            })
            ->addColumn('gambar', function ($portfolio) {
                $template = '';
                $template .= '<div>';
                foreach ($portfolio->product_img as $_img) {
                    $template .= '<div class="mb-1">' .
                        '<img width="70px !important;" src="' . asset("uploaded/portfolio/$_img") . '" alt="">' .
                        '</div>';
                }
                $template .= '</div>';
                return $template;
            })
            ->addColumn('deskripsi', function ($portfolio) {
                $template = '';
                $template .= substr($portfolio->desc, 0, 95);
                if (strlen($portfolio->desc) >= 95) {
                    $template .= '. . . .';
                }

                return $template;
            })
            ->addColumn('client', function ($portfolio) {
                return $portfolio->client->company_name;
            })
            ->addColumn('type', function ($portfolio) {
                $template = '';
                foreach ($portfolio->tipeprojects as $cat) {
                    $template .= $cat->tipe_project . ', ';
                }
                return $template;
            })->addColumn('status', function ($portfolio) {
                if ($portfolio->status == 1) {
                    $show = 'checked';
                } else {
                    $show = '';
                }
                return  '<label class="switch mt-2">' .
                    '<input type="checkbox" id="change_status_portfolio" name="status"' . $show . ' value="1" data-id="' . $portfolio->id . '">' .
                    '<span class="slider round"></span>' .
                    '</label>';
            })
            ->rawColumns(['aksi', 'type', 'status', 'client'])
            ->toJson();
    }

    public function index()
    {
        $portfolios = Portfolio::all();
        if (Session::has('success_message')) {
            Alert::success('Berhasil', session('success_message'));
            Session::forget('success_message');
        } else if (Session::has('error')) {
            Alert::error('Error', session('error'));
            Session::forget('error');
        }
        return view('admin.pages.portos.view-portfolio', compact(['portfolios']));
    }

    public function showInsert()
    {
        $clients = Client::all();
        $tipeprojects = TipeProject::all();
        return view('admin.pages.portos.view-insert-portfolio', compact(['clients', 'tipeprojects']))->with('status', 'insert');
    }

    public function showUpdate($slug)
    {
        $clients = Client::all();
        $tipeprojects = TipeProject::all();
        $portfolio = Portfolio::where('slug', $slug)->first();
        foreach ($portfolio->tipeprojects as $tp) {
            $categories[] = $tp->id;
        }
        $id = $portfolio->id;
        return view('admin.pages.portos.view-insert-portfolio', compact(['clients', 'tipeprojects', 'portfolio', 'id', 'categories']))->with('status', 'update');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'n_portfolio' => 'required',
            'gambarproduk.*' => 'required',
            'deskripsi' => 'required',
            'year' => 'required',
            'id_client' => 'required',
            'categories' => 'required',
        ]);

        dd($request->all());

        $id = $request->id_client;
        $client = Client::findOrfail($id);

        $path = "uploaded/portfolio";
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        $produk = $request->file('gambarproduk');

        $jsonGambarProduk = [];
        foreach ($produk as $_produk) {
            dd($_produk);
            $namaProduk = 'produk' . Carbon::now()->format('Ymd') . '_' . Carbon::now()->format('His') . Str::random(20) . '.' . $_produk->getClientOriginalExtension();
            $image = Image::make(File::get($_produk));
            $image->resize(730, 410, function ($constraint) {
                $constraint->aspectRatio();
            })->save('uploaded/portfolio/' . $namaProduk);

            $jsonGambarProduk[] = $namaProduk;
        }

        $client->portfolios()->create([
            'portofolio_name' => $request->n_portfolio,
            'slug' => Str::slug($request->n_portfolio, '-'),
            'product_img' => json_encode($jsonGambarProduk),
            'desc' => $request->deskripsi,
            'year' => $request->year,
            'keterangan' => $request->keterangan,
        ])->tipeprojects()->attach(TipeProject::find($request->categories));
        return redirect('/admin/portfolio')->with(Session::flash('success_message', 'Data Berhasil Ditambahkan'));
    }

    public function update(Request $request, $slug)
    {
        //        dd($request->all());

        $portfolio = Portfolio::where('slug', $slug)->first();
        $portfolio->portofolio_name = $request->n_portfolio;
        $portfolio->slug = Str::slug($request->n_portfolio, '-');
        $portfolio->desc = $request->deskripsi;
        $portfolio->year = $request->year;
        $portfolio->client_id = $request->id_client;
        $portfolio->keterangan = $request->keterangan;
        $jsonGambarProduk = [];

        if ($request->hasfile('gambarproduk')) {
            $photo = $request->file('gambarproduk');
            $photoLama = $portfolio->product_img;
            foreach ($photo as $img) {
                $namaPhoto = 'photo' . Carbon::now()->format('Ymd') . ' at ' . Carbon::now()->format('His') .  Str::random(20) . '.' . $img->getClientOriginalExtension();
                $image = Image::make(File::get($img));
                $image->resize(730, 410, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('uploaded/portfolio/' . $namaPhoto);

                $photoLama[] = $namaPhoto;
            }
            $portfolio->product_img = json_encode($photoLama);
        }

        $portfolio->update();

        $tipeproject = TipeProject::find($request->categories);
        $portfolio->tipeprojects()->sync($tipeproject);

        return redirect('/admin/portfolio')->with(Session::flash('success_message', 'Data Berhasil Diperbaharui'));
    }

    public function destroy($id)
    {
        $portfolio = Portfolio::find($id);
        foreach ($portfolio->product_img as $img) {
            $imagePhoto = public_path("uploaded/portfolio/" . $img);
            \File::delete($imagePhoto);
        }
        $portfolio->delete();
        $portfolio->tipeprojects()->detach();
        return redirect()->back()->with(Session::flash('success_message', 'Data Berhasil Dihapus'));
    }

    public function delete_gambar($id, $index)
    {
        $portofolio = Portfolio::find($id);
        $arr = $portofolio->product_img;
        $namaGambar = $portofolio->product_img[$index];
        unset($arr[$index]);
        $arr = collect($arr)->values()->all();
        $portofolio->product_img = $arr;
        $portofolio->save();
        $imagePhoto = public_path("uploaded/portfolio/" . $namaGambar);
        \File::delete($imagePhoto);
    }
}