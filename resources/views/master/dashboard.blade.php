<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    @include('partial.meta')
    <!-- End Meta -->

    <title>Dashboard</title>

    <!-- Bootstrap Core CSS -->
    <link href="/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/css/style.min.css" rel="stylesheet">
    <!-- Chart JS -->
   
   
    <!-- color CSS -->
    <link href="/css/colors/megna.css" id="theme" rel="stylesheet">
    <link href="/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet"
        type="text/css" />


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
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
    <!-- end Preloader -->

    <div id="wrapper">
        <!-- Navigation -->
        @include('partial.navigation')
        <!-- end Navigation -->

        <!-- Left navbar-header -->
        @include('partial.menu')
        <!-- Left navbar-header end -->

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- /.Row Title -->
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">LSHC Dashboard</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="index.html">LSHC</a></li>
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
                <!-- /.end Row Title -->
                {{-- /.Error show --}}
                @if (Session::has('transactionerror'))
                <div class="alert alert-danger" role="alert">
                    {{Session::get('transactionerror')}}
                </div>
                @endif
                @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                @endif
                @if (Session::has('redirected'))
                <div class="alert alert-danger" role="alert">
                    {{Session::get('redirected')}}
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    Form Tidak Valid!
                </div>
                @endif
                {{-- /.end Error show --}}
                <!-- /row -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="white-box">
                            <div>
                                <h3 class="box-title m-b-0 float-left">Antrian Pemeriksaan Hari Ini</h3>
                            </div>
                            <div>
                                <h3 class="box-title m-b-0 float-right">
                                    <button class="btn btn-primary" data-toggle="modal"
                                        data-target="#pasienlama-modal"><i class="fa fa-plus"></i> Pasien Lama</button>
                                    <button class="btn btn-success" data-toggle="modal"
                                        data-target="#responsive-modal"><i class="fa fa-plus"></i> Pasien Baru</button>
                                </h3>
                            </div>
                            <!-- /.SC modal -->
                            <div class="col-md-4">
                                <div>
                                    <!-- /.modal Pasien Baru-->
                                    <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog"
                                        aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                    <h4 class="modal-title">Tambah Pasien Baru</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- /.Form Modal Pasien Baru -->
                                                    <form action="{{route('pendaftaran.baru')}}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="nama" class="control-label">Nama Pasien</label>
                                                            <input type="text" name="nama" class="form-control"
                                                                id="nama"> </div>
                                                        <div class="form-group">
                                                            <label for="nik" class="control-label">No.NIK</label>
                                                            <input type="number" name="NIK" class="form-control" id="nik">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tl" class="control-label">Tanggal Lahir</label>
                                                            <div class="input-group">
                                                                <input type="text" name="tgl_lahir" class="form-control"
                                                                    id="datepicker-autoclose" placeholder="mm/dd/yyyy">
                                                                <span class="input-group-addon"><i
                                                                        class="icon-calender"></i></span> </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="kelamin" class="control-label">Jenis
                                                                Kelamin</label>
                                                            <select name="kelamin" class="form-control">
                                                                <option value="Laki-laki">Laki-Laki</option>
                                                                <option value="Perempuan">Perempuan</option>
                                                            </select>
                                                        </div>
                                                        {{-- <div class="form-group">
                                                            <label for="alamat" class="control-label">Alamat:</label>
                                                            <textarea name="alamat" class="form-control"
                                                                id="alamat"></textarea>
                                                        </div> --}}

                                                        <div class="form-group">
                                                            <label for="notlp" class="control-label">Nomor
                                                                Telepon</label>
                                                            <input name="no_telp" type="number" class="form-control"
                                                                id="notlp"> </div>
                                                        <div class="form-group">
                                                            <label for="email" class="control-label">Email</label>
                                                            <input name="email" type="text" class="form-control"
                                                                id="email"> </div>
                                                        <div class="form-group">
                                                            <label for="pekerjaan"
                                                                class="control-label">Pekerjaan</label>
                                                            <input name="pekerjaan" type="text" class="form-control"
                                                                id="pekerjaan"> </div>
                                                        <div class="form-group">
                                                            <label for="pj" class="control-label">Penanggung
                                                                Jawab</label>
                                                            <input name="pj" type="text" class="form-control" id="pj">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="dokter" class="control-label">Dokter</label>
                                                            <select name="dokter" id="dokter" class="form-control">
                                                                <option value="" disabled>Pilih Dokter...</option>
                                                                @foreach ($dokters as $dokter)
                                                                <option value="{{$dokter->id}}">{{$dokter->nama}}
                                                                </option>
                                                                @endforeach
                                                            </select> </div>
                                                    
                                                        <div class="form-group">
                                                            @if ($errors->any())
                                                            <div class="alert alert-danger">
                                                                <ul>
                                                                    @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button name="aksi" type="submit" value="1"
                                                                class="btn btn-danger waves-effect waves-light">Simpan</button>
                                                            <button name="aksi" type="submit" value="2"
                                                                class="btn btn-success waves-effect waves-light">Simpan
                                                                dan Tambah Ke Antrian</button>
                                                        </div>
                                                    </form>
                                                    <!-- /. end Form Modal Pasien Baru -->
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Button trigger modal -->
                                </div>
                            </div>
                            <!-- /.end modal Pasien Baru -->

                            <!-- Pasien Lama Modal -->
                            <div class="col-md-4">
                                <div>
                                    <!-- /.modal -->
                                    <div id="pasienlama-modal" class="modal fade" tabindex="-1" role="dialog"
                                        aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                    <h4 class="modal-title">Tambah Pasien</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- /.Form Modal Pasien Lama -->
                                                    <form action="{{route('pendaftaran.lama')}}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="dokter" class="control-label">Dokter</label>
                                                            <select name="dokter" id="dokter" class="form-control">
                                                                <option value="" disabled>Pilih Dokter...</option>
                                                                @foreach ($dokters as $dokter)
                                                                <option value="{{$dokter->id}}">{{$dokter->nama}}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nmr" class="control-label">Pasien</label>
                                                            <select name="pasien" id="dokter" class="form-control"
                                                                placeholder="Pasien">
                                                                <option value="" disabled>Pasien</option>
                                                                @foreach ($pasiens as $item)
                                                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            @if ($errors->any())
                                                            <div class="alert alert-danger">
                                                                <ul>
                                                                    @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit"
                                                                class="btn btn-success waves-effect waves-light">Tambahkan
                                                                Keantrian</button>
                                                        </div>
                                                    </form>
                                                    <!-- /. end Form Modal Pasien Lama -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Button trigger modal -->
                                </div>
                            </div>
                            <!-- Pasien Lama Modal -->
                            <br><br><br>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No. Rekam Medis</th>
                                            <th>Nama</th>
                                            <th>Dokter</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($antrian as $item)
                                        <tr>
                                            <td>{{ $item->pasien->no_rekmed }}-{{$item->rekam_medis->no_bag_rekmed}}
                                            </td>
                                            <td>{{ $item->pasien->nama }}</td>
                                            <td>{{ $item->rekam_medis->dokter->nama }}</td>
                                            <td>
                                                <a href="{{route('manajemen.rm.edit', $item->rekam_medis->id)}}">
                                                    <button name="id" type="button"
                                                        class="btn btn-secondary">Proses</button>
                                                </a>
                                                <a href="{{route('home.antrian.delete', $item->rekam_medis->id)}}">
                                                    <button class="btn" data-toggle="tooltip"
                                                        data-html="true" title="Hapus"><i class="fa fa-trash"></i></button>
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Pasien Selesai Hari Ini</h3>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>Nama</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($antrianselesai as $item)
                                        <tr>
                                            <th>{{ $loop->iteration }}</th>
                                            <th>{{ $item->pasien->nama }}</th>
                                            <td>
                                                <a href="{{route('manajemen.rm.show', $item->rekam_medis->id)}}">
                                                    <button name="id" type="button"
                                                        class="btn btn-secondary">lihat</button>
                                                </a>
                                            </td>
                                        </tr>
                                        @empty

                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <!-- .row -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Pasien PERTAHUN</h3>
                            <ul class="list-inline text-center">
                                <li>
                                    <h5><i class="fa fa-circle m-r-5" style="color: #00bfc7;"></i>Jumlah Pasien</h5>
                                </li>

                            </ul>
                            <div>
                                <canvas id="chart1" height="100"></canvas>
                            </div>
                        </div>
                    </div>

                </div>

                <!--row -->
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="white-box">
                            <div class="r-icon-stats"> <i class="ti-user bg-megna"></i>
                                <div class="bodystate">
                                    <h4>{{$totalantrian}}</h4> <span class="text-muted">Pasien Hari Ini</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="white-box">
                            <div class="r-icon-stats"> <i class="fa fa-users"></i>
                                <div class="bodystate">
                                    <h4>-</h4> <span class="text-muted">Pasien 3 Bulan Terakhir</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="white-box">
                            <div class="r-icon-stats"> <i class="ti-wallet bg-success"></i>
                                <div class="bodystate">
                                    <h4>Rp {{$keuangan}}</h4> <span class="text-muted">Pendapatan Hari Ini</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="white-box">
                            <div class="r-icon-stats"> <i class="ti-wallet bg-inverse"></i>
                                <div class="bodystate">
                                    <h4>Rp {{$keuangansebulan}}</h4> <span class="text-muted">Pendapatan Bulan
                                        Ini</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

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
    <!-- Sparkline chart JavaScript -->
    <script src="/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!-- jQuery peity -->
    <script src="/plugins/bower_components/peity/jquery.peity.min.js"></script>
    <script src="/plugins/bower_components/peity/jquery.peity.init.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="/js/custom.min.js"></script>
    <!--Style Switcher -->
    <script src="/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="/plugins/bower_components/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Chart JS -->
    
    <script src="/plugins/bower_components/Chart.js/Chart.min.js"></script>
    <script>
        // Date Picker
        jQuery('.mydatepicker, #datepicker').datepicker();
        jQuery('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true,
            endDate: new Date() // Membatasi tanggal maksimal sampai hari ini
        });
        jQuery('#date-range').datepicker({
            toggleActive: true
        });
        jQuery('#datepicker-inline').datepicker({
            todayHighlight: true
        });
        // Daterange picker
        $('.input-daterange-datepicker').daterangepicker({
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-danger',
            cancelClass: 'btn-inverse'
        });
        $('.input-daterange-timepicker').daterangepicker({
            timePicker: true,
            format: 'MM/DD/YYYY h:mm A',
            timePickerIncrement: 30,
            timePicker12Hour: true,
            timePickerSeconds: false,
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-danger',
            cancelClass: 'btn-inverse'
        });
        $('.input-limit-datepicker').daterangepicker({
            format: 'MM/DD/YYYY',
            minDate: '06/01/2015',
            maxDate: '06/30/2015',
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-danger',
            cancelClass: 'btn-inverse',
            dateLimit: {
                days: 6
            }
        });
