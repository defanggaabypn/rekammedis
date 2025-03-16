<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    @include('partial.meta')

    <title>Profile</title>
    <!-- Bootstrap Core CSS -->
    <link href="/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/css/style.min.css" rel="stylesheet">

    <!-- color CSS -->
    <link href="/css/colors/megna.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper">
        <!-- Navigation -->
        <!-- Navigation -->
        @include('partial.navigation')
        <!-- End Navigation -->

        <!-- Left navbar-header -->
        @include('partial.menu')
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">{{ auth()->user()->role }} Profile</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="#">LSHC</a></li>
                            <li><a href="#">Akun</a></li>
                            <li class="active">{{ auth()->user()->role }} Profile</li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <!-- .row -->
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="white-box">
                        @if(auth()->user()->role == 'dokter')
    @php
        $dokter = \DB::table('dokters')->where('nama', auth()->user()->nama)->first();
    @endphp
    <div class="user-bg"> 
        @if($dokter && $dokter->photo && $dokter->photo != '../plugins/images/users/d1.jpg')
            <img class="img-fluid w-100 h-100" style="object-fit: cover;" alt="user" src="{{ asset($dokter->photo) }}">
        @else
            <img class="img-fluid w-100 h-100" style="object-fit: cover;" alt="user" src="{{ asset('plugins/images/users/d1.jpg') }}">
        @endif
    </div>
@elseif(auth()->user()->role == 'perawat')
    @php
        $perawat = \DB::table('perawats')->where('nama', auth()->user()->nama)->first();
    @endphp
    <div class="user-bg"> 
        @if($perawat && $perawat->photo && $perawat->photo != '../plugins/images/users/d1.jpg')
            <img class="img-fluid w-100 h-100" style="object-fit: cover;" alt="user" src="{{ asset($perawat->photo) }}">
        @else
            <img class="img-fluid w-100 h-100" style="object-fit: cover;" alt="user" src="{{ asset('plugins/images/users/d1.jpg') }}">
        @endif
    </div>
@else
    <div class="user-bg"> 
        @if(auth()->user()->photo && auth()->user()->photo != '/plugins/images/users/d1.jpg')
            <img class="img-fluid w-100 h-100" style="object-fit: cover;" alt="user" src="{{ asset(auth()->user()->photo) }}">
        @else
            <img class="img-fluid w-100 h-100" style="object-fit: cover;" alt="user" src="{{ asset('plugins/images/users/d1.jpg') }}">
        @endif
    </div>
