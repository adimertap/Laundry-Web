<?php

namespace App\Http\Controllers;

use Knp\Snappy\Pdf;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransaksiHarianExport;
use App\Models\Laundry\TransaksiLaundry;

class CetakController extends Controller
{
    public function cetak($id)
    {
        $transaksi = Transaksi::with('detailTransaksi','Pegawai')->find($id);
        return view('print.cetak', compact('transaksi'));
    }

    public function exportexcel($today)
    {
       return Excel::download(new TransaksiHarianExport($today), 'RekapTransaksi.xlsx');
    }

    public function exportexcellaundry($today)
    {
       return Excel::download(new TransaksiHarianExport($today), 'RekapTransaksi.xlsx');

    }

    public function cetak_laundry($id)
    {
        $tr = TransaksiLaundry::with('Jenis','Detail')->find($id);
        return view('print.cetak_laundry', compact('tr'));
    }
}
