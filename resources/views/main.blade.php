<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('ui_dashboard/assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('ui_dashboard/assets/img/favicon.png') }}">
    <title>Project Management</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{ asset('ui_dashboard/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('ui_dashboard/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link href="{{ asset('ui_dashboard/assets/css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

{{-- SIDEBAR --}}
@include ('layout.sidebar')
{{-- AKHIR SIDEBAR --}}

{{-- Header --}}
@include ('layout.header')
{{-- AKHIR Header --}}

@yield ('content')

{{-- FOOTER --}}
@include ('layout.footer')
{{-- AKHIR FOOTER --}}

</body>

</html>