@endif
                            <div class="user-btm-box">
                                <!-- .row -->
                                <div class="row text-center m-t-10">
                                    <div class="col-md-6 b-r"><strong>Nama</strong>
                                        <p>{{ auth()->user()->nama }}</p>
                                    </div>
                                    <div class="col-md-6"><strong>Role</strong>
                                        <p>{{ ucfirst(auth()->user()->role) }}</p>
                                    </div>
                                </div>
                                <!-- /.row -->
                                <hr>
                                <!-- .row -->
                                <div class="row text-center m-t-10">
                                    <div class="col-md-6 b-r"><strong>Email</strong>
                                        <p>{{ auth()->user()->email ?? 'admin@lshc.com' }}</p>
                                    </div>
                                    <div class="col-md-6"><strong>No.Telp</strong>
                                        <p>{{ auth()->user()->no_telp ?? '089524345376' }}</p>
                                    </div>
                                </div>
                                <!-- /.row -->
                                <hr>
                                <!-- .row -->
                                <div class="row text-center m-t-10">
                                    <div class="col-md-12"><strong>Alamat</strong>
                                        <p>{{ auth()->user()->alamat ?? 'Lampung Selatan' }}
                                            <br /> {{ auth()->user()->kokab_nama ?? 'Lampung' }}, Indonesia.</p>
                                    </div>
                                </div>

                                <!-- /.row -->
                                <hr>
                                <!-- Pasien terselesaikan section -->
                                <div class="row text-center m-t-10">
                                    @if(auth()->user()->role == 'dokter')
                                        @php
                                            $dokter = \DB::table('dokters')->where('nama', auth()->user()->nama)->first();
                                            $pasienCount = $dokter ? \DB::table('rekam_medis')->where('id_dokter', $dokter->id)->count() : 0;
                                        @endphp
                                        <div class="col-md-12"><strong>Pasien Tertangani</strong>
                                            <h1>{{ $pasienCount }}</h1>
                                        </div>
                                    @elseif(auth()->user()->role == 'perawat')
                                        <div class="col-md-12"><strong>Antrian Hari Ini</strong>
                                            <h1>{{ \DB::table('antrians')->whereDate('tgl_antri', date('Y-m-d'))->count() }}</h1>
                                        </div>
                                    @elseif(auth()->user()->role == 'superadmin' || auth()->user()->role == 'admin')
                                        <div class="col-md-12"><strong>Total Pasien</strong>
                                            <h1>{{ \DB::table('pasiens')->count() }}</h1>
                                        </div>
                                    @else
                                        <div class="col-md-12"><strong>Pasien Terselesaikan</strong>
                                            <h1>{{ $pasienCount ?? 0 }}</h1>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-xs-12">
                        <div class="white-box">
                            <table id="w0" class="table table-striped table-bordered detail-view">
                                <tbody>
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <td>{{ auth()->user()->nama }}</td>
                                    </tr>
                                    
                                    @if(auth()->user()->role == 'dokter')
                                        @php
                                            $dokter = \DB::table('dokters')->where('nama', auth()->user()->nama)->first();
                                        @endphp
                                        
                                        <tr>
                                            <th>Jenis Kelamin</th>
                                            <td>{{ $dokter ? $dokter->kelamin : auth()->user()->jenis_kelamin }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Lahir</th>
                                            <td>{{ $dokter ? date('d F Y', strtotime($dokter->tgl_lahir)) : (auth()->user()->tanggal_lahir ? auth()->user()->tanggal_lahir->format('d F Y') : '') }}</td>
                                        </tr>
                                        <tr>
                                            <th>No Telp</th>
                                            <td>{{ $dokter ? $dokter->no_telp : auth()->user()->no_telp }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $dokter ? $dokter->email : auth()->user()->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Spesialis</th>
                                            <td>{{ $dokter ? $dokter->spesialis : auth()->user()->spesialis }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alumni</th>
                                            <td>{{ $dokter ? $dokter->alumni : auth()->user()->alumni }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>{{ $dokter ? $dokter->alamat : auth()->user()->alamat }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jumlah Pasien Tertangani</th>
                                            <td>{{ $dokter ? \DB::table('rekam_medis')->where('id_dokter', $dokter->id)->count() : 0 }}</td>
                                        </tr>
                                    
                                    @elseif(auth()->user()->role == 'perawat')
                                        @php
                                            $perawat = \DB::table('perawats')->where('nama', auth()->user()->nama)->first();
                                        @endphp
                                        
                                        <tr>
                                            <th>Jenis Kelamin</th>
                                            <td>{{ $perawat ? $perawat->kelamin : auth()->user()->jenis_kelamin }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Lahir</th>
                                            <td>{{ $perawat ? date('d F Y', strtotime($perawat->tgl_lahir)) : (auth()->user()->tanggal_lahir ? auth()->user()->tanggal_lahir->format('d F Y') : '') }}</td>
                                        </tr>
                                        <tr>
                                            <th>No Telp</th>
                                            <td>{{ $perawat ? $perawat->no_telp : auth()->user()->no_telp }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $perawat ? $perawat->email : auth()->user()->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alumni</th>
                                            <td>{{ $perawat ? $perawat->alumni : auth()->user()->alumni }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>{{ $perawat ? $perawat->alamat : auth()->user()->alamat }}</td>
                                        </tr>
                                        <tr>
                                            <th>Antrian Hari Ini</th>
                                            <td>{{ \DB::table('antrians')->whereDate('tgl_antri', date('Y-m-d'))->count() }}</td>
                                        </tr>
                                    
                                    @else
                                        <tr>
                                            <th>Jenis Kelamin</th>
                                            <td>{{ auth()->user()->jenis_kelamin }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Lahir</th>
                                            <td>{{ auth()->user()->tanggal_lahir ? auth()->user()->tanggal_lahir->format('d F Y') : '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>No Telp</th>
                                            <td>{{ auth()->user()->no_telp }}</td>
                                        </tr>
                                        <tr>
                                            <th>No Telp 2</th>
                                            <td>{{ auth()->user()->no_telp2 }}</td>
                                        </tr>
                                        <tr>
                                            <th>Kokab Nama</th>
                                            <td>{{ auth()->user()->kokab_nama }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ auth()->user()->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alumni</th>
                                            <td>{{ auth()->user()->alumni }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>{{ auth()->user()->alamat }}</td>
                                        </tr>
                                    @endif
                                    
                                    @if(auth()->user()->role == 'superadmin' || auth()->user()->role == 'admin')
                                    <tr>
                                        <th>Total Pasien</th>
                                        <td>{{ \DB::table('pasiens')->count() }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Dokter</th>
                                        <td>{{ \DB::table('dokters')->count() }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Pengguna</th>
                                        <td>{{ \DB::table('users')->count() }}</td>
                                    </tr>
                                    @endif
                                    
                                    <tr>
                                        <th>Pekerjaan</th>
                                        <td>{{ auth()->user()->pekerjaan ?: ucfirst(auth()->user()->role) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created</th>
                                        <td>{{ auth()->user()->created_at }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- .right-sidebar -->
                <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span>
                        </div>
                        <div class="r-panel-body">
                            <ul>
                                <li><b>Layout Options</b></li>
                                <li>
                                    <div class="checkbox checkbox-info">
                                        <input id="checkbox1" type="checkbox" class="fxhdr">
                                        <label for="checkbox1"> Fix Header </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="checkbox checkbox-warning">
                                        <input id="checkbox2" type="checkbox" checked="" class="fxsdr">
                                        <label for="checkbox2"> Fix Sidebar </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox4" type="checkbox" class="open-close">
                                        <label for="checkbox4"> Toggle Sidebar </label>
                                    </div>
                                </li>
                            </ul>
                            <ul id="themecolors" class="m-t-20">
                                <li><b>With Light sidebar</b></li>
                                <li><a href="javascript:void(0)" data-theme="default" class="default-theme">1</a></li>
                                <li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
                                <li><a href="javascript:void(0)" data-theme="gray" class="yellow-theme">3</a></li>
                                <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme">4</a></li>
                                <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
                                <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme working">6</a>
                                </li>
                                <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                                <li><a href="javascript:void(0)" data-theme="default-dark"
                                        class="default-dark-theme">7</a></li>
                                <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a>
                                </li>
                                <li><a href="javascript:void(0)" data-theme="gray-dark" class="yellow-dark-theme">9</a>
                                </li>
                                <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme">10</a>
                                </li>
                                <li><a href="javascript:void(0)" data-theme="purple-dark"
                                        class="purple-dark-theme">11</a></li>
                                <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme">12</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.right-sidebar -->
            </div>
            <!-- /.container-fluid -->
            @include('partial.footer')
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="/bootstrap/dist/js/tether.min.js"></script>
    <script src="/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="/js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="/js/custom.min.js"></script>
    <!--Style Switcher -->
    <script src="/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>