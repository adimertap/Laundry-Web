<?php

namespace App\Http\Controllers;

use App\Models\Laundry\TransaksiLaundry;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PilihAplikasiController extends Controller
{
    public function index()
    {
        $total_laundry = TransaksiLaundry::where('tanggal_transaksi', Carbon::now()->format('Y-m-d'))->sum('total');
        $total_money = Transaksi::where('tanggal_transaksi', Carbon::now()->format('Y-m-d'))->sum('total');

        $count_laundry = TransaksiLaundry::where('tanggal_transaksi', Carbon::now()->format('Y-m-d'))->count();
        $count_money = Transaksi::where('tanggal_transaksi', Carbon::now()->format('Y-m-d'))->count();

        return view('pages.aplikasi.index', compact('total_laundry', 'total_money','count_laundry', 'count_money'));
    }
}
