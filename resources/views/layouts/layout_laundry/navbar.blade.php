<nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
    <div class="d-flex align-items-center">
        
        <div class="toggle-icon-wrapper">
         
        </div>
        <a class="navbar-brand" href="{{ route('dashboard-laundry') }}">
            <div class="d-flex align-items-center py-3"><span class="font-sans-serif">Laundry</span></div>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">
            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                @if (Auth::user()->role == 'Owner')
                    <li class="nav-item">
                        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                            <div class="col-auto navbar-vertical-label">Dashboard</div>
                            <div class="col ps-0">
                                <hr class="mb-0 navbar-vertical-divider">
                            </div>
                        </div>
                        <a class="nav-link" href="{{ route('dashboard-laundry') }}" role="button" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <span class="nav-link-icon">
                                    <i class="fas fa-home"></i>
                                </span>
                                <span class="nav-link-text ps-1">Dashboard</span>
                            </div>
                        </a>
                    </li>
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Master Data</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    <a class="nav-link" href="{{ route('master-pegawai.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <i class="fas fa-user"></i>
                            </span>
                            <span class="nav-link-text ps-1">Pegawai</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{ route('laundry-type.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <i class="fas fa-dollar-sign"></i>
                            </span>
                            <span class="nav-link-text ps-1">Harga dan Type</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{ route('laundry-jenis.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <i class="fas fa-user-friends"></i>
                            </span>
                            <span class="nav-link-text ps-1">Jenis Penerima</span>
                        </div>
                    </a>
                    
                @endif
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Transaction</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    <a class="nav-link" href="{{ route('transaksi-laundry.create') }}" role="button" data-bs-toggle="" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <i class="fas fa-cash-register"></i>
                            </span>
                            <span class="nav-link-text ps-1">Transaksi</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{ route('transaksi-laundry.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <i class="fas fa-sync-alt"></i>
                            </span>
                            <span class="nav-link-text ps-1">Rekapan Hari Ini</span>
                        </div>
                    </a>
                </li>
              
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Pelaporan</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    <a class="nav-link" href="{{ route('transaksi-laundry-all') }}" role="button" data-bs-toggle="" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <i class="far fa-list-alt"></i>
                            </span>
                            <span class="nav-link-text ps-1">Seluruh Transaksi</span>
                        </div>
                    </a>
                    <a class="nav-link" href="{{ route('transaksi-laundry-customer') }}" role="button" data-bs-toggle="" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <i class="fas fa-user-friends"></i>
                            </span>
                            <span class="nav-link-text ps-1">Customer</span>
                        </div>
                    </a>
                    @if (Auth::user()->role == 'Owner')
                    <a class="nav-link" href="{{ route('bulanan-laundry.index') }}" role="button" data-bs-toggle="" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <i class="fas fa-book"></i>
                            </span>
                            <span class="nav-link-text ps-1">Jurnal Bulanan</span>
                        </div>
                    </a>
                    @endif   
                </li>

                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Other Apps</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    <a class="nav-link" href="{{ url('https://ptriastavalasindo.com/') }}" role="button" data-bs-toggle="" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <i class="fas fa-long-arrow-alt-left"></i>
                            </span>
                            <span class="nav-link-text ps-1">Money Changer App</span>
                        </div>
                    </a>
                </li>
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
