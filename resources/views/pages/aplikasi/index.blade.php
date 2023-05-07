@extends('layouts.appwithoutmenu')

@section('content')
<main class="p-4 mt-3">
    <div class="row g-3 mb-3">
        <div class="col-12">
            <div class="row g-3">
                <div class="col-12">
                    <div class="card bg-transparent-50 overflow-hidden">
                        <div class="card-header position-relative">
                            <div class="bg-holder d-none d-md-block bg-card z-index-1"
                                style="background-image:url(../falcon/assets/img/illustrations/ecommerce-bg.png);background-size:230px;background-position:right bottom;z-index:-1;">
                            </div>
                            <div class="position-relative z-index-2">
                                <div>
                                    <h3 class="text-primary mb-1">Welcome Back, {{ Auth::user()->name }}</h3>
                                    <p>Dashboard Aplikasi PT Riastavalasindo</p>
                                </div>
                                <div class="d-flex py-3">
                                    <div class="pe-3">
                                        <p class="text-600 fs--1 fw-medium">Today's Money Changer Sales </p>
                                        @if(Auth::user()->role == 'Pegawai')
                                        <h4 class="text-800 mb-0">Not Shown</h4>
                                        @else
                                        <h4 class="text-800 mb-0">Rp. {{ number_format($total_money, 0, ',','.') }}</h4>
                                        @endif

                                    </div>
                                    <div class="ps-3">
                                        <p class="text-600 fs--1">Today’s Laundry Sales </p>
                                        @if(Auth::user()->role == 'Pegawai')
                                        <h4 class="text-800 mb-0">Not Shown</h4>
                                        @else
                                        <h4 class="text-800 mb-0">Rp. {{ number_format($total_laundry, 0, ',','.') }}</h4>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            @if(Auth::user()->role == 'Owner')
                            <ul class="mb-0 list-unstyled">
                                <li class="alert mb-0 rounded-0 py-3 px-card alert-warning border-x-0 border-top-0">
                                    <div class="row flex-between-center">
                                        <div class="col">
                                            <div class="d-flex">
                                                <div class="fas fa-circle mt-1 fs--2"></div>
                                                <p class="fs--1 ps-2 mb-0">
                                                    @if($count_money == 0)
                                                    <strong>Belum Terdapat Order, </strong> 
                                                    Pada Aplikasi Money Changer
                                                    @else
                                                    <strong>{{ $count_money }} Order, </strong> 
                                                    New Transaction Money Changer From Customer

                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-auto d-flex align-items-center"><a
                                                class="alert-link fs--1 fw-medium" href="{{ route('transaksi.index') }}">View Transaction
                                                <i class="fas fa-chevron-right ms-1 fs--2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li
                                    class="alert mb-0 rounded-0 py-3 px-card greetings-item border-top border-x-0 border-top-0">
                                    <div class="row flex-between-center">
                                        <div class="col">
                                            <div class="d-flex">
                                                <div class="fas fa-circle mt-1 fs--2 text-primary"></div>
                                                <p class="fs--1 ps-2 mb-0">
                                                    @if ($count_laundry == 0)
                                                    <strong>Belum Terdapat Order</strong> 
                                                    Pada Aplikasi Laundry and Dry
                                                    @else
                                                    <strong>{{ $count_laundry }} Order</strong> 
                                                    New Transaction Laundry From Customer
                                                    @endif
                                                  
                                                
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-auto d-flex align-items-center"><a
                                                class="alert-link fs--1 fw-medium" href="{{ route('transaksi-laundry.index') }}">View Transaction
                                                <i class="fas fa-chevron-right ms-1 fs--2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card bg-light my-3">
        <div class="card-body p-3">
            <p class="fs--1 mb-0"><a href="#!">
                    <span class="far fa-bookmark me-2"></span>
                    <strong>Pilih Aplikasi</strong> diantara 2 yakni aplikasi laundry dan money changer, klik untuk
                    menuju dashboard
            </p>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="fs--1" style="width: 800px; margin-right:20px">
            @if(Auth::user()->role == 'Pegawai')
            <a class="notification" href="{{ route('transaksi.create') }}">
                @else
                <a class="notification" href="{{ route('dashboard') }}">
                    @endif

                    <div class="notification-avatar">

                    </div>
                    <div class="notification-body p-3">
                        <h5 class="mb-1"><strong>Money Changer Application</strong></h5>
                        <span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">💵</span>Go to
                            Dashboard Money Changer</span>
                    </div>
                </a>
        </div>
        <div class="fs--1" style="width: 1000px; margin-left:20px">
            @if(Auth::user()->role == 'Pegawai')
            <a class="notification" href="{{ route('dashboard-laundry') }}">
                @else
                <a class="notification" href="{{ route('dashboard-laundry') }}">
                    @endif

                    <div class="notification-avatar">

                    </div>
                    <div class="notification-body p-3">
                        <h5 class="mb-1"><strong>Laundry Application</strong></h5>
                        <span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">🧺</span>New
                            Application, Go to Dashboard Laundry Application</span>
                    </div>
                </a>
        </div>
    </div>
</main>

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
</div>

@endsection