</script>
<script>
    $( document ).ready(function() {
    var q1  = <?= $chart1->get('kon'); ?>;
    var q2  = <?= $chart2->get('kon'); ?>;
    var q3  = <?= $chart3->get('kon'); ?>;
    var q4  = <?= $chart4->get('kon'); ?>;
    
    var ctx1 = document.getElementById("chart1").getContext("2d");
    var data1 = {
        labels: ["{{$chart1->get('bulan')}}", "{{$chart2->get('bulan')}}", "{{$chart3->get('bulan')}}", "{{$chart4->get('bulan')}}"],
        datasets: [
            {
                label: "pasien",
                fillColor: "rgba(152,235,239,0.8)",
                strokeColor: "rgba(152,235,239,0.8)",
                pointColor: "rgba(152,235,239,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(152,235,239,1)",
                data: [ q1,q2,q3,q4 ]
            }
            
        ]
    };
    var chart1 = new Chart(ctx1).Line(data1, {
        scaleShowGridLines : true,
        scaleGridLineColor : "rgba(0,0,0,.005)",
        scaleGridLineWidth : 0,
        scaleShowHorizontalLines: true,
        scaleShowVerticalLines: true,
        bezierCurve : true,
        bezierCurveTension : 0.4,
        pointDot : true,
        pointDotRadius : 4,
        pointDotStrokeWidth : 1,
        pointHitDetectionRadius : 2,
        datasetStroke : true,
		tooltipCornerRadius: 2,
        datasetStrokeWidth : 2,
        datasetFill : true,
        legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
        responsive: true
    });
});

</script>
</body>

</html>
