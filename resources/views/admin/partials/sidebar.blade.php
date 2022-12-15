@php
if (\Request::is('admin')) {
    @$dashboard = 'active';
} elseif (\Request::is('admin/team')) {
    @$team = 'active';
} elseif (\Request::is('admin/portfolio')) {
    @$portfolio = 'active';
} elseif (\Request::is('admin/karir')) {
    @$carrer = 'active';
} elseif (\Request::is('admin/tipe-project')) {
    @$type = 'active';
} elseif (\Request::is('admin/tipe-karir')) {
    @$type = 'active';
} elseif (\Request::is('admin/client')) {
    @$client = 'active';
} elseif (\Request::is('admin/estimasi')) {
    @$estimasi = 'active';
} elseif (\Request::is('admin/estimasi')) {
    @$vision = 'active';
} elseif (\Request::is('admin/admin')) {
    @$admin = 'active';
} elseif (\Request::is('admin/position')) {
    @$position = 'active';
} elseif (\Request::is('admin/employee')) {
    @$employee = 'active';
} elseif (\Request::is('admin/salary')) {
    @$salary = 'active';
} elseif (\Request::is('admin/training')) {
    @$training = 'active';
} elseif (\Request::is('admin/contact')) {
    @$contact = 'active';
} elseif (\Request::is('admin/somebot-projects')) {
    @$somebot = 'active';
} elseif (\Request::is('admin/somebot-groups')) {
    @$somebot = 'active';
}
@endphp

<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left">
                    <i class="fa fa-user-circle" style="color: #8C8C8C; font-size: 39px;" aria-hidden="true"></i>
                </div>
                <div class="info">
                    <a>
                        <span class="user-level text-capitalize"
                            style="margin-left: 52px;">{{ Auth::User()->name }}</span>
                        <span
                            style="font-size: 13px; margin-top: -1px; margin-left: 52px;">{{ Auth::User()->role }}</span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <ul class="nav nav-success">
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Dashboard</h4>
                </li>
                <li class="nav-item {{ @$dashboard }}">
                    <a href="{{ url('admin/estimasi') }}">
                        <i class="fas fa-layer-group"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                {{-- <li class="nav-item {{ @$dashboard }}"> --}}
                {{-- <a data-toggle="collapse" href="#dashboard"> --}}
                {{-- <i class="fas fa-layer-group"></i> --}}
                {{-- <p>Dashboard</p> --}}
                {{-- <span class="caret"></span> --}}
                {{-- </a> --}}
                {{-- <div class="collapse" id="dashboard"> --}}
                {{-- <ul class="nav nav-collapse mb-0"> --}}
                {{-- <li> --}}
                {{-- <a href="{{ url('admin/') }}" id="sub-menu"> --}}
                {{-- <span class="sub-item">Portfolio Slider</span> --}}
                {{-- </a> --}}
                {{-- </li> --}}
                {{-- <li> --}}
                {{-- <a href="{{ url('admin') }}" id="sub-menu"> --}}
                {{-- <span class="sub-item">Pilih Client</span> --}}
                {{-- </a> --}}
                {{-- </li> --}}
                {{-- </ul> --}}
                {{-- </div> --}}
                {{-- </li> --}}
                @if (Auth::user()->role == 'sdm' || Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Bisnis</h4>
                    </li>
                    <li class="nav-item {{ @$carrer }}">
                        <a data-toggle="collapse" href="#karir">
                            <i class="fas fa-briefcase"></i>
                            <p>Karir</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="karir">
                            <ul class="nav nav-collapse mb-0">
                                <li>
                                    <a href="{{ url('admin/karir') }}" id="sub-menu">
                                        <span class="sub-item">Lowongan Pekerjaan</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('admin/applicant') }}" id="sub-menu">
                                        <span class="sub-item">Pelamar</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item {{ @$estimasi }}">
                        <a href="{{ url('admin/estimasi') }}">
                            <i class="fas fa-archive"></i>
                            <p>Estimasi Project</p>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Tampilan Depan</h4>
                    </li>
                    <li class="nav-item {{ @$portfolio }}">
                        <a href="{{ url('admin/portfolio') }}">
                            <i class="fas fa-file-alt"></i>
                            <p>Portofolio</p>
                        </a>
                    </li>
                    <li class="nav-item {{ @$client }}">
                        <a href="{{ url('admin/client') }}">
                            <i class="fas fa-building"></i>
                            <p>Klien</p>
                        </a>
                    </li>
                    <li class="nav-item {{ @$team }}">
                        <a href="{{ url('admin/team') }}">
                            <i class="fas fa-users"></i>
                            <p>Team Member</p>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role == 'sdm' || Auth::user()->role == 'superadmin')
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Kepegawaian</h4>
                    </li>
                    <li class="nav-item {{ @$employee }}">
                        <a href="{{ url('admin/employee') }}">
                            <i class="fas fa-users"></i>
                            <p>Pangkalan Data</p>
                        </a>
                    </li>
                    <li class="nav-item {{ @$salary }}">
                        <a href="{{ url('admin/salary') }}">
                            <i class="fas fa-money-bill-wave"></i>
                            <p>Penggajian</p>
                        </a>
                    </li>
                    <li class="nav-item {{ @$position }}">
                        <a href="{{ url('admin/position') }}">
                            <i class="far fa-id-card"></i>
                            <p>Jabatan Pegawai</p>
                        </a>
                    </li>
                    <li class="nav-item {{ @$training }}">
                        <a href="{{ url('admin/training') }}">
                            <i class="fas fa-users"></i>
                            <p>Pelatihan Karyawan</p>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Master</h4>
                    </li>
                    <li class="nav-item {{ @$type }}">
                        <a data-toggle="collapse" href="#tipe">
                            <i class="fab fa-bandcamp"></i>
                            <p>Tipe - Tipe</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="tipe">
                            <ul class="nav nav-collapse mb-0">
                                <li>
                                    <a href="{{ url('admin/tipe-project') }}" id="sub-menu">
                                        <span class="sub-item">Tipe Project</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('admin/tipe-karir') }}" id="sub-menu">
                                        <span class="sub-item">Tipe Karir</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('admin/tipe') }}" id="sub-menu">
                                        <span class="sub-item">Tipe Lingkup</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item {{ @$contact }}">
                        <a href="{{ url('admin/contact') }}">
                            <i class="fas fa-address-card"></i>
                            <p>Kontak</p>
                        </a>
                    </li>
                    <li class="nav-item {{ @$vision }}">
                        <a href="{{ url('admin/about') }}">
                            <i class="fas fa-gem"></i>
                            <p>Visi & Misi</p>
                        </a>
                    </li>
                    <li class="nav-item {{ @$somebot }}">
                        <a data-toggle="collapse" href="#somebot">
                            <i class="fas fa-robot"></i>
                            <p>Somebot</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="somebot">
                            <ul class="nav nav-collapse mb-0">
                                <li>
                                    <a href="{{ url('admin/somebot-projects') }}" id="sub-menu">
                                        <span class="sub-item">Project</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('admin/somebot-groups') }}" id="sub-menu">
                                        <span class="sub-item">Groups</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                @if (Auth::user()->role == 'superadmin')
                    <li class="nav-item {{ @$admin }}">
                        <a href="{{ url('admin/admin') }}">
                            <i class="fas fa-user-secret"></i>
                            <p>Admin</p>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>

<!-- End Sidebar -->
