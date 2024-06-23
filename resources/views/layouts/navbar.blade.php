<nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
    <div class="d-flex align-items-center">

        <div class="toggle-icon-wrapper">

        </div>
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <div class="d-flex align-items-center py-3">
                <span class="font-sans-serif fs-1">PT. Riastavalasindo</span>
            </div>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">
            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                @if(Auth::user()->role != 'Owner')
                <a class="nav-link mt-4" href="{{ route('dashboard') }}" role="button" data-bs-toggle=""
                aria-expanded="false">
                <div class="d-flex align-items-center">
                    <span class="nav-link-icon">
                        <i class="fas fa-home"></i>
                        <i class="fas fa-home"></i>
                    </span>
                    <span class="nav-link-text ps-1">Dashboard</span>
                </div>
                </a>
                @endif

                @if (Auth::user()->role == 'Owner')
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Dashboard</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    <a class="nav-link dropdown-indicator collapsed" href="#dashboard" role="button"
                        data-bs-toggle="collapse" aria-expanded="true" aria-controls="dashboard" id="dashboard-link">
                        <div class="d-flex align-items-center"><span class="nav-link-icon">
                                <span class="fas fa-home"></span></span><span
                                class="nav-link-text ps-1">Dashboard</span></div>
                    </a>
                    @php
                    $dashboardRoutes = ['dashboard', 'dashboard-laundry'];
                    @endphp
                    <ul class="nav collapse {{ (in_array(request()->route()->getName(), $dashboardRoutes)) ? 'show' : '' }}"
                        id="dashboard" style="">
                        <li class="nav-item mt-1">
                            <a class="nav-link" href="{{ route('dashboard') }}" data-bs-toggle="" aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">
                                        Money Changer</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item mt-1">
                            <a class="nav-link" href="{{ route('dashboard-laundry') }}" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Laundry</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item mt-1">
                            <a class="nav-link" href="{{ url('https://ratepos.ptriastavalasindo.com/') }}"
                                data-bs-toggle="" aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Web
                                        Exchange</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Master Data</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    <a class="nav-link" href="{{ route('master-pegawai.index') }}" role="button" data-bs-toggle=""
                        aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <i class="fas fa-user-friends"></i>
                            </span>
                            <span class="nav-link-text ps-1">Pegawai</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{ route('master-currency') }}" role="button" data-bs-toggle=""
                        aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <i class="fas fa-dollar-sign"></i>
                            </span>
                            <span class="nav-link-text ps-1">Currency</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link dropdown-indicator" href="#master" role="button" data-bs-toggle="collapse"
                        aria-expanded="false" aria-controls="master">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-chart-pie"></span>
                            </span>
                            <span class="nav-link-text ps-1">Master Laundry</span>
                        </div>
                    </a>
                    @php
                    $master_temp = ['laundry-type.index', 'laundry-jenis.index'];
                    @endphp
                    <ul class="nav collapse {{ (in_array(request()->route()->getName(), $master_temp)) ? 'show' : '' }}"
                        id="master" style="">
                        <li class="nav-item mt-1">
                            <a class="nav-link" href="{{ route('laundry-type.index') }}" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Harga dan
                                        Type</span></div>
                            </a>
                        </li>
                        <li class="nav-item mt-1">
                            <a class="nav-link" href="{{ route('laundry-jenis.index') }}" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Jenis
                                        Penerima</span></div>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Jadwal</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    @if (Auth::user()->role == 'Owner')
                    <a class="nav-link" href="{{ route('shift.index') }}" role="button" data-bs-toggle=""
                        aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <i class="fas fa-business-time"></i>
                            </span>
                            <span class="nav-link-text ps-1">Shift</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{ route('jadwal.index') }}" role="button" data-bs-toggle=""
                        aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <i class="fas fa-calendar-alt"></i>
                            </span>
                            <span class="nav-link-text ps-1">Jadwal</span>
                        </div>
                    </a>
                    @endif
                    <a class="nav-link" href="{{ route('jadwal-user.index') }}" role="button" data-bs-toggle=""
                        aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <i class="fas fa-calendar-check"></i>
                            </span>
                            <span class="nav-link-text ps-1">Jadwal & Absen</span>
                        </div>
                    </a>
                    

                </li>
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Transaction</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                <li class="nav-item">
                    <a class="nav-link dropdown-indicator collapsed" href="#transaksimoney" role="button"
                        data-bs-toggle="collapse" aria-expanded="false" aria-controls="dashboard">
                        <div class="d-flex align-items-center"><span class="nav-link-icon">
                                <i class="far fa-credit-card"></i>
                            </span><span class="nav-link-text ps-1">Money Changer</span></div>
                    </a>
                    @php
                    $money_temp = ['modal.index', 'transaksi.create','transaksi-jual.create'];
                    @endphp
                    <ul class="nav collapse {{ (in_array(request()->route()->getName(), $money_temp)) ? 'show' : '' }}"
                        id="transaksimoney" style="">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('modal.index') }}" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Modal</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item mt-1">
                            <a class="nav-link" href="{{ route('transaksi.create') }}" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Transaksi</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item mt-1">
                            <a class="nav-link" href="{{ route('transaksi-jual.create') }}" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Transaksi Jual</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link dropdown-indicator collapsed" href="#transaksilaundry" role="button"
                        data-bs-toggle="collapse" aria-expanded="false" aria-controls="dashboard">
                        <div class="d-flex align-items-center"><span class="nav-link-icon">
                                <i class="fas fa-cash-register"></i>
                            </span><span class="nav-link-text ps-1">Laundry</span></div>
                    </a>
                    @php
                    $laundry_temp = ['transaksi-laundry.create'];
                    @endphp
                    <ul class="nav collapse {{ (in_array(request()->route()->getName(), $laundry_temp)) ? 'show' : '' }}"
                        id="transaksilaundry" style="">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('transaksi-laundry.create') }}" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-text ps-1">Transaksi</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Pelaporan</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    <a class="nav-link dropdown-indicator collapsed" href="#laporanmoney" role="button"
                        data-bs-toggle="collapse" aria-expanded="true" aria-controls="laporanmoney">
                        <div class="d-flex align-items-center"><span class="nav-link-icon">
                                <i class="fas fa-book"></i>
                            </span>
                            <span class="nav-link-text ps-1">Laporan
                                Money C.
                            </span>
                        </div>
                    </a>
                    @php
                    $laporan_money = ['transaksi.index', 'jurnal-harian.index', 'jurnal-debit-kredit.index',
                    'jurnal-bulanan.index' ];
                    @endphp
                    <ul class="nav collapse {{ (in_array(request()->route()->getName(), $laporan_money)) ? 'show' : '' }}"
                        id="laporanmoney" style="">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('transaksi.index') }}" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">
                                        Rekapan Hari ini</span>
                                </div>
                            </a>
                        </li>
                        @if(Auth::user()->role == 'Owner')
                        <li class="nav-item mt-1">
                            <a class="nav-link" href="{{ route('jurnal-harian.index') }}" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">
                                        Seluruh Transaksi</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item mt-1">
                            <a class="nav-link" href="{{ route('jurnal-debit-kredit.index') }}" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">
                                        Jurnal Debit Kredit</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item mt-1">
                            <a class="nav-link" href="{{ route('jurnal-bulanan.index') }}" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">
                                        Jurnal Bulanan</span>
                                </div>
                            </a>
                        </li>
                        @endif
                    </ul>

                    <a class="nav-link dropdown-indicator collapsed" href="#laporanLaundry" role="button"
                        data-bs-toggle="collapse" aria-expanded="true" aria-controls="laporanLaundry">
                        <div class="d-flex align-items-center"><span class="nav-link-icon">
                                <i class="far fa-list-alt"></i></span><span class="nav-link-text ps-1">Laporan
                                Laundry</span></div>
                    </a>
                    @php
                    $laporan_laundry = ['transaksi-laundry.index', 'transaksi-laundry-all',
                    'transaksi-laundry-customer', 'bulanan-laundry.index' ];
                    @endphp
                    <ul class="nav collapse {{ (in_array(request()->route()->getName(), $laporan_laundry)) ? 'show' : '' }}"
                        id="laporanLaundry" style="">
                        <li class="nav-item mt-1">
                            <a class="nav-link" href="{{ route('transaksi-laundry.index') }}" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">
                                        Rekapan Hari ini</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item mt-1">
                            <a class="nav-link" href="{{ route('transaksi-laundry-all') }}" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">
                                        Seluruh Transaksi</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item mt-1">
                            <a class="nav-link" href="{{ route('transaksi-laundry-customer') }}" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">
                                        Customer</span>
                                </div>
                            </a>
                        </li>
                        @if(Auth::user()->role == 'Owner')
                        <li class="nav-item mt-1">
                            <a class="nav-link" href="{{ route('bulanan-laundry.index') }}" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">
                                        Jurnal Bulanan</span>
                                </div>
                            </a>
                        </li>
                        @endif
                    </ul>

                    <a class="nav-link dropdown-indicator collapsed" href="#laporanAbsen" role="button"
                        data-bs-toggle="collapse" aria-expanded="true" aria-controls="laporanAbsen">
                        <div class="d-flex align-items-center"><span class="nav-link-icon">
                                <i class="fas fa-calendar-alt"></i></span><span class="nav-link-text ps-1">Laporan
                                Absensi</span></div>
                    </a>
                    @php
                    $laporan_absensi = ['getUserReport', 'jadwal-laporan.index' ];
                    @endphp
                    <ul class="nav collapse {{ (in_array(request()->route()->getName(), $laporan_absensi)) ? 'show' : '' }}"
                        id="laporanAbsen" style="">
                        @if(Auth::user()->role == 'Owner')
                        <li class="nav-item mt-1">
                            <a class="nav-link" href="{{ route('getUserReport') }}" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">
                                        Laporan Pegawai</span>
                                </div>
                            </a>
                        </li>
                        @endif

                        <li class="nav-item mt-1">
                            <a class="nav-link" href="{{ route('jadwal-laporan.index') }}" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">
                                        Laporan Saya</span>
                                </div>
                            </a>
                        </li>
                    </ul>

                </li>
                @if (Auth::user()->role == 'Owner')
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Log dan Approval</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    <a class="nav-link" href="{{ route('approval-modal.index') }}" role="button" data-bs-toggle=""
                        aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <i class="fas fa-check-circle"></i>
                            </span>
                            <span class="nav-link-text ps-1">Approval Modal</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{ route('log-edit.index') }}" role="button" data-bs-toggle=""
                        aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <i class="fas fa-table"></i>
                            </span>
                            <span class="nav-link-text ps-1">Log Transaksi</span>
                        </div>
                    </a>
                </li>
                @endif


                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Sesi Login</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    <h6 class="mb-0">Role Anda<span class="text-primary"> {{ Auth::user()->role }}</span></h6>
                </li>
            </ul>
        </div>
    </div>
</nav>