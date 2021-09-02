<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
    <!--<script src="http://localhost/video-webcam/js/app.js" defer></script>-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">

    <link href="./css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="./css/components.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">



    <!-- /global stylesheets -->

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="./assets/css/font-awesome.min.css">
    <!-- Lineawesome CSS -->
    <link rel="stylesheet" href="./assets/css/line-awesome.min.css">
    <!-- Chart CSS -->


    <!-- Datatable CSS -->
    <link rel="stylesheet" href="./assets/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="./assets/plugins/morris/morris.css">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="./assets/css/select2.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="./assets/css/bootstrap-datetimepicker.min.css">


    <!-- Core JS files -->
    <script type="text/javascript" src="./js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="./js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="./js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->


    <!-- Theme JS files -->

    <script type="text/javascript" src="./js/plugins/pickers/datepicker.js"></script>

    <!-- Bootstrap Core JS -->
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>

    <!-- Slimscroll JS -->
    <script src="./assets/js/jquery.slimscroll.min.js"></script>

    <!-- Chart JS -->
    <script src="./assets/plugins/morris/morris.min.js"></script>
    <script src="./assets/plugins/raphael/raphael.min.js"></script>
    <!-- Select2 JS -->
    <script src="./assets/js/select2.min.js"></script>

    <!-- Datetimepicker JS -->
    <script src="./assets/js/moment.min.js"></script>
    <script src="./assets/js/bootstrap-datetimepicker.min.js"></script>

    <!-- Custom JS -->
    <script src="./assets/js/app.js"></script>

    <!--<script type="text/javascript" src="/js/pages/dashboard.js"></script>-->
    <!-- /theme JS files -->

    <!-- Datatable JS -->
    <script src="./assets/js/jquery.dataTables.min.js"></script>
    <script src="./assets/js/dataTables.bootstrap4.min.js"></script>


</head>

<body>
    <!-- Main Wrapper -->

        <!-- END Sidebar -->
        <!-- Page Wrapper -->


            <!-- Page Content -->
            <div class="content container-fluid">

                @yield('content')
            </div>
            <!-- /page container -->
       
        <!-- Page Wrapper -->
</body>

</html>