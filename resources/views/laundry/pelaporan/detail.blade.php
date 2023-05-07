@extends('layouts.app')

@section('content')
<main>
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card"
            style="background-image:url(/../../falcon/assets/img/icons/spot-illustrations/corner-4.png);"></div>
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-12">
                    <h5>Seluruh Transaksi Bulan {{ $bulan }}</h5>
                    <p class="mt-2">Pilih Tanggal Awal dan Pilih Tanggal Akhir</p>
                    <hr>
                    <a href="{{ route('export-dokumen-month-laundry', $bulan) }}" class="btn btn-falcon-default btn-sm me-1 mb-2 mb-sm-0" type="button">
                        <span class="fas fa-arrow-down me-1"></span>Download Transaksi Bulan {{ $bulan }}(.excel)
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#tab-home" role="tab"
                        aria-controls="tab-home" aria-selected="true">Berdasarkan Tanggal</a></li>
                <li class="nav-item"><a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#tab-profile" role="tab"
                        aria-controls="tab-profile" aria-selected="false">Seluruh Transaksi Bulan {{ $bulan }}</a></li>
            </ul>
            <div class="tab-content border-x border-bottom p-3" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-home" role="tabpanel" aria-labelledby="home-tab">
                    <div id="tableExample"
                        data-list='{"valueNames":["no","pegawai","tanggal_transaksi","jumlah_transaksi","grand_total"],"page":20,"pagination":true}'>
                        <div class="table-responsive scrollbar">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead class="bg-200 text-900">
                                    <tr>
                                        <th class="sort text-center fs--1" data-sort="no">No.</th>
                                        <th class="sort text-center fs--1" data-sort="tanggal_transaksi">Tanggal Transaksi</th>
                                        <th class="sort text-center fs--1" data-sort="jumlah_transaksi">Jumlah Transaksi</th>
                                        <th class="sort text-center fs--1" data-sort="grand_total">Total</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @forelse ($transaksi as $item)
                                    <tr role="row" class="odd">
                                        <th scope="row" class="no fs--1">{{ $loop->iteration}}.</th>
                                        <td class="text-center tanggal_transaksi fs--1">{{ date('d-M-Y', strtotime($item->tanggal_transaksi)) }}</td>
                                        <td class="text-center jumlah_transaksi fs--1">{{ $item->jumlah_transaksi }}</td>
                                        <td class="text-center grand_total text-center fs--1">Rp. {{ number_format($item->grand_total, 0, ',', '.') }}</td>
                                        <td class="text-center fs--1">
                                            <a href="{{ route('bulanan-laundry.edit', $item->tanggal_transaksi) }}"
                                                class="btn p-0 ms-2" type="button" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Detail"><span class="text-700 fas fa-eye"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
        
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
        
                </div>
                <div class="tab-pane fade" id="tab-profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div id="tableExample"
                        data-list='{"valueNames":["no","pegawai","tanggal_transaksi","total","kode_transaksi"],"page":20,"pagination":true}'>
                        <div class="table-responsive scrollbar">
                            <table id="example2" class="table table-striped" style="width:100%">
                                <thead class="bg-200 text-900">
                                    <tr>
                                        <th class="sort text-center fs--1" data-sort="no">No.</th>
                                        <th class="sort text-center fs--1" data-sort="tanggal_transaksi">Tanggal</th>
                                        <th class="sort text-center fs--1" data-sort="nomor_transaksi">Kode</th>
                                        <th class="sort text-center fs--1" data-sort="nama_customer" style="width: 100px">Customer</th>
                                        <th class="sort text-center fs--1" data-sort="nomor_telephone">Phone</th>
                                        <th class="sort text-center fs--1" data-sort="total_berat">Berat</th>
                                        <th class="sort text-center fs--1" data-sort="total">Total</th>
                                        <th class="sort text-center fs--1" data-sort="status">Status</th>
                                        <th class="text-center" style="width: 80px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="list small">
                                    @forelse ($transaksi_seluruh as $item)
                                    @php
                                    $date = DateTime::createFromFormat('Y-m-d H:i:s', $item->tanggal_ambil);
                                    @endphp
                                    <tr role="row" class="odd">
                                        <th scope="row" class="no fs--1">{{ $loop->iteration}}.</th>
                                        <td class="text-center tanggal_transaksi fs--1">{{ date('d-M-Y',
                                            strtotime($item->tanggal_transaksi)) }}</td>
                                        <td class="text-center nomor_transaksi fs--1">{{ $item->nomor_transaksi }}</td>
                                        <td class="text-center nama_customer fs--1">{{ $item->nama_customer }}</td>
                                        <td class="text-center nomor_telephone fs--1">{{ $item->nomor_telephone }}</td>
                                        <td class="text-center alamat fs--1">{{ $item->total_berat }} kg</td>
                                        <td class="text-center total text-center fs--1">Rp.
                                            {{ number_format($item->total, 0,',', '.') }}</td>
                                        <td class="text-center status text-center fs--1">
                                            @if($item->status == 'diambil')
                                            <span class="badge rounded-pill badge-soft-success">Diambil</span>
                                            @elseif ($item->status == 'selesai')
                                            <span class="badge rounded-pill badge-soft-success">Selesai</span>
                                            @else
                                            <span class="badge rounded-pill badge-soft-primary">Proses</span>
                                            @endif
                                        </td>
                                        <td class="text-center fs--1">
                                            <a href="{{ route('cetak-laundry', $item->id_transaksi) }}" target="_blank" class="btn p-0"
                                                type="button" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Print"><span class="text-700 fas fa-print"></span>
                                            </a>
                                            <a href="{{ route('transaksi-laundry.show', $item->id_transaksi) }}" class="btn p-0"
                                                type="button" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Detail"><span class="text-700 fas fa-eye"></span>
                                            </a>
                                        </td>
                                    </tr>
        
                                    @empty
        
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    $(document).ready(function () {
        var table = $('#example').DataTable();
        var table2 = $('#example2').DataTable();
    })

    </script>


@endsection
