<?php

namespace App\Http\Controllers\Laundry;

use App\Http\Controllers\Controller;
use App\Models\Laundry\MasterCategoryPenerima;
use App\Models\Laundry\MasterType;
use App\Models\Laundry\TransaksiLaundry;
use App\Models\MasterCurrency;
use App\Models\ModalTransaksi;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlah_hari_ini = TransaksiLaundry::where('tanggal_transaksi', Carbon::now()->format('Y-m-d'))->count();
        $total_hari_ini = TransaksiLaundry::where('tanggal_transaksi', Carbon::now()->format('Y-m-d'))->sum('total');
        $type = MasterType::count();
        $jenis = MasterCategoryPenerima::count();
        $pegawai = User::count();
        $month = Carbon::now()->format('m');
        $bulan_ini = Carbon::now()->format('M Y');
        $total_bulan_ini = TransaksiLaundry::whereMonth('tanggal_transaksi', $month)->sum('total');
        $jumlah_bulan_ini = TransaksiLaundry::whereMonth('tanggal_transaksi', $month)->count();
        $transaksi = TransaksiLaundry::with('detail')->where('tanggal_transaksi', Carbon::now()->format('Y-m-d'))->orderBy('created_at','DESC')
        ->take(5)->get();
        $proses = TransaksiLaundry::where('status', 'proses')->count();
        $proses_today = TransaksiLaundry::where('tanggal_transaksi', Carbon::now()->format('Y-m-d'))->where('status', 'proses')->count();
        $selesai = TransaksiLaundry::where('status', 'selesai')->count();
        $selesai_today = TransaksiLaundry::where('tanggal_transaksi', Carbon::now()->format('Y-m-d'))->where('status', 'selesai')->count();

        return view('laundry.dashboard.dashboard', compact(
            'jumlah_hari_ini',
            'total_hari_ini',
            'type',
            'pegawai',
            'jenis',
            'jumlah_bulan_ini',
            'total_bulan_ini',
            'transaksi',
            'bulan_ini',
            'proses',
            'proses_today',
            'selesai',
            'selesai_today'
        ));
    }
}