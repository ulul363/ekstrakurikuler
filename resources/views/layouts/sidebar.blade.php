<!-- [ navigation menu ] start -->

<style>
    .pcoded-navbar {
        height: 100vh;
        overflow-y: auto;
        background-color: #343a40;
    }

    .navbar-wrapper {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .navbar-content {
        flex-grow: 1;
    }
</style>

<nav class="pcoded-navbar  ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div ">
            <div class="">
                <div class="collapse" id="nav-user-link">
                    <ul class="list-unstyled">
                        <li class="list-group-item"><a href="user-profile.html"><i class="feather icon-user m-r-5"></i>View
                                Profile</a></li>
                        <li class="list-group-item"><a href="#!"><i
                                    class="feather icon-settings m-r-5"></i>Settings</a></li>
                        <li class="list-group-item"><a href="auth-normal-sign-in.html"><i
                                    class="feather icon-log-out m-r-5"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
            <ul class="nav pcoded-inner-navbar">
                <li class="nav-item pcoded-menu-caption">
                    <label>Menu</label>
                </li>

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <span class="pcoded-micon"><i class="fa fa-dashboard"></i></span>
                        <span class="pcoded-mtext d-none d-md-inline">Dashboard</span>
                    </a>
                </li>

                @hasrole('admin')
                    <li class="nav-item">
                        <a href="{{ route('manage.users') }}" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-list"></i></span>
                            <span class="pcoded-mtext d-none d-md-inline">Daftar Pengguna</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('manage.siswa') }}" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                            <span class="pcoded-mtext d-none d-md-inline">Siswa</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('manage.pembina') }}" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-user-check"></i></span>
                            <span class="pcoded-mtext d-none d-md-inline">Pembina</span>
                        </a>
                    </li>                    

                    <li class="nav-item">
                        <a href="{{ route('manage.ekstrakurikuler') }}" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-activity"></i></span>
                            <span class="pcoded-mtext">Ekstrakurikuler</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        {{-- <a href="{{ route('manage.program.kegiatan') }}" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-activity"></i></span>
                            <span class="pcoded-mtext">Program Kegiatan</span>
                        </a> --}}
                    </li>
                    <li class="nav-item">
                        {{-- <a href="{{ route('manage.kehadiran') }}" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-check-circle"></i></span>
                            <span class="pcoded-mtext">Kehadiran</span>
                        </a> --}}
                    </li>
                    <li class="nav-item">
                        {{-- <a href="{{ route('manage.jadwal.ekstrakurikuler') }}" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-calendar"></i></span>
                            <span class="pcoded-mtext">Jadwal Ekstrakurikuler</span>
                        </a> --}}
                    </li>
                    <li class="nav-item">
                        {{-- <a href="{{ route('manage.prestasi.ekstrakurikuler') }}" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-award"></i></span>
                            <span class="pcoded-mtext">Prestasi Ekstrakurikuler</span>
                        </a> --}}
                    </li>
                    <li class="nav-item">
                        {{-- <a href="{{ route('manage.prestasi.peserta') }}" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-star"></i></span>
                            <span class="pcoded-mtext">Prestasi Peserta</span>
                        </a> --}}
                    </li>
                    <li class="nav-item">
                        {{-- <a href="{{ route('chat.with.pembina') }}" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-message-circle"></i></span>
                            <span class="pcoded-mtext">Chat</span>
                        </a> --}}
                    </li>
                @endhasrole

                @hasrole('pembina')
                    <li class="nav-item">
                        <a href="{{ route('review.program.kegiatan') }}" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-activity"></i></span>
                            <span class="pcoded-mtext">Program Kegiatan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('review.kehadiran') }}" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-check-circle"></i></span>
                            <span class="pcoded-mtext">Kehadiran</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('view.jadwal.ekstrakurikuler') }}" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-calendar"></i></span>
                            <span class="pcoded-mtext">Jadwal Ekstrakurikuler</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('view.prestasi.ekstrakurikuler') }}" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-award"></i></span>
                            <span class="pcoded-mtext">Prestasi Ekstrakurikuler</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('review.prestasi.peserta') }}" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-star"></i></span>
                            <span class="pcoded-mtext">Prestasi Peserta</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('chat.with.siswa') }}" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-message-circle"></i></span>
                            <span class="pcoded-mtext">Chat with Siswa</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('review.pertemuan') }}" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-message-circle"></i></span>
                            <span class="pcoded-mtext">Review Pertemuan</span>
                        </a>
                    </li>
                @endhasrole

                @hasrole('siswa')
                    <li class="nav-item">
                        <a href="{{ route('view.ekstrakurikuler') }}" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-activity"></i></span>
                            <span class="pcoded-mtext">Ekstrakurikuler</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('add.view.program.kegiatan') }}" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-activity"></i></span>
                            <span class="pcoded-mtext">Program Kegiatan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('add.view.berkas.kehadiran') }}" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-check-circle"></i></span>
                            <span class="pcoded-mtext">Berkas Kehadiran</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('view.jadwal.ekstrakurikuler') }}" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-calendar"></i></span>
                            <span class="pcoded-mtext">Jadwal Ekstrakurikuler</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('add.view.prestasi.ekstrakurikuler') }}" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-award"></i></span>
                            <span class="pcoded-mtext">Prestasi Ekstrakurikuler</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('add.view.prestasi.siswa') }}" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-star"></i></span>
                            <span class="pcoded-mtext">Prestasi Siswa</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('request.pertemuan') }}" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-message-circle"></i></span>
                            <span class="pcoded-mtext">Request Pertemuan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('chat.with.pembina') }}" class="nav-link">
                            <span class="pcoded-micon"><i class="feather icon-message-circle"></i></span>
                            <span class="pcoded-mtext">Chat with Pembina</span>
                        </a>
                    </li>
                @endhasrole
            </ul>
        </div>
    </div>
</nav>
<!-- [ navigation menu ] end -->
