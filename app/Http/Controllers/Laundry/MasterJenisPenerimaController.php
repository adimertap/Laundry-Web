<?php

namespace App\Http\Controllers\Laundry;

use App\Http\Controllers\Controller;
use App\Models\Laundry\MasterCategoryPenerima;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Calculation\Category;
use RealRashid\SweetAlert\Facades\Alert;

class MasterJenisPenerimaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $count = MasterCategoryPenerima::count();
            $jenis = MasterCategoryPenerima::get();
            return view('laundry.mst_penerima.index', compact('jenis', 'count'));
        } catch (\Throwable $th) {
            return view('error.500', compact('th'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'nama_kategori_penerima' => 'required|string|max:200',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with('show_modal', true);
            }
            $check = MasterCategoryPenerima::where('nama_kategori_penerima', $request->nama_kategori_penerima)->first();
            if (!$check) {
                $jenis = new MasterCategoryPenerima();
                $jenis->nama_kategori_penerima = $request->nama_kategori_penerima;
                $jenis->save();

                Alert::success('Berhasil', 'Data Jenis Customer Berhasil Ditambahkan');
                return redirect()->back();
            } else {
                Alert::warning('Gagal', 'Data Master Customer Sudah Ada');
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            dd($th);
            Alert::warning('Error', 'Internal Server Error, Try Refreshing The Page');
            return redirect()->back();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateJenis(Request $request)
    {
        try {
            if ($request->editNama == "") {
                Alert::warning('Gagal', 'Nama Kategori Penerima Tidak Boleh Kosong');
                return redirect()->back();
            } else {

                $jenis = MasterCategoryPenerima::find($request->id_category_penerima);
                $jenis->nama_kategori_penerima = $request->editNama;
                $jenis->update();
                Alert::success('Berhasil', 'Data Jenis Customer Berhasil Diupdate');
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            Alert::warning('Error', 'Internal Server Error, Try Refreshing The Page');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteJenis(Request $request)
    {
        try {
            $jenis = MasterCategoryPenerima::find($request->category_penerima_id);
            if ($jenis) {
                $jenis->delete();
                Alert::success('Berhasil', 'Data Jenis Customer Berhasil Terhapus');
                return redirect()->back();
            } else {
                Alert::warning('Berhasil', 'Data Tidak Ditemukan');
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            Alert::warning('Error', 'Internal Server Error, Try Refreshing The Page');
            return redirect()->back();
        }
    }
}
