<?php

namespace App\Http\Controllers\Laundry;

use App\Exports\ExcelHarianLaundry;
use App\Exports\ExcelHarianOwner;
use App\Exports\ExcelLaundry;
use App\Http\Controllers\Controller;
use App\Models\Laundry\DetailTransaksiLaundry;
use App\Models\Laundry\MasterCategoryPenerima;
use App\Models\Laundry\MasterType;
use App\Models\Laundry\TransaksiLaundry;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $tr = TransaksiLaundry::where('tanggal_transaksi', Carbon::now()->format('Y-m-d'))->orderBy('created_at', 'DESC')->get();
            $proses = TransaksiLaundry::where('status', 'proses')->where('tanggal_transaksi', Carbon::now()->format('Y-m-d'))->count();
            $selesai = TransaksiLaundry::where('status', 'selesai')->where('tanggal_transaksi', Carbon::now()->format('Y-m-d'))->count();
            $diambil = TransaksiLaundry::where('status', 'diambil')->where('tanggal_transaksi', Carbon::now()->format('Y-m-d'))->count();
            $total_transaksi = TransaksiLaundry::where('tanggal_transaksi', Carbon::now()->format('Y-m-d'))->sum('total');
            $today =  Carbon::now()->format('d M Y');
            $jenis = MasterCategoryPenerima::get();

            return view('laundry.transaksi.index', compact('tr', 'proses', 'selesai','diambil','total_transaksi','today','jenis'));
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
        $jenis = MasterCategoryPenerima::get();
        $type = MasterType::get();
        $today =  Carbon::now()->format('d M Y');
        $sekarang = Carbon::now()->format('Y-m-d');

        $id = TransaksiLaundry::getId();
        foreach($id as $value);
        $idlama = $value->id_transaksi;
        $idbaru = $idlama + 1;

        return view('laundry.transaksi.create', compact('jenis','type','today','sekarang','idbaru'));
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
            $id = TransaksiLaundry::getId();
            foreach($id as $value);
            $idlama = $value->id_transaksi;
            $idbaru = $idlama + 1;
            $blt = date('ymd');
            $id = Auth::user()->id;
            $nomor = 'L'.$blt.'-'.$idbaru;

            $tr = new TransaksiLaundry();
            $tr->tanggal_transaksi = $request->tanggal_transaksi;
            $tr->id_category_penerima = $request->id_category;
            $tr->nama_customer = $request->nama_customer;
            $tr->alamat = $request->alamat;
            $tr->nomor_telephone =$request->phone;
            $tr->total_berat = $request->total_berat;
            $tr->total = $request->total;
            $tr->id_pegawai = Auth::user()->id;
            $tr->nomor_transaksi = $nomor;
            $tr->status = 'proses';
            $tr->status_paid = $request->status_paid;
            $tr->save();
            $tr->detail()->insert($request->detail);
            
            Alert::success('Berhasil', 'Data Transaksi Berhasil Ditambahkan');
            return $request;

        } catch (\Throwable $th) {
            Alert::warning('Error', 'Internal Server Error, Try Refreshing The Page');
            return redirect()->back();
        }
    }

    public function selesai(Request $request, $id)
    {
        try {
            $tr = TransaksiLaundry::where('id_transaksi', $id)->first();
            if($tr){
                $tr->status = "selesai";
                $tr->update();
            }else{
                Alert::warning('Error', 'Data Tidak Ditemukan');
                return redirect()->back();
            }
            Alert::success('Berhasil', 'Laundry Telah Selesai, Menunggu Diambil');
            return redirect()->back();

        } catch (\Throwable $th) {
            Alert::warning('Error', 'Internal Server Error, Try Refreshing The Page');
            return redirect()->back();
        }
    }

    public function diambil(Request $request, $id)
    {
        try {
            $tr = TransaksiLaundry::where('id_transaksi', $id)->first();
            if($tr){
                $tr->status = "diambil";
                $tr->status_paid = 'paid';
                $tr->tanggal_ambil = Carbon::now()->format('Y-m-d H:m:s');
                $tr->update();
            }else{
                Alert::warning('Error', 'Data Tidak Ditemukan');
                return redirect()->back();
            }
            Alert::success('Berhasil', 'Laundry Telah Diambil');
            return redirect()->back();

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
        $tr = TransaksiLaundry::with('Pegawai','Jenis', 'Detail', 'Detail.Type')->find($id);
        return view('laundry.transaksi.detail', compact('tr'));
    }

    public function getCustomer()
    {
        try {
            $cust = TransaksiLaundry::selectRaw('nama_customer as nama, nomor_telephone as phone, alamat as alamat, SUM(total_berat) as berat, SUM(total) as total')
                    ->groupBy('nama_customer')->orderBy('created_at')->get();
            $count_cust =  TransaksiLaundry::groupBy('nama_customer')->count();
            return view('laundry.pelaporan.customer', compact('cust','count_cust'));
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
    public function edit($id)
    {
        $tr = TransaksiLaundry::find($id);
        $temp_tgl = $tr->tanggal_transaksi;
        $tgl = Carbon::parse($temp_tgl)->format('Y-m-d');
        $jenis = MasterCategoryPenerima::get();
        $type = MasterType::get();
        $today =  Carbon::now()->format('d M Y');
        $sekarang = Carbon::now()->format('Y-m-d');
        $id_transaksi = $id;

        return view('laundry.transaksi.edit', compact('tr','jenis','type','today','sekarang','tgl','id_transaksi'));
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
        try {
            $tr = TransaksiLaundry::where('id_transaksi', $request->id_transaksi)->first();
            $tr->tanggal_transaksi = $request->tanggal_transaksi;
            $tr->id_category_penerima = $request->id_category;
            $tr->nama_customer = $request->nama_customer;
            $tr->alamat = $request->alamat;
            $tr->nomor_telephone =$request->phone;
            $tr->total_berat = $request->total_berat;
            $tr->total = $request->total;
            $tr->status_paid = $request->status_paid;
            $tr->detail()->delete();
            $tr->detail()->insert($request->detail);
            $tr->update();

            
            Alert::success('Berhasil', 'Data Transaksi Berhasil Di Update');
            return $request;

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
    public function destroy(Request $request, $id)
    {
        try {
            $tr = TransaksiLaundry::find($id);
            $tr->delete();

            $det = DetailTransaksiLaundry::where('id_transaksi', $id)->first();
            if($det){
                $det->delete();
            }

            Alert::success('Berhasil', 'Data Transaksi Berhasil Terhapus');
            return redirect()->back();

        } catch (\Throwable $th) {
            Alert::warning('Error', 'Internal Server Error, Try Refreshing The Page');
            return redirect()->back();
        }
    }

    public function getAll(Request $request)
    {
        try {
            $tr = TransaksiLaundry::with([
                'Pegawai','Jenis'
            ]);        
            if($request->from){
                $tr->where('tanggal_transaksi', '>=', $request->from);
            }
            if($request->to){
                $tr->where('tanggal_transaksi', '<=', $request->to);
            }
            $tr = $tr->orderBy('created_at','DESC')->get();
            
            $jumlah = TransaksiLaundry::count();
            $total = TransaksiLaundry::sum('total');
            $pegawai = User::where('role','!=','Owner')->get();
            $jenis = MasterCategoryPenerima::get();

            $proses = TransaksiLaundry::where('status', 'proses')->count();
            $selesai = TransaksiLaundry::where('status', 'selesai')->count();
            $diambil = TransaksiLaundry::where('status', 'diambil')->count();
    
            return view('laundry.transaksi.all', compact('pegawai','tr','jumlah','total','jenis','proses','selesai','diambil'));
        } catch (\Throwable $th) {
            Alert::warning('Error', 'Internal Server Error, Try Refreshing The Page');
            return redirect()->back();
        }
    }

    public function getPegawai(Request $request)
    {
        try {
            $tr = TransaksiLaundry::with([
                'Pegawai','Jenis'
            ])->where('id_pegawai', Auth::user()->id)->where('tanggal_transaksi', Carbon::now()->format('Y-m-d'));        
            if($request->from){
                $tr->where('tanggal_transaksi', '>=', $request->from);
            }
            if($request->to){
                $tr->where('tanggal_transaksi', '<=', $request->to);
            }
            $tr = $tr->orderBy('created_at','DESC')->get();
            
            $jumlah = TransaksiLaundry::count();
            $total = TransaksiLaundry::sum('total');
            $pegawai = User::where('role','!=','Owner')->get();
            $jenis = MasterCategoryPenerima::get();
    
            return view('laundry.transaksi.all', compact('pegawai','tr','jumlah','total','jenis'));
        } catch (\Throwable $th) {
            Alert::warning('Error', 'Internal Server Error, Try Refreshing The Page');
            return redirect()->back();
        }
    }


    public function export_dokumen_tanggal(Request $request, $tanggal_transaksi)
    {
        try {
            $transaksi = TransaksiLaundry::with('Pegawai')->join('l_trn_detail_laundry','l_trn_laundry.id_transaksi','l_trn_detail_laundry.id_transaksi')
            ->join('l_mst_type_laundry', 'l_trn_detail_laundry.id_type', 'l_mst_type_laundry.id_type')
            ->join('l_mst_category_penerima', 'l_trn_laundry.id_category_penerima', 'l_mst_category_penerima.id_category_penerima')
            ->where('tanggal_transaksi', $tanggal_transaksi)->OrderBy('l_trn_laundry.updated_at');
            if($request->id_category_penerima){
                $transaksi->where('l_trn_laundry.id_category_penerima', $request->id_category_penerima);
            }
            if($request->status){
                $transaksi->where('l_trn_laundry.status', $request->status);
            }
            $transaksi = $transaksi->get();
            $total = $transaksi->sum('total');
            $jumlah = $transaksi->count();
            $today = Carbon::now()->format('d-M-Y');
            
            if(count($transaksi) == 0){
                Alert::warning('Tidak Ditemukan Data', 'Data yang Anda Cari Tidak Ditemukan');
                return redirect()->back();
            }else{
                if($request->radio_input == 'pdf'){
                    $pdf = Pdf::loadview('export.laundry.pdf-harian',['transaksi'=>$transaksi, 'total' =>$total,'jumlah' => $jumlah, 'today' => $tanggal_transaksi]);
                    if($request->status){
                        return $pdf->download('report-harian-laundry '.$today.' Status '.$request->status.' .pdf');
                    }
                    
                    return $pdf->download('report-laundry '.$tanggal_transaksi.' .pdf');
                    Alert::success('Berhasil', 'Data Transaksi Berhasil Didownload');
                }else{
                    return new ExcelHarianLaundry($transaksi);
                }
            }
        } catch (\Throwable $th) {
            Alert::warning('Error', 'Internal Server Error, Try Refreshing The Page');
            return redirect()->back();
        }        
    }


    public function export_dokumen(Request $request)
    {
        try {
            $transaksi = TransaksiLaundry::with('Pegawai')->join('l_trn_detail_laundry','l_trn_laundry.id_transaksi','l_trn_detail_laundry.id_transaksi')
            ->join('l_mst_type_laundry', 'l_trn_detail_laundry.id_type', 'l_mst_type_laundry.id_type')
            ->join('l_mst_category_penerima', 'l_trn_laundry.id_category_penerima', 'l_mst_category_penerima.id_category_penerima')
            ->where('tanggal_transaksi', Carbon::now()->format('Y-m-d'))->OrderBy('l_trn_laundry.updated_at');
            if($request->id_category_penerima){
                $transaksi->where('l_trn_laundry.id_category_penerima', $request->id_category_penerima);
            }
            if($request->status){
                $transaksi->where('l_trn_laundry.status', $request->status);
            }
            $transaksi = $transaksi->get();
            $total = $transaksi->sum('total');
            $jumlah = $transaksi->count();
            $today = Carbon::now()->format('d-M-Y');
            
            if(count($transaksi) == 0){
                Alert::warning('Tidak Ditemukan Data', 'Data yang Anda Cari Tidak Ditemukan');
                return redirect()->back();
            }else{
                if($request->radio_input == 'pdf'){
                    $pdf = Pdf::loadview('export.laundry.pdf-harian',['transaksi'=>$transaksi, 'total' =>$total,'jumlah' => $jumlah, 'today' => $today]);
                    if($request->status){
                        return $pdf->download('report-harian-laundry '.$today.' Status '.$request->status.' .pdf');
                    }
                    
                    return $pdf->download('report-harian-laundry '.$today.' .pdf');
                    Alert::success('Berhasil', 'Data Transaksi Berhasil Didownload');
                }else{
                    return new ExcelHarianLaundry($transaksi);
                }
            }
        } catch (\Throwable $th) {
            Alert::warning('Error', 'Internal Server Error, Try Refreshing The Page');
            return redirect()->back();
        }        
    }

    public function export_dokumen_all(Request $request)
    {
        try {
            $transaksi = TransaksiLaundry::with('Pegawai')->join('l_trn_detail_laundry','l_trn_laundry.id_transaksi','l_trn_detail_laundry.id_transaksi')
            ->join('l_mst_type_laundry', 'l_trn_detail_laundry.id_type', 'l_mst_type_laundry.id_type')
            ->join('l_mst_category_penerima', 'l_trn_laundry.id_category_penerima', 'l_mst_category_penerima.id_category_penerima')
            ->OrderBy('l_trn_laundry.updated_at');
            if($request->from_date_export){
                $transaksi->where('tanggal_transaksi', '>=', $request->from_date_export);
            }
            if($request->to_date_export){
                $transaksi->where('tanggal_transaksi', '<=', $request->to_date_export);
            }
            if($request->id_category_penerima){
                $transaksi->where('l_trn_laundry.id_category_penerima', $request->id_category_penerima);
            }
            if($request->id_pegawai){
                $transaksi->where('id_pegawai', $request->id_pegawai);
            }
            if($request->status){
                $transaksi->where('l_trn_laundry.status', $request->status);
            }

            $transaksi = $transaksi->get();
            $total = $transaksi->sum('total');
            $jumlah = $transaksi->count();

            if(count($transaksi) == 0){
                Alert::warning('Tidak Ditemukan Data', 'Data yang Anda Cari Tidak Ditemukan');
                return redirect()->back();
            }else{
                if($request->radio_input == 'pdf'){
                    $pdf = Pdf::loadview('export.laundry.pdf-laundry',['transaksi'=>$transaksi, 'total' =>$total,'jumlah' => $jumlah]);
                    if($request->from_date_export && $request->to_date_export && $request->id_pegawai){
                        return $pdf->download('laporan-laundry '.$request->from_date_export.' Sampai '.$request->to_date_export.' '.$transaksi[0]->Pegawai->name. ' .pdf');
                    }
                    if($request->from_date_export && $request->to_date_export && $request->id_pegawai && $request->id_currency){
                        return $pdf->download('laporan-laundry '.$request->from_date_export.' Sampai '.$request->to_date_export.' '.$transaksi[0]->Pegawai->name.' '.$transaksi[0]->nama_currency. ' .pdf');
                    }
                    if($request->id_pegawai){
                        return $pdf->download('laporan-laundry '.$transaksi[0]->Pegawai->name.' .pdf');
                    }
                    if($request->from_date_export && $request->to_date_export){
                        return $pdf->download('laporan-laundry '.$request->from_date_export.' Sampai '.$request->to_date_export.' .pdf');
                    }

                    return $pdf->download('laporan-laundry-keseluruhan.pdf');
                    Alert::success('Berhasil', 'Data Transaksi Berhasil Didownload');
                }else{
                    return new ExcelLaundry($transaksi);
                }
            }
        } catch (\Throwable $th) {
            Alert::warning('Error', 'Internal Server Error, Try Refreshing The Page');
            return redirect()->back();
        }        
    }

    public function export_month(Request $request, $month)
    {
        try {
            $transaksi = TransaksiLaundry::with('Pegawai')->join('l_trn_detail_laundry','l_trn_laundry.id_transaksi','l_trn_detail_laundry.id_transaksi')
            ->join('l_mst_type_laundry', 'l_trn_detail_laundry.id_type', 'l_mst_type_laundry.id_type')
            ->join('l_mst_category_penerima', 'l_trn_laundry.id_category_penerima', 'l_mst_category_penerima.id_category_penerima')
            ->OrderBy('l_trn_laundry.updated_at')
            ->whereMonth('tanggal_transaksi', '=', $month)
            ->get();
            // $total = $transaksi->sum('total');
            // $jumlah = $transaksi->count();
            if(count($transaksi) == 0){
                Alert::warning('Tidak Ditemukan Data', 'Data yang Anda Cari Tidak Ditemukan');
                return redirect()->back();
            }else{
                return new ExcelLaundry($transaksi);
            }
        } catch (\Throwable $th) {
            Alert::warning('Error', 'Internal Server Error, Try Refreshing The Page');
            return redirect()->back();
        }
    }
   
}