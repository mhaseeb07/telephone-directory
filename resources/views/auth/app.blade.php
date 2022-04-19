<!DOCTYPE html>
<html>
<head>
    <title>User Panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{asset('front/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/waves.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/style.css')}}">
</head>
<body>
<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-4">
           <div class="card rounded-0">
               <div class="card-body">
                   @yield('content')
               </div>
           </div>
        </div>
    </div>
</div>
<script src="{{asset('front/js/jquery.js')}}"></script>
<script src="{{asset('front/js/bootstrap.js')}}"></script>
<script src="{{asset('front/js/waves.js')}}"></script>
<script src="{{asset('front/js/mask.js')}}"></script>
<script>
    Waves.attach('.waves-effect', ['waves-light'])
    $('.cnic').inputmask('9999999999999');
    $('.mobile').inputmask('03999999999');
</script>
</body>
</html>
