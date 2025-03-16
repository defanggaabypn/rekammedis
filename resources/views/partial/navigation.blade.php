<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)"
            data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
        <div class="top-left-part bg-white"><a class="logo hidden-xs" href="{{route('home')}}"><b><img
                        src="/images/LSHC_Side.png" alt="lampungsporthealth" /></b><span class="hidden-xs"></span></a>
        </div>
        <ul class="nav navbar-top-links navbar-right pull-right">


            <!-- /.User Kanan -->
            <li class="dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img
                        src="{{Auth::user()->photo}}" onerror="this.onerror=null; this.src='{{asset('plugins/images/users/d1.jpg')}}'" alt="../plugins/images/users/d1.jpg" width="36" class="img-circle"><b
                        class="hidden-xs">{{Auth::user()->nama}}</b> </a>

                <!-- /.User Kanan -->
            </li>

        </ul>
    </div>
</nav>
