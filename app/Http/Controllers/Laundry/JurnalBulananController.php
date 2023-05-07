<?php

namespace App\Http\Controllers\Laundry;

use App\Http\Controllers\Controller;
use App\Models\Laundry\MasterCategoryPenerima;
use App\Models\Laundry\TransaksiLaundry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class JurnalBulananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $transaksi = TransaksiLaundry::selectRaw('SUM(total) as grand_total, tanggal_transaksi, DATE_FORMAT(tanggal_transaksi, "%m") as month, YEAR(tanggal_transaksi) as year, COUNT(id_transaksi) as jumlah_transaksi')
            ->groupBy('month','year')
            ->orderBy('month','ASC')
            ->get();
    
            return view('laundry.pelaporan.bulan', compact('transaksi'));
        } catch (\Throwable $th) {
            Alert::warning('Error', 'Internal Server Error, Try Refreshing The Page');
            return redirect()->back();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $month)
    {
        try {
            $transaksi = TransaksiLaundry::whereMonth('tanggal_transaksi', '=', $month)
            ->selectRaw('DATE_FORMAT(tanggal_transaksi, "%M") as month, SUM(total) as grand_total,tanggal_transaksi, COUNT(id_transaksi) as jumlah_transaksi')
            ->groupBy('tanggal_transaksi')
            ->orderBy('tanggal_transaksi', 'DESC')
            ->get();
    
            $bulan = $month;

            $transaksi_seluruh = TransaksiLaundry::with('Pegawai')->whereMonth('tanggal_transaksi', '=', $month);
            if($request->from){
                $transaksi_seluruh->where('tanggal_transaksi', '>=', $request->from);
            }
            if($request->to){
                $transaksi_seluruh->where('tanggal_transaksi', '<=', $request->to);
            }
            $transaksi_seluruh = $transaksi_seluruh->orderBy('tanggal_transaksi','DESC')->get();
    
            return view('laundry.pelaporan.detail', compact('transaksi','bulan','transaksi_seluruh'));
        } catch (\Throwable $th) {
            Alert::warning('Error', 'Internal Server Error, Try Refreshing The Page');
            return redirect()->back();
        }
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$tanggal_transaksi)
    {
        try {
            $tr = TransaksiLaundry::where('tanggal_transaksi', $tanggal_transaksi)->orderBy('created_at', 'DESC')->get();
            $proses = TransaksiLaundry::where('status', 'proses')->where('tanggal_transaksi', $tanggal_transaksi)->count();
            $selesai = TransaksiLaundry::where('status', 'selesai')->where('tanggal_transaksi', $tanggal_transaksi)->count();
            $diambil = TransaksiLaundry::where('status', 'diambil')->where('tanggal_transaksi', $tanggal_transaksi)->count();
            $total_transaksi = TransaksiLaundry::where('tanggal_transaksi', $tanggal_transaksi)->sum('total');
            $today =  Carbon::now()->format('d M Y');
            $jenis = MasterCategoryPenerima::get();
            $tanggal = Carbon::parse($tanggal_transaksi)->format('d M Y');
            $month = Carbon::parse($tanggal_transaksi)->format('m');
            $tgl = $tanggal_transaksi;

            return view('laundry.pelaporan.tanggal', compact('tgl','month','tanggal','tr', 'proses', 'selesai','diambil','total_transaksi','today','jenis'));
        } catch (\Throwable $th) {
            dd($th);
            Alert::warning('Error', 'Internal Server Error, Try Refreshing The Page');
            return redirect()->back();
        } 
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
