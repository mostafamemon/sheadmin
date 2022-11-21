<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>Admin | She Collection</title>

        <link rel="icon" href="{{asset('images/favicon.png')}}" type="image/png">
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
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item" >
                      <div class="nav-link pointer">
                        <button class="btn btn-info btn-sm" onclick="force_refresh()" style="white-space: nowrap"><i class="ion ion-refresh"></i> Refresh</button>
                      </div>
                    </li>

                    <li class="nav-item dropdown" style="margin-left:-15px">
                        <div class="nav-link pointer force-toggle" data-toggle="dropdown">
 
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
                          
                        </div>
                    </li>
                </ul>
            </nav>

            <aside class="main-sidebar elevation-4 sidebar-dark-lightblue sidebar-nav">
                <!-- Brand Logo -->
                <a href="{{url('/')}}" class="brand-link">
                    <img src="{{asset('images/logo.png')}}" alt="AdminLTE Logo" class="brand-image">
                </a>

                <a href="{{url('/')}}" class="brand-link brand-icon collapse">
                    <img src="{{asset('images/logo.png')}}" alt="AdminLTE Logo" class="brand-image">
                </a>

                <!-- Sidebar -->
                <div class="sidebar">

                <!-- Sidebar Menu -->
                @include('layouts.nav')
                <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            {{ $slot }}

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
