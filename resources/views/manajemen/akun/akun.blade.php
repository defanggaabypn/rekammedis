<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    @include('partial.meta')

    <!-- Title -->
    <title>Manajemen Akun</title>

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
                        <h4 class="page-title">MANAJEMEN AKUN</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="index.html">LSHC</a></li>
                            <li class="active"><a href="index.html">Manajemen Akun</a></li>
                        </ol>
                    </div>
                </div>
                <!-- /.end Row Title -->

                <div class="col-sm-12">
                    <div class="white-box">
                        <div>
                            <h3 class="box-title m-b-0 float-left">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#responsive-modal"><i
                                        class="fa fa-plus"></i> Akun Baru
                                </button>
                            </h3>
                        </div>

                        <div class="col-md-4">
                            <div>
                                <!-- /.modal Akun Baru-->
                                <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                                <h4 class="modal-title">Tambah Akun Baru</h4>
                                            </div>
                                            <div class="modal-body">
<!-- Form Modal Akun Baru yang sudah dimodifikasi -->
<form action="{{ route('manajemen-akun.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="username" class="control-label">Username</label>
        <input type="text" class="form-control" id="usernamebaru" name="username">
        @error('username')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="nama" class="control-label">Nama Pemegang</label>
        <input type="text" class="form-control" id="namabaru" name="nama">
        @error('nama')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="role" class="control-label">Role</label>
        <select name="role" id="rolebaru" class="form-control">
            <option value="">Pilih Role</option>
            <option value="owner">Owner</option>
            <option value="staff">Staff</option>
            <option value="dokter">Dokter</option>
            <option value="perawat">Perawat</option>
        </select>
        @error('role')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <!-- Field untuk Dokter - awalnya tersembunyi -->
    <div id="dokter-field" class="form-group" style="display: none;">
        <label for="dokter_id" class="control-label">Pilih Dokter</label>
        <select name="dokter_id" id="dokter_id" class="form-control">
            <option value="">Pilih Dokter</option>
            <!-- Akan diisi melalui AJAX -->
        </select>
    </div>

    <!-- Field untuk Perawat - awalnya tersembunyi -->
    <div id="perawat-field" class="form-group" style="display: none;">
        <label for="perawat_id" class="control-label">Pilih Perawat</label>
        <select name="perawat_id" id="perawat_id" class="form-control">
            <option value="">Pilih Perawat</option>
            <!-- Akan diisi melalui AJAX -->
        </select>
    </div>

    <!-- Field untuk Owner/Staff - awalnya tersembunyi -->
    <div id="user-fields" style="display: none;">
        <div class="form-group">
            <label for="jenis_kelamin" class="control-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="tanggal_lahir" class="control-label">Tanggal Lahir</label>
            <input type="date" class="form-control mydatepicker" name="tanggal_lahir">
        </div>
        <div class="form-group">
            <label for="email" class="control-label">Email</label>
            <input type="email" class="form-control" name="email">
        </div>
        <div class="form-group">
            <label for="no_telp" class="control-label">No. Telepon</label>
            <input type="text" class="form-control" name="no_telp">
        </div>
        <div class="form-group">
            <label for="alamat" class="control-label">Alamat</label>
            <textarea class="form-control" name="alamat" rows="3"></textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="password" class="control-label">Password</label>
        <input type="password" class="form-control" id="passwordbaru" name="password">
        <input type="checkbox" onclick="show_hide_pwdbar()"> ShowPassword
        @error('password')
        <span class="text-danger d-block">{{ $message }}</span>
        @enderror
    </div>

    <!-- Button trigger modal -->
    <div class="modal-footer">
        <button type="submit" class="btn btn-danger waves-effect waves-light">Simpan</button>
    </div>
