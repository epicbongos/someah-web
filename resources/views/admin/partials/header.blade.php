<div class="main-header" style="height: 61px !important;">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="" style="background-color: #027a75;">

        <a href="{{ url('/admin') }}" class="logo">
            <img src="{{ asset('assets') }}/images/someah-white.png" alt="navbar brand" class="navbar-brand"
                style="width: 120px !important; margin-left: 22px;">
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
            data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="icon-menu"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="icon-menu"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->

    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="" style="background-color: #008A85;">

        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item dropdown mr-4 pr-2">
                    <a href="{{ url('/') }}" target="_blank" style="color: white; text-decoration: none;">Kembali Ke
                        Beranda</a>
                </li>
                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            <i class="fa fa-user-circle" style="color: white !important; font-size: 37px; padding: 2px;"
                                aria-hidden="true"></i>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box" style="height: 56px; margin-top: -1px;">
                                    <div class="avatar-lg"><i class="fa fa-user-circle fa-3x" aria-hidden="true"
                                            style="color: #8C8C8C;"></i></div>
                                    <div class="u-text" style="margin-left: -10px !important; margin-top: 3px;">
                                        <h4 style="font-size: 16px;">{{ Auth::User()->name }}</h4>
                                        <p class="text-muted" style="margin-top: -3px;">{{ Auth::User()->email }}</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{url('admin/admin/edit/'. Auth::User()->id)}}">Account Setting</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Log Out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>
