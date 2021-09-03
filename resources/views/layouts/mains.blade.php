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
        <!--<script src="./js/app.js" defer></script>-->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">

        <link href="./css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
        <link href="./css/components.css" rel="stylesheet" type="text/css">


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




    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
        <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>


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