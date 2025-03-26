
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="https://www.rosenivara.se/public/assets/images/favicon2.png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="home_url" content="{{ url('') }}">
    <title>Rosen i Vara &#8211; Bra boende i Vara</title>    
    <!-- Scripts -->
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">    
   
    <link rel="shortcut icon" href="{!! url('public/assets/images/logo-npc.png') !!}" />    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">


    <!-- Font awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>

    <!-- Custom styles for this template -->
    <link href="{!! url('public/assets/css/style.css') !!}" rel="stylesheet">
    <link href="{!! url('public/assets/css/datatables/jquery.datatables.min.css') !!}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <link href="{!! url('public/multi-select/css/multi-select.css')!!}" rel="stylesheet" />

    <!-- <link href="{!! url('public/assets/css/jquery-ui.css') !!}" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    
    <link rel="shortcut icon" href="{!! url('public/assets/images/logo-npc.png') !!}" />


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{!! url('public/assets/js/jquery.js') !!}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
    <script src="{!! url('public/assets/js/dataTables/datatables.min.js') !!}"></script>
    <script src="{!! url('public/assets/js/bootstrap.min.js') !!}"></script>

    <!-- <script src="js/smooth-scroll-window-v1.0.0.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <!-- <script src="{!! url('public/assets/js/jquery-ui.js') !!}"></script> -->
    <script src="{!! url('public/assets/js/jquery-ui.js') !!}"></script>
    
    <script src="{!! url('public/assets/js/main.js') !!}"></script>

    @include('layouts.includes.global-style')
   
</head>








<body>
    <div id="loader" class="lds-dual-ring hidden overlay"></div>
       
    @yield('content')
        
    
</body>
</html>

@yield('app-script')
