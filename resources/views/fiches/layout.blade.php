<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link href="{{ asset('assets/vendor/fonts/circular-std/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/libs/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/charts/chartist-bundle/chartist.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/charts/morris-bundle/morris.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/charts/c3charts/c3.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icon-css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/tailwind.min.css')}}">

    @if($type=='supervision')
    <title>Fiche de supervision de l'agent {{ $agent->nom }} {{ $agent->prenom }} | {{ now() }} </title>
    @endif
        @if($type=='controle')
    <title>Fiche de controle de l'agent {{ $agent->nom }} {{ $agent->prenom }} | {{ now() }}</title>
    @endif
        @if($type=='terrain')
    <title>Fiche de terrain de l'agent {{ $agent->nom }} {{ $agent->prenom }} | {{ now() }}</title>
    @endif
</head>
    @yield('tab')
    <script src="{{asset('assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script>
    <!-- bootstap bundle js -->
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
    <!-- slimscroll js -->
    <script src="{{asset('assets/vendor/slimscroll/jquery.slimscroll.js')}}"></script>
    <!-- main js -->
    <script src="{{asset('assets/libs/js/main-js.js')}}"></script>
    <!-- chart chartist js -->
    <script src="{{ asset('assets/vendor/charts/chartist-bundle/chartist.min.js')}}"></script>
    <!-- sparkline js -->
    <script src="{{ asset('assets/vendor/charts/sparkline/jquery.sparkline.js')}}"></script>
    <!-- morris js -->
    <script src="{{ asset('assets/vendor/charts/morris-bundle/raphael.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/charts/morris-bundle/morris.js')}}"></script>
    <!-- chart c3 js -->
    <script src="{{ asset('assets/vendor/charts/c3charts/c3.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/charts/c3charts/d3-5.4.0.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/charts/c3charts/C3chartjs.js')}}"></script>
    <script src="{{ asset('assets/libs/js/dashboard-ecommerce.js')}}"></script>
    <script>
window.print();
    </script>
</body>
</html>