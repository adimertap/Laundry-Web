<?php

namespace App\Http\Controllers\Laundry;

use App\Http\Controllers\Controller;
use App\Models\Laundry\MasterType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;


class MasterTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $count = MasterType::where('status', 'A')->count();
            $type = MasterType::where('status', 'A')->get();
            return view('laundry.mst_type.index', compact('type', 'count'));
        } catch (\Throwable $th) {
            return view('error.500');
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
                'nama_type' => 'required|string|max:200',
                'price' => 'required|numeric|min:0',
                'keterangan' => 'nullable|string|max:255',
            ]);
        
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with('show_modal', true);
            }
            $check = MasterType::where('nama_type', $request->nama_type)->first();
            if(!$check){
                $type = new MasterType();
                $type->nama_type = $request->nama_type;
                $type->price = $request->price;
                $type->keterangan = $request->keterangan;
                $type->status = 'A';
                $type->save();
        
                Alert::success('Berhasil', 'Data Master Type dan Harga Berhasil Ditambahkan');
                return redirect()->back();
            }else{
                Alert::warning('Gagal', 'Data Master Type dan Harga Sudah Ada');
                return redirect()->back();
            }
        } catch (\Throwable $th) {
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
    
    public function updateType(Request $request)
    {
        try {
            $type = MasterType::findfindOrFail($request->id_type);
            $type->nama_type = $request->editNama;
            $type->price = $request->editPrice;
            $type->keterangan = $request->editKeterangan;
            $type->update();
    
            Alert::success('Berhasil', 'Data Master Type dan Harga Berhasil Diedit');
            return redirect()->back();
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
    public function deleteType(Request $request)
    {
        try {
            $type = MasterType::findOrFail($request->type_id);
            $type->delete();
    
            Alert::success('Berhasil', 'Data Master Type dan Harga Berhasil Terhapus');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::warning('Error', 'Internal Server Error, Try Refreshing The Page');
            return redirect()->back();
        }
       
    }
}
