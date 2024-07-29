<body class="g-sidenav-show bg-gray-100">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="{{ route('staff.pengajuan.index') }}">
                <center>
                    <img src="{{ asset('ui_dashboard') }}/assets/img/logo-ct-dark.png" class="navbar-brand-img h-100"
                        alt="main_logo" style="width: 6rem;">
                </center>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">

                <!-- Superadmin Menu Items -->
                @if (auth()->user()->role->role_name === 'Superadmin')
                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-superadmin" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="navbar-superadmin">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">User Management</span>
                        </a>
                        <div class="collapse" id="navbar-superadmin">
                            <ul class="nav ms-4">
                                <li class="nav-item {{ request()->is('superadmin/staff*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('staff.index') }}">
                                        <span class="sidenav-mini-icon"> S </span>
                                        <span class="sidenav-normal"> Manage Staff </span>
                                    </a>
                                </li>
                                <li class="nav-item {{ request()->is('superadmin/technician*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('technician.index') }}">
                                        <span class="sidenav-mini-icon"> T </span>
                                        <span class="sidenav-normal"> Manage Technicians </span>
                                    </a>
                                </li>
                                <li class="nav-item {{ request()->is('superadmin/maintenance*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('maintenance.index') }}">
                                        <span class="sidenav-mini-icon"> M </span>
                                        <span class="sidenav-normal"> Manage Maintenance </span>
                                    </a>
                                </li>
                                <li class="nav-item {{ request()->is('superadmin/vendor*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('vendor.index') }}">
                                        <span class="sidenav-mini-icon"> V </span>
                                        <span class="sidenav-normal"> Manage Vendors </span>
                                    </a>
                                </li>
                                <li class="nav-item {{ request()->is('superadmin/project*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('project.index') }}">
                                        <span class="sidenav-mini-icon"> T </span>
                                        <span class="sidenav-normal"> Manage Projects </span>
                                    </a>
                                </li>
                                <li class="nav-item {{ request()->is('superadmin/customer*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('customer.index') }}">
                                        <span class="sidenav-mini-icon"> C </span>
                                        <span class="sidenav-normal"> Manage Customers </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

                <!-- Staff Menu Items -->
                @if (auth()->user()->role->role_name === 'Staff')
                    <li class="nav-item">
                        <a class="nav-link active" href="#navbar-staff" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="navbar-staff">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Staff</span>
                        </a>
                        <div class="collapse" id="navbar-staff">
                            <ul class="nav ms-4">
                                <li class="nav-item {{ request()->is('staff/pengajuan*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('staff.pengajuan.index') }}">
                                        <span class="sidenav-mini-icon"> P </span>
                                        <span class="sidenav-normal"> Pengajuan </span>
                                    </a>
                                </li>
                                <li class="nav-item {{ request()->is('staff/riwayat*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('staff.riwayat.index') }}">
                                        <span class="sidenav-mini-icon"> R </span>
                                        <span class="sidenav-normal"> Riwayat </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

                <!-- Maintenance Menu Items -->
                @if (auth()->user()->role->role_name === 'Maintenance')
                    <li class="nav-item">
                        <a class="nav-link active" href="#navbar-maintenance" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="navbar-maintenance">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-settings-gear-65 text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Maintenance</span>
                        </a>
                        <div class="collapse" id="navbar-maintenance">
                            <ul class="nav ms-4">
                                <li class="nav-item {{ request()->is('maintenance/pengajuan*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('maintenance.pengajuan.index') }}">
                                        <span class="sidenav-mini-icon"> P </span>
                                        <span class="sidenav-normal"> Pengajuan </span>
                                    </a>
                                </li>
                                <li class="nav-item {{ request()->is('maintenance/pemasangan*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('maintenance.pemasangan.index') }}">
                                        <span class="sidenav-mini-icon"> P </span>
                                        <span class="sidenav-normal"> Pemasangan </span>
                                    </a>
                                </li>
                                <li class="nav-item {{ request()->is('maintenance/riwayat*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('maintenance.riwayat.index') }}">
                                        <span class="sidenav-mini-icon"> R </span>
                                        <span class="sidenav-normal"> Riwayat </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

                <!-- Technician Menu Items -->
                @if (auth()->user()->role->role_name === 'Technician')
                    <li class="nav-item">
                        <a class="nav-link active" href="#navbar-technician" data-bs-toggle="collapse"
                            role="button" aria-expanded="false" aria-controls="navbar-technician">
                            <div
                                class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-hat-3 text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Technician</span>
                        </a>
                        <div class="collapse" id="navbar-technician">
                            <ul class="nav ms-4">
                                <li class="nav-item {{ request()->is('technician/pengajuan*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('technician.pengajuan.index') }}">
                                        <span class="sidenav-mini-icon"> P </span>
                                        <span class="sidenav-normal"> Pengajuan </span>
                                    </a>
                                </li>
                                <li class="nav-item {{ request()->is('technician/pemasangan*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('technician.pemasangan.index') }}">
                                        <span class="sidenav-mini-icon"> P </span>
                                        <span class="sidenav-normal"> Pemasangan </span>
                                    </a>
                                </li>
                                <li class="nav-item {{ request()->is('technician/riwayat*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('technician.riwayat.index') }}">
                                        <span class="sidenav-mini-icon"> R </span>
                                        <span class="sidenav-normal"> Riwayat </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
