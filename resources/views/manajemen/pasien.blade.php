<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    @include('partial.meta')

    <title>Manajemen Pasien</title>

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
    <!--alerts CSS -->
    <link href="/plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
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
                        <h4 class="page-title">Pasien</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="index.html">LSHC</a></li>
                            <li><a href="#">Manajemen</a></li>
                            <li class="active">Pasien</li>
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
                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title m-b-0">Data Pasien</h3>
                        <hr />
                        <div>
                            <h3 class="box-title m-b-0 float-left">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#responsive-modal"><i
                                        class="fa fa-plus"></i> Pasien Baru</button>
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
                                                        <input type="text" name="nama" class="form-control" id="nama">
                                                    </div>
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
                                                        <label for="kelamin" class="control-label">Jenis Kelamin</label>
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
                                                        <label for="notlp" class="control-label">Nomor Telepon</label>
                                                        <input name="no_telp" type="number" class="form-control"
                                                            id="notlp"> </div>
                                                    <div class="form-group">
                                                        <label for="email" class="control-label">Email</label>
                                                        <input name="email" type="text" class="form-control" id="email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pekerjaan" class="control-label">Pekerjaan</label>
                                                        <input name="pekerjaan" type="text" class="form-control"
                                                            id="pekerjaan"> </div>
                                                    <div class="form-group">
                                                        <label for="pj" class="control-label">Penanggung Jawab</label>
                                                        <input name="pj" type="text" class="form-control" id="pj">
                                                    </div>
                                                    {{-- <div class="form-group">
                                                        <label for="dokter" class="control-label">Dokter</label>
                                                        <select name="dokter" id="dokter" class="form-control">
                                                            <option value="" disabled>Pilih Dokter...</option>
                                                            @foreach ($dokters as $dokter)
                                                            <option value="{{$dokter->id}}">{{$dokter->nama}}</option>
                                                    @endforeach
                                                    </select>
                                            </div> --}}
                                      

                                            <div class="modal-footer">
                                                <button name="aksi" type="submit" value="1"
                                                    class="btn btn-success waves-effect waves-light">Simpan</button>

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
                    <br><br><br>


                    <!-- Data Table -->
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No.Rekam Medis</th>
                                    <th>No.NIK</th>
                                    <th>Nama Pasien</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>No.Telp</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($pasiens!=null)
                                @foreach ($pasiens as $key => $item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->no_rekmed}}</td>
                                    <td>{{$item->NIK}}</td>
                                    <td>{{$item->nama}}</td>
                                    <td>{{$item->tgl_lahir}}</td>
                                    <td>{{$item->kelamin}}</td>
                                    <td>{{$item->no_telp}}</td>
                                    <td>
                                        <button class="btn" data-toggle="modal" data-target="#edit-pasien-modal{{$item->id}}"><i
                                                class="fa fa-edit" data-toggle="tooltip" data-html="true"
                                                title="Edit"></i></button>
                                        <a href="{{route('manajemen.jadwalpasien.show', $item->id)}}">
                                            <button class="btn"><i class="fa fa-calendar-plus-o" data-toggle="tooltip"
                                                    data-html="true" title="Lihat Jadwal"></i></button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- end Data Table -->
                    <!-- /.SC modal -->
                    @if ($pasiens!=null)
                    @foreach ($pasiens as $key => $item)
                    <div class="col-md-4">
                        <div>
                            <!-- /.modal EDIT DATA PASIEN-->
                            <div id="edit-pasien-modal{{$item->id}}" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">×</button>
                                            <h4 class="modal-title">Edit Data Pasien</h4>
                                        </div>
                                        <div class="modal-body">
                                            <!-- /.Form Modal EDIT DATA PASIEN -->
                                            <form action="{{route('manajemen.pasien.edit')}}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="no_rekmed" class="control-label">Nomor Rekam
                                                        Medis</label>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="text" class="form-control" id="no_rekmed"
                                                                    value="{{$item->no_rekmed}}"> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama" class="control-label">Nama Pasien</label>
                                                    <input name="nama" type="text" class="form-control" id="nama"
                                                        value="{{$item->nama}}"> </div>
                                                <div class="form-group">
                                                    <label for="NIK" class="control-label">No.NIK</label>
                                                    <input name="NIK" type="text" class="form-control" id="NIK"
                                                        value="{{$item->NIK}}"> </div>
                                                <div class="form-group">
                                                    <label for="tl" class="control-label">Tanggal Lahir</label>
                                                    <div class="input-group">
                                                        <input type="text" name="tgl_lahir" class="form-control"
                                                            id="datepicker-autoclose" placeholder="mm/dd/yyyy"
                                                            value="{{$item->tgl_lahir}}">
                                                        <span class="input-group-addon"><i
                                                                class="icon-calender"></i></span> </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="kelamin" class="control-label">Jenis Kelamin</label>
                                                    <select name="kelamin" class="form-control">
                                                        <option value="Laki-laki">Laki-Laki</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                    </select>
                                                </div>
                                                {{-- <div class="form-group">
                                                        <label for="alamat" class="control-label">Alamat:</label>
                                                        <textarea name="alamat" class="form-control" id="alamat"></textarea>
                                                    </div> --}}
                                                <div class="form-group">
                                                    <label for="no_telp" class="control-label">Nomor Telepon</label>
                                                    <input name="no_telp" type="text" class="form-control" id="no_telp"
                                                        value="{{$item->no_telp}}"> </div>
                                                <div class="form-group">
                                                    <label for="email" class="control-label">Email</label>
                                                    <input name="email" type="text" class="form-control" id="email"
                                                        value="{{$item->email}}"> </div>
                                                <div class="form-group">
                                                    <label for="pekerjaan" class="control-label">Pekerjaan</label>
                                                    <input name="pekerjaan" type="text" class="form-control"
                                                        id="pekerjaan" value="{{$item->pekerjaan}}"> </div>
                                                <div class="form-group">
                                                    <label for="pj" class="control-label">Penanggung Jawab</label>
                                                    <input name="pj" type="text" class="form-control" id="pj"
                                                        value="{{$item->pj}}"> </div>
                                                <div class="form-group">
                                                    <label for="photo">Foto</label>
                                                    <div>
                                                        <input name="photo" type="file"
                                                            class="form-control form-control-file"
                                                            id="exampleFormControlFile1">
                                                    </div>
                                                    <div class="form-control">
                                                        <img src="{{asset('/storage/pasien/'.$item->photo)}}"
                                                            alt="No photos">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" name="id" value="{{$item->id}}"
                                                        class="btn btn-danger waves-effect waves-light">Update Data
                                                        Pasien</button>
                                                </div>
                                            </form>
                                            <!-- /. end Form Modal EDIT DATA PASIEN -->
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- Button trigger modal -->
                        </div>
                    </div>
                    @endforeach
                                @endif
                    <!-- /.end modal EDIT DATA PASIEN -->
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
    <!-- Sweet-Alert  -->
    <script src="/plugins/bower_components/sweetalert/sweetalert.min.js"></script>
    <script src="/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>
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
    <!--Style Switcher -->
    <script src="/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>

</body>

</html>
