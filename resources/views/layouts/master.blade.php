<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Webwev | POS</title>

    <link rel="icon" href="{{asset('img/favicon.png')}}" type="image/png">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    @livewireStyles

    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
    <script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <script src="{{asset('js/adminlte.js')}}"></script>
    <script src="js/app.js"></script>
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

        <ul class="navbar-nav">
            <li class="nav-item">
                <div class="nav-link pointer" id="pushmenu" data-widget="pushmenu" role="button"><i class="fas fa-bars" style="padding-top:4px"></i></div>
            </li>
            @if(auth()->user()->roles != 1)
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/sales" class="nav-link">Sales</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/purchase" class="nav-link">Purchase</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/return" class="nav-link">Return</a>
                </li>
            @endif
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item" @if(auth()->user()->roles == 1) style="margin-top:-8px;" @else style="margin-top:-4px;" @endif>
                <div class="nav-link pointer">
                    <button class="btn btn-info btn-sm" onclick="force_refresh()" style="white-space: nowrap"><i class="ion ion-refresh"></i> Refresh</button>
                </div>
            </li>

            <li class="nav-item dropdown" style="margin-left:-15px">
                <div class="nav-link pointer force-toggle" data-toggle="dropdown" @if(auth()->user()->roles == 1) style="margin-top:-14px;" @else style="margin-top:-11px;" @endif>
                    @if(auth()->user()->avatar == "")
                        <img src="{{asset('img/user-placeholder.jpg')}}" class="img-circle elevation-2" style="height:42px;width:42px" alt="User Image" height="42">
                    @else
                        <img src="{{asset('storage/'.auth()->user()->avatar)}}" class="img-circle elevation-2" style="height:42px;width:42px" alt="User Image" height="42">
                    @endif
                </div>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" >
                    <div class="dropdown-divider"></div>
                    <a href="/profile">
                        <div class="dropdown-item">
                            <i class="far fa-user mr-2" style="color:green"></i> My profile
                            <span class="float-right text-muted text-sm"></span>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    @livewire('logout')
                </div>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar elevation-4 sidebar-dark-lightblue sidebar-nav">
        <!-- Brand Logo -->
        <a href="{{url('/')}}" class="brand-link">
            <img src="{{asset('img/webwev-logo.png')}}" alt="AdminLTE Logo" class="brand-image">
        </a>

        <a href="{{url('/')}}" class="brand-link brand-icon collapse">
            <img src="{{asset('img/webwev-icon.png')}}" alt="AdminLTE Logo" class="brand-image">
        </a>

        <!-- Sidebar -->
        <div class="sidebar">

            <!-- Sidebar Menu -->
            @include('layouts.nav')
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    @yield('content')

    <footer class="main-footer text-sm">
        <strong>Copyright &copy; 2021 <a href="http://webwev.com" target="_blank">Webwev</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0
        </div>
    </footer>
</div>

<script type="text/javascript">
    document.addEventListener("turbolinks:before-cache", function() {
        const flash_message_element = document.querySelector(".flash")
        if (flash_message_element) {
            flash_message_element.remove()
        }
    });

    function force_refresh() {
        location.reload();
    }

    new Pikaday({ field: document.getElementById('datepicker1') })
    new Pikaday({ field: document.getElementById('datepicker2') })
</script>
</body>
</html>
