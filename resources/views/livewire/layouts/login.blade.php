<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="x-ua-compatible" content="ie=edge">

      <title>Admin | She Collection</title>

      <link rel="icon" href="{{asset('images/favicon.png')}}" type="image/png">

      <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
      @livewireStyles
      @livewireScripts
      <script src="js/app.js"></script>
  </head>

  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo" style="margin-bottom:30px">
        <img src="{{asset('images/logo.png')}}" height="60"/>
      </div>

        {{ $slot }}

      <div class="icheck-primary text-center">
        <a href="http://3wDevs.com" target="_blank" class="forget-password-link"><span style="color:#3C8DBC">Powered by</span> 3wDevs Solution</a>
      </div>
    </div>

  </body>
</html>