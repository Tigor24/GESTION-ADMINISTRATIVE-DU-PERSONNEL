<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>

    <!-- CSS AdminLTE -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/agent.css') }}">
    @stack('styles')
</head>

<script>
  document.querySelectorAll('.card-hover').forEach(card => {
    card.addEventListener('mousedown', () => {
      card.style.transform = 'scale(0.98)';
    });
    card.addEventListener('mouseup', () => {
      card.style.transform = 'scale(1)';
    });
    card.addEventListener('mouseleave', () => {
      card.style.transform = 'scale(1)';
    });
  });
</script>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        @include('layouts.navbar') <!-- Barre top -->
        @include('layouts.sidebar') <!-- Menu gauche -->

        <div class="content-wrapper p-3">
            @yield('content')
        </div>

    </div>

    <!-- JS AdminLTE -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
</body>

</html>
