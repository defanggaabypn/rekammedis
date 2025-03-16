<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    @include('partial.meta')

    <title>Manajemen Obat</title>

    <!-- Bootstrap Core CSS -->
    <link href="/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <link href="/plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

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
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">MANAJEMEN OBAT</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="index.html">LSHC</a></li>
                            <li>Manajemen</li>
                            <li class="active">Obat</li>
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
                    Form Tidak Valid!
                </div>
                @endif
                {{-- /.end Error show --}}
                <!-- /.modal Obat Baru-->
                <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">

                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Tambah Obat Baru</h4>
                            </div>

                            <div class="modal-body">
                                <!-- /.Form Modal Obat Baru -->
                                <form action="{{Route('manajemen.obat.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nama" class="control-label">Nama Obat</label>
                                        <input name="nama" type="text" class="form-control" id="nama">
                                    </div>
                                    <div class="form-group">
                                        <label for="pabrikan" class="control-label">Pabrikan</label>
                                        <input name="pabrikan" type="text" class="form-control" id="pabrikan">
                                    </div>
                                    <div class="form-group">
                                        <label for="golongan" class="control-label">Golongan</label>
                                        <input name="golongan" type="text" class="form-control" id="golongan">
                                    </div>
                                    <div class="form-group">
                                        <label for="stok" class="control-label">Jumlah</label>
                                        <input name="stok" type="number" class="form-control" id="stok">
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
                                        <button type="submit" class="btn btn-danger waves-effect waves-light">Simpan</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /. end Form Modal Akun Baru -->
                        </div>
                    </div>
                </div>
                <!-- Button trigger modal -->

                <!-- /.modal Edit Obat -->
                @foreach ($obats as $key => $obat)
                <div id="edit-modal{{$key+1}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Edit Obat</h4>
                            </div>

                            <div class="modal-body">
                                <!-- /.Form Edit Obat  -->
                                <form action="{{Route('manajemen.obat.update')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nama" class="control-label">Nama Obat</label>
                                        <input name="nama" type="text" class="form-control" id="nama" value="{{$obat->nama}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="pabrikan" class="control-label">Pabrikan</label>
                                        <input name="pabrikan" type="text" class="form-control" id="pabrikan" value="{{$obat->pabrikan}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="golongan" class="control-label">Golongan</label>
                                        <input name="golongan" type="text" class="form-control" id="golongan" value="{{$obat->golongan}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="tipe" class="control-label">Aksi</label>
                                        <select name="tipe" id="tipe" class="form-control"
                                            placeholder="Pasien">
                                            <option value="" disabled>Aksi</option>
                                            <option value="Penambahan">Penambahan</option>
                                            <option value="Pengurangan">Pengurangan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlh" class="control-label">Jumlah</label>
                                        <input name="stok" type="number" class="form-control" id="stok" value={{$obat->stok}} placeholder="**.butir">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" value="{{$obat->id}}" name="id"  class="btn btn-danger waves-effect waves-light">Simpan</button>
                                    </div>
                                </form>

                            </div>
                            <!-- /. end Form Modal Akun Baru -->
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- Button trigger modal -->

                <div class="col-sm-12">
                    <div class="white-box">
                        <div>
                            <h3 class="box-title m-b-15 float-left">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#responsive-modal">
                            <i class="fa fa-plus"></i> Data Obat Baru
                                </button>
                            </h3>
                        </div>

                        <!-- Data Table -->
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Obat</th>
                                        <th>Pabrikan</th>
                                        <th>Golongan</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($obats as $key => $obat)
                                        <tr>
                                            <th>{{$key+1}}</th>
                                            <td>{{$obat->nama}}</td>
                                            <td>{{$obat->pabrikan}}</td>
                                            <td>{{$obat->golongan}}</td>
                                            <td>{{$obat->stok}}</td>
                                            <td>
                                                <button class="btn" data-toggle="modal" data-target="#edit-modal{{$key+1}}">
                                                    <i class="icon-pencil" data-toggle="tooltip" data-html="true"
                                                    title="Edit" data-id="{{$obat->id}}"></i></button>
                                                <form action="{{Route('manajemen.obat.rirwayat')}}" method="post">
                                                    @csrf
                                                    <button type="submit" value="{{$obat->id}}" class="btn" name="id"><a href="/manajemen/obat/riwayat-update">
                                                        <i class="fa fa-history" data-toggle="tooltip" data-html="true"
                                                        title="Riwayat Update"></i></a></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <span>
                                {{$obats->links()}}
                            </span>
                        </div>
                        <!-- end Data Table -->
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

</body>

</html>
