<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)"
            data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
        <div class="top-left-part bg-white"><a class="logo hidden-xs" href="{{route('home')}}"><b><img
                        src="/images/LSHC_Side.png" alt="lampungsporthealth" /></b><span class="hidden-xs"></span></a>
        </div>
        <ul class="nav navbar-top-links navbar-right pull-right">


            <!-- /.User Kanan -->
            <li class="dropdown">
    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
        @if(Auth::user()->role == 'dokter')
            @php
                $dokter = \DB::table('dokters')->where('nama', Auth::user()->nama)->first();
            @endphp
            @if($dokter && $dokter->photo && $dokter->photo != '../plugins/images/users/d1.jpg')
                <img src="{{ asset($dokter->photo) }}" alt="user-img" width="36" height="36" class="img-circle" style="object-fit: cover;">
            @else
                <img src="{{ asset('plugins/images/users/d1.jpg') }}" alt="user-img" width="36" height="36" class="img-circle" style="object-fit: cover;">
            @endif
        @elseif(Auth::user()->role == 'perawat')
            @php
                $perawat = \DB::table('perawats')->where('nama', Auth::user()->nama)->first();
            @endphp
            @if($perawat && $perawat->photo && $perawat->photo != '../plugins/images/users/d1.jpg')
                <img src="{{ asset($perawat->photo) }}" alt="user-img" width="36" height="36" class="img-circle" style="object-fit: cover;">
            @else
                <img src="{{ asset('plugins/images/users/d1.jpg') }}" alt="user-img" width="36" height="36" class="img-circle" style="object-fit: cover;">
            @endif
        @else
            @if(Auth::user()->photo && Auth::user()->photo != '/plugins/images/users/d1.jpg')
                <img src="{{ asset(Auth::user()->photo) }}" alt="user-img" width="36" height="36" class="img-circle" style="object-fit: cover;">
            @else
                <img src="{{ asset('plugins/images/users/d1.jpg') }}" alt="user-img" width="36" height="36" class="img-circle" style="object-fit: cover;">
            @endif
        @endif
        <b class="hidden-xs">{{Auth::user()->nama}}</b>
    </a>
    <!-- /.User Kanan -->
</li>

        </ul>
    </div>
</nav>
