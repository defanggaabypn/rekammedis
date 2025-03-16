<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    @include('partial.meta')

    <title> Rekam Medis</title>

    <!-- Bootstrap Core CSS -->
    <link href="/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <link href="/plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet"
        type="text/css" />
    <link href="/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet"
        type="text/css" />
    <!-- Menu CSS -->
    <link href="/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/css/style.min.css" rel="stylesheet">
    <!-- File Drop css -->
    <link rel="stylesheet" href="/plugins/bower_components/dropify/dist/css/dropify.min.css">
    <!-- color CSS -->
    <link href="/css/colors/megna.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <style>
        .profile-stat-title {
            color: #7f90a4;
            font-size: 25px;
            text-align: center;
        }

        .profile-stat-text {
            color: #5b9bd1;
            font-size: 11px;
            font-weight: 800;
            text-align: center;
        }

        .profile-usertitle {
            text-align: center;
            margin-top: 20px;
        }

        .profile-usertitle-name {
            color: #5a7391;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 7px;
        }

        .profile-usertitle-job {
            text-transform: uppercase;
            color: #5b9bd1;
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 7px;
        }

        .profile-userbuttons {
            text-align: center;
            margin-top: 10px;
        }

        .profile-content {
            overflow: visible;
        }

        .portlet {
            margin-top: 0;
            margin-bottom: 25px;
            padding: 0;
            border-radius: 4px;
        }

        .portlet.light.bordered {
            border: 1px solid #e7ecf1 !important;
        }

        .portlet.light {
            padding: 12px 20px 15px;
            background-color: #fff;
        }

        .portlet.light .portlet-body {
            padding-top: 8px;
        }

    </style>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <!-- Preloader -->

    <div id="wrapper">
        <!-- Navigation -->
        @include('partial.navigation')
        <!-- End Navigation -->

        <!-- Left navbar-header -->
        @include('partial.menu')
        <!-- Left navbar-header end -->

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- /.Row Title -->
                <div class="row bg-title p-b-5 m-b-10">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">MANAJEMEN REKAM MEDIS</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="index.html">LSHC</a></li>
                            <li>Rekam Medis</li>
                            <li class="active">Data Rekam Medis</li>
                        </ol>
                    </div>
                </div>
                <!-- /.end Row Title -->
                {{-- /.Error show --}}
                @if (Session::has('transactionerror'))
                <div class="alert alert-danger" role="alert">
                    {{Session::get('transactionerror')}}
                </div>
                @elseif (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    Gagal menambahkan file!
                </div>
                @endif
                {{-- /.end Error show --}}
                <!-- Header tanggal -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box p-b-0 p-t-0">
                                <ul class="pagination m-b-5 m-t-5">
                                    @foreach ($pasien->rekam_medis->all() as $item)
                                    @if ($item->status==true)
                                    <li>
                                        <a href="{{route('manajemen.rm.show', $item->id)}}" class="btn btn-light btn-sm">
                                            {{$item->tgl_rekam}}
                                        </a>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            <!-- <span>{{$pasien->no_rekmed}}-{{$rm->no_bag_rekmed}}</span> -->
                        </div>
                    </div>
                </div>
                <!-- /.end Header Tanggal -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- sidebar profile -->
                        <div class="col-md-3">
                            <div class="white-box">
                                <div class="profile-usertitle">
                                    <div> <img src="{{asset('storage/pasien/'.$rm->pasien->photo)}}" onerror="this.onerror=null; this.src='{{asset('plugins/images/users/d1.jpg')}}'" alt="" class="rounded-circle" width="40%"
                                            alt="Cinque Terre"></div>
                                    <div class="profile-usertitle-name"> {{$pasien->nama}} </div>
                                    <div class="profile-usertitle-job"> {{$age}} Tahun</div>
                                    <div class="m-b-10">{{ $pasien->alamat }}</div>
                                </div>
                            </div>

                            <div class="row list-separated white-box">
                                <!-- BMI -->
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <div class="uppercase profile-stat-title"> {{$rm->tensi}} </div>
                                    <div class="uppercase profile-stat-text"> TD (120/80) </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <div class="uppercase profile-stat-title"> {{$rm->nadi}} </div>
                                    <div class="uppercase profile-stat-text"> Nadi (x/min) </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <div class="uppercase profile-stat-title"> {{$rm->nafas}} </div>
                                    <div class="uppercase profile-stat-text"> Resp Rate (x/min) </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <div class="uppercase profile-stat-title"> {{$rm->suhu}} </div>
                                    <div class="uppercase profile-stat-text"> Suhu (C) </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <div class="uppercase profile-stat-title"> {{$rm->berat}} </div>
                                    <div class="uppercase profile-stat-text"> BB (kg) </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <div class="uppercase profile-stat-title"> {{$rm->tinggi}} </div>
                                    <div class="uppercase profile-stat-text"> TB (cm) </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6"></div>
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <div class="uppercase profile-stat-title"> {{$rm->bmi}} </div>
                                    <div class="uppercase profile-stat-text"> BMI </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-6"></div>

                            </div>

                        </div>

                        <!-- end sidebar profile -->

                        <!-- Sidebar content -->
                        <div class="profile-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="portlet light bordered">

                                        <div class="portlet-body">
                                            <table class="table table-hover">
                                                <tbody>
                                                    <tr>
                                                        <th style="width:20%">(S) Subyektif</th>
                                                        <td>{{$rm->subyektif}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>(O) Obyektif</th>
                                                        <td>{{$rm->obyektif}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>(A) Assesment</th>
                                                        <td>{{$rm->asessment}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>(P) Plan</th>
                                                        <td>{{$rm->plan}}</td>
                                                    </tr>

                                                    <tr>
                                                        <th>Diagnosis</th>
                                                        <td>
                                                            {{$rm->diagnosis}}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th>Tindakan</th>
                                                        <td>
                                                            {{$rm->tindakan}}
                                                        </td>
                                                    </tr>


                                                    <tr>
                                                        <th>Obat</th>
                                                        <td>
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Nama Obat</th>
                                                                        <th>Jumlah</th>
                                                                        <th>Signa</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @forelse ($rm->obat as $item)
                                                                            <tr>
                                                                                <td>{{$item->pivot->nama}}</td>
                                                                                <td>{{$item->pivot->jumlah}}</td>
                                                                                <td>{{$item->pivot->signa}}</td>
                                                                            </tr>
                                                                            @empty
                                                                                Tidak ada data Obat dalam Rekam Medis!
                                                                    @endforelse
                                                                </tbody>


                                                            </table>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- END PORTLET -->
                                </div>
                            </div>


                        </div>
                        <!-- end sidebar content -->
                    </div>


                </div>


            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    @include('partial.footer')
    </div>
    <!-- /#page-wrapper -->
    </div>
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
    <script src="/plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
            $(document).ready(function () {
                var table = $('#example').DataTable({
                    "columnDefs": [{
                        "visible": false,
                        "targets": 2
                    }],
                    "order": [
                        [2, 'asc']
                    ],
                    "displayLength": 25,
                    "drawCallback": function (settings) {
                        var api = this.api();
                        var rows = api.rows({
                            page: 'current'
                        }).nodes();
                        var last = null;
                        api.column(2, {
                            page: 'current'
                        }).data().each(function (group, i) {
                            if (last !== group) {
                                $(rows).eq(i).before(
                                    '<tr class="group"><td colspan="5">' +
                                    group + '</td></tr>');
                                last = group;
                            }
                        });
                    }
                });
                // Order by the grouping
                $('#example tbody').on('click', 'tr.group', function () {
                    var currentOrder = table.order()[0];
                    if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                        table.order([2, 'desc']).draw();
                    } else {
                        table.order([2, 'asc']).draw();
                    }
                });
            });
        });
        $('#example23').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

    </script>
    <!-- Color Picker Plugin JavaScript -->
    <script src="/plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asColor.js"></script>
    <script src="/plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asGradient.js"></script>
    <script src="/plugins/bower_components/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="/plugins/bower_components/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script>
        // Date Picker
        jQuery('.mydatepicker, #datepicker').datepicker();
        jQuery('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true
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
    <!--Style Switcher -->
    <script src="/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
    <!-- jQuery file upload -->
    <script src="/plugins/bower_components/dropify/dist/js/dropify.min.js"></script>
    <script>
        $(document).ready(function () {
            // Basic
            $('.dropify').dropify();
            // Translated
            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-déposez un fichier ici ou cliquez',
                    replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                    remove: 'Supprimer',
                    error: 'Désolé, le fichier trop volumineux'
                }
            });
            // Used events
            var drEvent = $('#input-file-events').dropify();
            drEvent.on('dropify.beforeClear', function (event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });
            drEvent.on('dropify.afterClear', function (event, element) {
                alert('File deleted');
            });
            drEvent.on('dropify.errors', function (event, element) {
                console.log('Has Errors');
            });
            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function (e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })
        });

    </script>
</body>

</html>
