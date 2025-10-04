        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <p class="brand-link">
                {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8"> --}}
                <span class="brand-text font-weight-light">Si Akad Mini</span>
            </p>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/data-mahasiswa"
                                class="nav-link {{ request()->routeIs('dataMahasiswa') ? 'active' : '' }}">
                                <i class="nav-icon  fas fa-users"></i>
                                <p>
                                    Data Mahasiswa
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/data-dosen"
                                class="nav-link {{ request()->routeIs('dataDosen') ? 'active' : '' }}">
                                <i class="nav-icon  fas fa-users"></i>
                                <p>
                                    Data Dosen
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/mata-kuliah"
                                class="nav-link {{ request()->routeIs('MataKuliah') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Data Mata Kuliah
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/jadwal-kuliah"
                                class="nav-link {{ request()->routeIs('dataJadwalKuliah') ? 'active' : '' }}">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>
                                    Data Jadwal Kuliah
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/nilai"
                                class="nav-link {{ request()->routeIs('dataNilaiMahasiswa') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>
                                    Nilai Mahasiswa
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