</form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div>
                                <!-- /.modal edit Akun -->
                                <div id="edit-modal" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                                <h4 class="modal-title">Edit Akun </h4>
                                            </div>

                                            <div class="modal-body">
                                                <!-- /.Form Modal edit Akun -->
                                                <form>
                                                    <div class="form-group">
                                                        <label for="username" class="control-label">Username</label>
                                                        <input type="text" class="form-control" id="username"
                                                            value="ackyras">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama" class="control-label">Nama Pemegang</label>
                                                        <input type="text" class="form-control" id="nama"
                                                            value="Ackyras Sibarani">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="Role" class="control-label">Role</label>
                                                        <input type="text" class="form-control" id="role" value="lshc">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password" class="control-label">Password</label>
                                                        <input type="password" class="form-control" id="password"
                                                            value="owner">
                                                        <input type="checkbox" onclick="show_hide_pwd()"> Show Password
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /. end Form Modal Akun Baru -->

                                            <!-- Button trigger modal -->
                                            <div class="modal-footer">
                                                <button type="button"
                                                    class="btn btn-danger waves-effect waves-light">Simpan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Table data -->
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Pemegang</th>
                                        <th>Role</th>
                                        <th class="text-nowrap">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->nama }}</td>
                                        <td><span class="label label-danger">{{ $user->role }}</span> </td>
                                        <td class="text-nowrap">
                                           
                                            <form action="{{ route('manajemen-akun.destroy', $user->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button href="{{ route('manajemen-akun.destroy', $user->id) }}"
                                                    data-toggle="tooltip" data-original-title="Hapus" class="btn"
                                                    style="background: #FFF" type="submit">
                                                    <i class="fa fa-close text-danger"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            Data akun masih kosong...
                                        </td>
                                    </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.container-fluid -->
            @include('partial.footer')
        </div>
        <!-- /#page-wrapper -->
    </div>

    <!-- /#JS.SHOW HIDE PASSWORD -->
    <script>
        function show_hide_pwd() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function show_hide_pwdbar() {
            var x = document.getElementById("passwordbaru");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

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

    <!-- dATA TABLE SCRIPT -->
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
    <script>
    $(document).ready(function () {
        // Menangani perubahan pada pemilihan role
        $('#rolebaru').change(function () {
            var role = $(this).val();
            
            // Sembunyikan semua field khusus
            $('#dokter-field').hide();
            $('#perawat-field').hide();
            $('#user-fields').hide();
            
            // Tampilkan field sesuai role yang dipilih
            if (role === 'dokter') {
                $('#dokter-field').show();
                // Ambil data dokter dari server
                $.ajax({
                    url: '{{ route("manajemen.dokter") }}/get-data',
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        var options = '<option value="">Pilih Dokter</option>';
                        $.each(data, function (index, dokter) {
                            options += '<option value="' + dokter.id + '">' + dokter.nama + '</option>';
                        });
                        $('#dokter_id').html(options);
                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching dokter data:', error);
                    }
                });
            } else if (role === 'perawat') {
                $('#perawat-field').show();
                // Ambil data perawat dari server
                $.ajax({
                    url: '{{ route("manajemen.perawat") }}/get-data',
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        var options = '<option value="">Pilih Perawat</option>';
                        $.each(data, function (index, perawat) {
                            options += '<option value="' + perawat.id + '">' + perawat.nama + '</option>';
                        });
                        $('#perawat_id').html(options);
                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching perawat data:', error);
                    }
                });
            } else if (role === 'owner' || role === 'staff') {
                $('#user-fields').show();
            }
        });

        // Ketika dokter dipilih, isi otomatis nama pemegang
        $('#dokter_id').change(function() {
            var dokterName = $('#dokter_id option:selected').text();
            if (dokterName !== "Pilih Dokter") {
                $('#namabaru').val(dokterName);
            }
        });

        // Ketika perawat dipilih, isi otomatis nama pemegang
        $('#perawat_id').change(function() {
            var perawatName = $('#perawat_id option:selected').text();
            if (perawatName !== "Pilih Perawat") {
                $('#namabaru').val(perawatName);
            }
        });
    });
</script>
</body>

</html>
