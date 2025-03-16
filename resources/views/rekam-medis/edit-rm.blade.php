<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    @include('partial.meta')

    <title> Rekam Medis</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
                    Form Tidak Boleh Kosong!
                </div>
                @endif
                {{-- /.end Error show --}}
                <!-- Header tanggal -->
                <!-- <div class="row">
                    <div class="col-md-12">
                        <div class="white-box p-b-0 p-t-0">
                            @foreach ($pasien->rekam_medis->all() as $item)
                                <ul class="pagination m-b-5 m-t-5">
                                    @if ($item->id == $rm->id)
                                    <li class="active">
                                        @if ($item->status==true)
                                        <a href="{{route('manajemen.rm.show', $item->id)}}">
                                            <button type="button" class="btn btn-light btn-sm" value="{{$item->id}}"></button>
                                        </a>
                                        @else
                                        <a href="{{route('manajemen.rm.edit', $item->id)}}">
                                            <button type="button" class="btn btn-light btn-sm" value="{{$item->id}}"></button>
                                        </a>
                                        @endif
                                    </li>
                                    @else
                                    <li>
                                        @if ($item->status==true)
                                        <a href="{{route('manajemen.rm.show', $item->id)}}">
                                            <button type="button" class="btn btn-light btn-sm">{{$item->tgl_rekam}}</button>
                                        </a>
                                        @else
                                        <a href="{{route('manajemen.rm.edit', $item->id)}}">
                                            <button type="button" class="btn btn-light btn-sm">{{$item->tgl_rekam}}</button>
                                        </a>
                                        @endif
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            <span>{{$pasien->no_rekmed}}-{{$rm->no_bag_rekmed}}</span>
                        </div>
                    </div>
                </div> -->
                <!-- /.end Header Tanggal -->
                <form action="{{route('manajemen.rm.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <!-- sidebar profile -->
                            <div class="col-md-3">
                                <div class="white-box">
                                    <div class="profile-usertitle">
                                        <div> <img src="{{asset('storage/pasien/'.$rm->pasien->photo)}}" onerror="this.onerror=null; this.src='{{asset('plugins/images/users/d1.jpg')}}'" class="rounded-circle" width="40%"
                                                alt="Cinque Terre"></div>
                                        <div class="profile-usertitle-name"> {{$pasien->nama}} </div>
                                        <div class="profile-usertitle-job"> {{$age}} Tahun</div>
                                        <div class="m-b-10">{{ $pasien->alamat }}</div>
                                    </div>
                                </div>


                                <div class="row list-separated white-box">

                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <input name="tensi" type="text" class="form-control" id="td" value="{{$rm->tensi}}">
                                        </div>
                                        <div class="uppercase profile-stat-text"> TD (120/80) </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <input name="nadi" type="text" class="form-control" id="nadi" value="{{$rm->nadi}}">
                                        </div>
                                        <div class="uppercase profile-stat-text"> Nadi (x/min) </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <input name="nafas" type="text" class="form-control" id="nafas" value="{{$rm->nafas}}">
                                        </div>
                                        <div class="uppercase profile-stat-text"> Resp Rate (x/min) </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <input name="suhu" type="text" class="form-control" id="suhu" value="{{$rm->suhu}}">
                                        </div>
                                        <div class="uppercase profile-stat-text"> Suhu (C) </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <input name="berat" type="text" class="form-control" id="berat" value="{{$rm->berat}}">
                                        </div>
                                        <div class="uppercase profile-stat-text"> BB (kg) </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <input name="tinggi" type="text" class="form-control" id="tinggi" value="{{$rm->tinggi}}">
                                        </div>
                                        <div class="uppercase profile-stat-text"> TB (cm) </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-6"></div>
                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                        <div class="form-group">
                                            <input name="bmi" type="text" class="form-control" id="tinggi" value="{{$rm->bmi}}">
                                        </div>
                                        <div class="uppercase profile-stat-text"> BMI </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-6"></div>

                                </div>
                                <div class="white-box">
                                <!-- Jadwal Kunjungan -->
                                <div class="mb-3">
                                    <h4 class="text-primary font-weight-bold">Jadwal Pasien</h4>
                                </div>
                                        <div class="form-group">
                                            <label for="agenda" class="control-label">Agenda</label>
                                            <input type="text" name="agenda" class="form-control" id="agenda">
                                        </div>
                                        <div class="form-group">
                                            <label for="jadwal" class="control-label">Jadwal Kunjungan Berikut</label>
                                            <div class="input-group">
                                                <input type="text" name="jadwal" class="form-control"
                                                    id="datepicker-autoclose" placeholder="mm/dd/yyyy">
                                                <span class="input-group-addon"><i
                                                        class="icon-calender"></i></span> </div>
                                        </div>
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
                                                            <td>
                                                                <div class="form-group">
                                                                    <input name="subyektif" type="text"
                                                                        class="form-control" id="subyektif" value="{{$rm->subyektif}}"> </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>(O) Obyektif</th>
                                                            <td>
                                                                <div class="form-group">
                                                                    <input name="obyektif" type="text"
                                                                        class="form-control" id="obyektif" value="{{$rm->obyektif}}"> </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>(A) Assesment</th>
                                                            <td>
                                                                <div class="form-group">
                                                                    <input name="asessment" type="text"
                                                                        class="form-control" id="asessment" value="{{$rm->asessment}}"> </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>(P) Plan</th>
                                                            <td>
                                                                <div class="form-group">
                                                                    <input name="plan" type="text" class="form-control"
                                                                        id="plan" value="{{$rm->plan}}">
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <th>Diagnosis</th>
                                                            <td>
                                                                <div class="form-group">
                                                                    <input name="diagnosis" type="text"
                                                                        class="form-control" id="diagnosis" value="{{$rm->diagnosis}}"> </div>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <th>Tindakan</th>
                                                            <td>
                                                                <div class="form-group">
                                                                    <input name="tindakan" type="text"
                                                                        class="form-control" id="tindakan" value="{{$rm->tindakan}}"> </div>

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
                                                                            <tr>
                                                                                <td>
                                                                                    <select name="obat" id="dokter" class="form-control">
                                                                                        <option value="" disabled>Pilih Obat...</option>
                                                                                        @foreach ($obat as $item)
                                                                                        <option value="{{$item->id}}">{{$item->nama}} (stok={{$item->stok}})
                                                                                        </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <input name="jumlah" type="number" class="form-control" id="jumlah">
                                                                                </td>
                                                                                <td>
                                                                                    <input name="signa" type="text" class="form-control" id="signa">
                                                                                </td>
                                                                            </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>


                                                        {{-- <tr>
                                                            <th>Obat</th>
                                                            <td>
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Nama Obat</th>
                                                                            <th>Jumlah</th>
                                                                            <th>Signa</th>
                                                                        </tr>
                                                        <!-- Form Obat -->
                                                                        <tr>
                                                                            @forelse ($relasiobat as $item)
                                                                            <td>
                                                                                <div class="form-goup">
                                                                                    {{$item->obat->nama}}
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-goup">
                                                                                    {{$item->obat->nama}}
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-goup">
                                                                                    {{$item->obat->nama}}
                                                                                </div>
                                                                            </td>
                                                                            @empty
                                                                            <div class="form-group">
                                                                                Tidak ada obat untuk rekam medis ini.
                                                                            </div>
                                                                            @endforelse
                                                                            <form action="{{route('manajemen.rm.add.obat')}}" method="post" id="tambahobat">
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <select name="obat" id="obat" class="form-control">
                                                                                        <option value="" disabled>Pilih Obat...</option>
                                                                                        @foreach ($obat as $item)
                                                                                        <option value="{{$item->id}}">{{$item->nama}}(stok = {{$item->stok}})
                                                                                        </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input name="jumlah" type="text"
                                                                                        class="form-control" id="diagnosis" placeholder="Jangan lebih dari sisa stok!">
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input name="signa" type="text"
                                                                                        class="form-control" id="signa" placeholder="3xsehari">
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                        <!-- end Form Obat -->
                                                                    </thead>
                                                                </table>
                                                            <!-- Button Tambah Obat -->

                                                                <button type="submit" name="id" value="{{$rm->id}}" class="btn btn-primary float-left"><i
                                                                    class="fa fa-plus"></i> Tambah Obat</button>
                                                            </td>
                                                        </form>
                                                        </tr> --}}

                                                    </tbody>
                                                </table>

                                                <br><br><br>

                                                <div class="form-group">
                                                    <label for="selesai" class="control-label">Tandai sudah selesai(Anda tidak dapat merubah data lagi)</label>
                                                    <input type="checkbox" name="status" id="status" value="true">
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
                                                    <button name="id" type="submit" value="{{$rm->id}}" class="btn btn-danger waves-effect waves-light">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END PORTLET -->
                                    </div>
                                </div>


                            </div>
                            <!-- end sidebar content -->
                        </div>


                    </div>
                </form>

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

() {
      $(".add-more").click(function(){
          var html = $("#copy").html();
          $("#copy").after(html);

      });

      // saat tombol remove dklik control group akan dihapus
      $("body").on("click",".remove",function(){
          $(this).parents(".control-group").remove();
      });
    });
</script>
