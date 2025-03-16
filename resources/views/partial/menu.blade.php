<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">


            <li class="nav-small-cap m-t-10"></li>
            <li> <a href="{{Route('home')}}" class="waves-effect"><i class="ti-home p-r-10"></i> <span
                        class="hide-menu ">Beranda</span></a> </li>
                        {{-- 
            @can('olah_pasien')
            <li> <a href="{{Route('pendaftaran.index')}}" class="waves-effect"><i class="fa fa-user-plus p-r-10"></i>
                    <span class="hide-menu"> Pendaftaran </span></a>
            @endcan
            --}}
            <li> <a href="{{Route('pemeriksaan.index')}}" class="waves-effect"><i class="fa fa-stethoscope p-r-10"></i>
                    <span class="hide-menu"> Pemeriksaan </span></a>
            </li>

            <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-hospital-o p-r-10"></i>
                    <span class="hide-menu"> Manajemen <span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{Route('manajemen.pasien')}}"><i class="fa fa-users"></i> Pasien </a></li>
                    @can('olah_obat')
                        <li><a href="{{Route('manajemen.obat')}}"><i class="fa fa-plus-square"></i> Obat </a></li>
                    @endcan
                    @can('olah_rekmed')
                        <li><a href="{{Route('manajemen.rm')}}"><i class="fa fa-book"></i> Rekam Medis </a></li>
                    @endcan
                    <li><a href="{{Route('manajemen.jadwalpasien')}}"><i class="fa fa-calendar-plus-o"></i> Jadwal
                            Pasien </a>
                    </li>
                    @can('superadmin')
                        <li><a href="{{Route('manajemen.dokter')}}"><i class="fa fa-user-md"></i> Dokter </a></li>
                        <li><a href="{{Route('manajemen.perawat')}}"><i class="fa fa-user-plus"></i> Perawat </a></li>
                    @endcan
                    @can('olah_keuangan')
                    <li><a href="{{Route('manajemen.keuangan')}}"><i class="fa fa-money"></i> Keuangan </a></li>
                    @endcan
                </ul>
            </li>
            <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-user p-r-10"></i> <span
                        class="hide-menu"> Akun <span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    @can('superadmin')
                    <li><a href="{{ route('manajemen-akun.index') }}"><i class="icon-people"></i> Manajemen Akun
                        </a>
                    </li>
                    @endcan
                    <li><a href="{{ route('akun.profil') }}"><i class="fa fa-user"></i> Profile </a></li>
                    <li><a href="{{ route('akun.ganti-password') }}"><i class="fa fa-key"></i> Ganti Password </a></li>
                </ul>
            </li>
            <li class="nav-small-cap m-t-10"></li>
            <li><a href="/logout" class="waves-effect "><i class="icon-logout fa-fw"></i> <span class="hide-menu">Log
                        out</span></a></li>

        </ul>
    </div>
</div>
