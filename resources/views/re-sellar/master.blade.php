<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('/assets/') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="{{ asset('/assets/') }}/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('/assets/') }}/css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

    @include('re-sellar.includes.header')

<div id="wrapper">

    <!-- Sidebar -->
    @include('re-sellar.includes.sidebar')

    <div id="content-wrapper">

        @yield('content')
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        @include('re-sellar.includes.footer')

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
{{--<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--    <div class="modal-dialog" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>--}}
{{--                <button class="close" type="button" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true">×</span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>--}}
{{--            <div class="modal-footer">--}}
{{--                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>--}}
{{--                <a class="btn btn-primary" href="login.html">Logout</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('/assets/') }}/vendor/jquery/jquery.min.js"></script>
<script src="{{ asset('/assets/') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('/assets/') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugin JavaScript-->
<script src="{{ asset('/assets/') }}/vendor/chart.js/Chart.min.js"></script>
<script src="{{ asset('/assets/') }}/vendor/datatables/jquery.dataTables.js"></script>
<script src="{{ asset('/assets/') }}/vendor/datatables/dataTables.bootstrap4.js"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('/assets/') }}/js/sb-admin.min.js"></script>

<!-- Demo scripts for this page-->
<script src="{{ asset('/assets/') }}/js/demo/datatables-demo.js"></script>
<script src="{{ asset('/assets/') }}/js/demo/chart-area-demo.js"></script>

</body>

</html>
