<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>CoreUI Free Bootstrap Admin Template</title>
    <!-- Icons-->
    <link href="/admin/src/icons/css/coreui-icons.min.css" rel="stylesheet">
    <link href="/admin/src/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
    <link href="/admin/src/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/admin/src/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- Main styles for this application-->
    <link href="/admin/src/css/style.css" rel="stylesheet">
    <link href="/admin/src/vendors/pace-progress/css/pace.min.css" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        // Shared ID
        gtag('config', 'UA-118965717-3');
        // Bootstrap ID
        gtag('config', 'UA-118965717-5');
    </script>
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">

@include('admin.includes.header')

<div class="app-body">

@include('admin.includes.sidebar')

    <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item">
                <a href="#">Admin</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>
            <!-- Breadcrumb Menu-->
            <li class="breadcrumb-menu d-md-down-none">
                <div class="btn-group" role="group" aria-label="Button group">
                    <a class="btn" href="#">
                        <i class="icon-speech"></i>
                    </a>
                    <a class="btn" href="./">
                        <i class="icon-graph"></i>  Dashboard</a>
                    <a class="btn" href="#">
                        <i class="icon-settings"></i>  Settings</a>
                </div>
            </li>
        </ol>

        <div class="container-fluid">

            @if(Session::has('message'))
            <div class="row alert alert-info">
                <div >
                    {{ Session::get('message') }}
                </div>
            </div>
            @endif

            <div class="animated fadeIn">
                <div class="row">

                 </div>

                @yield('content')

            </div>
        </div>
    </main>
    <aside class="aside-menu">

    </aside>


</div>


<footer class="app-footer">
    <div>
        <a href="https://coreui.io">CoreUI</a>
        <span>&copy; 2018 creativeLabs.</span>
    </div>
    <div class="ml-auto">
        <span>Powered by</span>
        <a href="https://coreui.io">CoreUI</a>
    </div>
</footer>


<!-- CoreUI and necessary plugins-->
<!-- <script src="/admin/src/jquery/dist/jquery.min.js"></script> -->

<script src="/js/jquery-1.12.0.min.js"></script>


<script src="/admin/src/popper.js/dist/umd/popper.min.js"></script>
<script src="/admin/src/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/admin/src/pace-progress/pace.min.js"></script>
<script src="/admin/src/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
<script src="/admin/src/coreui/dist/js/coreui.min.js"></script>
<!-- Plugins and scripts required by this view-->
<script src="/admin/src/js/chart.js/dist/Chart.min.js"></script>
<script src="/admin/src/coreui-plugin-chartjs-custom-tooltips/dist/js/custom-tooltips.min.js"></script>
<script src="js/main.js"></script>


@yield('pageLevelJS')


</body>
</html>
