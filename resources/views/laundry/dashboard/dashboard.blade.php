@extends('layouts.app')

@section('content')
<main>
    <div class="row g-3 mb-3">
        <div class="col-xxl-8">
            <div class="col-12 mb-3">
                <div class="card bg-transparent-50 overflow-hidden">
                    <div class="card-header position-relative">
                        <div class="bg-holder d-none d-md-block bg-card z-index-1"
                            style="background-image:url(../falcon/assets/img/illustrations/ecommerce-bg.png);background-size:230px;background-position:right bottom;z-index:-1;">
                        </div>
                        <div class="position-relative z-index-2">
                            <div>
                                <h3 class="text-primary mb-1">Welcome Back, {{ Auth::user()->name }}!</h3>
                                <p>Dashboard Aplikasi Laundry</p>
                            </div>
                            <div class="d-flex py-3">
                                <div class="pe-3">
                                    <p class="text-600 fs--1 fw-medium">Jumlah Transaksi Hari Ini</p>
                                    <h4 class="text-800 mb-0">{{ $jumlah_hari_ini }} Transaksi</h4>
                                </div>
                                <div class="ps-3">
                                    <p class="text-600 fs--1">Total Transaksi Hari Ini</p>
                                    <h4 class="text-800 mb-0">Rp. {{ number_format($total_hari_ini, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 border-lg-end border-bottom border-lg-0 pb-3 pb-lg-0">
                            <div class="d-flex flex-between-center mb-3">
                                <div class="d-flex align-items-center">
                                    <div
                                        class="icon-item icon-item-sm bg-soft-primary shadow-none me-2 bg-soft-primary">
                                        <span class="fs--2 fas fa-dollar-sign text-primary"></span>
                                    </div>
                                    <h6 class="mb-0">Data Type dan Harga</h6>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="d-flex">
                                    <p class="font-sans-serif lh-1 mb-1 fs-2 pe-2">{{ $type }} Type dan Harga</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 border-lg-end border-bottom border-lg-0 py-3 py-lg-0">
                            <div class="d-flex flex-between-center mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="icon-item icon-item-sm bg-soft-primary shadow-none me-2 bg-soft-info">
                                        <span class="fs--2 fas fa-wallet text-info"></span>
                                    </div>
                                    <h6 class="mb-0">Data Jenis Penerima</h6>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="d-flex">
                                    <p class="font-sans-serif lh-1 mb-1 fs-2 pe-2">{{ $jenis }} Jenis</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 border-lg-end border-bottom border-lg-0 py-3 py-lg-0">
                            <div class="d-flex flex-between-center mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="icon-item icon-item-sm bg-soft-primary shadow-none me-2 bg-soft-info">
                                        <span class="fs--2 fas fa-user text-info"></span>
                                    </div>
                                    <h6 class="mb-0">Pegawai Anda</h6>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="d-flex">
                                    <p class="font-sans-serif lh-1 mb-1 fs-2 pe-2">{{ $pegawai }} Pegawai</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body py-3">
                    <div class="row g-0">
                        <div
                            class="col-6 col-md-6 border-200 border-md-200 border-bottom border-md-bottom-0 border-md-end pt-4 pb-md-0 ps-3 ps-md-0">
                            <h6 class="pb-1 text-700">Transaksi Bulan Ini</h6>
                            <p class="font-sans-serif lh-1 mb-1 fs-2">{{ $jumlah_bulan_ini, 0, ',', '.' }}</p>
                            <div class="d-flex align-items-center">
                                <h6 class="fs--1 text-500 mb-0">Transaksi</h6>
                                </h6>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 border-200 border-md-bottom-0 border-end pt-4 pb-md-0 ps-md-3">
                            <h6 class="pb-1 text-700">Total Transaksi Bulan Ini </h6>
                            <p class="font-sans-serif lh-1 mb-1 fs-2">Rp. {{ number_format($total_bulan_ini, 0, ',',
                                '.') }}</p>
                            <div class="d-flex align-items-center">
                                <h6 class="fs--1 text-500 mb-0">Bulan {{ $bulan_ini }}</h6>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-6 col-xxl-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row flex-between-center">
                            <div class="col d-md-flex d-lg-block flex-between-center">
                                <h6 class="mb-md-0 mb-lg-2">Laundry Masih Di Proses</h6><span
                                    class="badge rounded-pill badge-soft-success">
                                  <span class="fas fa-caret-up"></span>
                                    {{ $proses_today }} Hari Ini</span>
                            </div>
                            <div class="col-auto">
                                <h4 class="fs-2 fw-normal text-700"
                                    data-countup="{&quot;endValue&quot;:82.18,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;M&quot;,&quot;prefix&quot;:&quot;$&quot;}">
                                    {{ $proses }} Transaksi</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xxl-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row flex-between-center">
                            <div class="col d-md-flex d-lg-block flex-between-center">
                                <h6 class="mb-md-0 mb-lg-2">Laundry Belum Diambil</h6><span
                                    class="badge rounded-pill badge-soft-success"><span class="fas fa-caret-up"></span>
                                    {{ $selesai_today }} Hari Ini</span>
                            </div>
                            <div class="col-auto">
                                <h4 class="fs-2 fw-normal text-700"
                                    data-countup="{&quot;endValue&quot;:82.18,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;M&quot;,&quot;prefix&quot;:&quot;$&quot;}">
                                    {{ $selesai }} Transaksi</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Last Activity Today</h6>
                </div>
                <div class="card-body scrollbar recent-activity-body-height ps-2">
                    @forelse ($transaksi as $item)
                    <div class="row g-3 timeline timeline-primary timeline-past pb-card">
                        <div class="col-auto ps-4 ms-2">
                            <div class="ps-2">
                                <div class="icon-item icon-item-sm rounded-circle bg-200 shadow-none">
                                    <span class="text-primary fas fa-money-bill"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row gx-0 border-bottom pb-card">
                                <div class="col">

                                    <h6 class="text-800 mb-1">New Order:#{{ $item->nomor_transaksi }}</h6>
                                    <p class="fs--1 text-600 mb-0"> <b>Customer: </b> {{ $item->nama_customer }}</p>
                                    @forelse ($item->detail as $tes)
                                    <p class="fs--1 text-600 mb-0">Type {{ $tes->type->nama_type }}, Berat
                                        {{ $tes->berat }} Kg, Total <b>Rp. {{
                                        number_format($tes->total, 0, ',', '.') }}</b></p>
                                    @empty

                                    @endforelse

                                </div>
                                <div class="col-auto text-end">
                                    <p class="fs--2 text-500 mb-0">Pukul {{ date('H:i:s', strtotime($item->created_at))
                                        }}</p>
                                    <p class="fs--2 text-500 mb-0">Pegawai {{ $item->Pegawai->nama_panggilan }}</p>
                                    <p class="fs--1 text-primary mb-0">Berat {{ $item->total_berat }} Kg</p>
                                    <p class="fs--1 text-primary mb-0">Total Rp. {{ number_format($item->total, 0, ',',
                                        '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty



                    @endforelse

                </div>
            </div>
        </div>
    </div>
</main>
{{-- 
<div class="modal fade" style="margin-top: 130px" id="modalMenu" data-bs-keyboard="false" data-bs-backdrop="static"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centerd" role="document">
        <div class="modal-content border-0">
            <div class="modal-body p-0">
                <div class="bg-light rounded-top-lg py-3 ps-4 pe-6">
                    <h4 class="mb-1" id="staticBackdropLabel">Aplikasi PT Riastavalasindo</h4>
                    <p class="fs--2 mb-0">Pilih Aplikasi yang ingin dituju</a></p>
                </div>
                <div class="p-4">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="d-flex"><span class="fa-stack ms-n1 me-3"><i
                                        class="fas fa-circle fa-stack-2x text-200"></i><i
                                        class="fa-inverse fa-stack-1x text-primary fas fa-align-left"
                                        data-fa-transform="shrink-2"></i></span>
                                <div class="flex-1">
                                    <h5 class="mb-2 fs-0">Pilih Aplikasi</h5>
                                    <p class="text-word-break fs--1">Terdapat 2 Aplikasi Klik Button untuk menuju
                                        aplikasi yang ingin dituju</p>
                                </div>
                            </div>
                            <hr>
                            <div class="rounded-1 p-2">
                                <div class="d-flex justify-content-center mb-3">
                                    <button id="aplikasi-money" class="btn btn-primary btn-lg me-1 mb-1"
                                        style="height: 100px; width: 300px; margin-right:50px" type="button">
                                        <span class="far fa-bookmark me-1" data-fa-transform="shrink-3"></span>Money
                                        Changer
                                    </button>
                                    <button id="aplikasi-laundry" class="btn btn-primary btn-lg me-1 mb-1"
                                        style="height: 100px; width: 300px; margin-left: 50px" type="button">
                                        <span class="far fa-bookmark me-1" data-fa-transform="shrink-3"></span>Laundry
                                    </button>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection