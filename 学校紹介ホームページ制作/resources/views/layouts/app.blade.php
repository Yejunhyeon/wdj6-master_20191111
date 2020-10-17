<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="msapplication-tap-highlight" content="no">

    <!-- SEO -->
    <meta name="description" content="{{ config('project.description') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href ="{{ asset('css/app2.css') }}" />

    @yield('style')

    <!-- Scripts -->
    <script>
    window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?>
    </script>
</head>

<body id="app-layout">

    @include('layouts.partial.navigation')
    <!-- main_container라는 id 꼭 필요 !! -->
    <div class="container" id = main_container>
        @include('flash::message')

        @yield('content')
    </div>

    @include('layouts.partial.footer')

    <!-- Scripts -->
    <script src="{{ elixir('js/app.js') }}"></script>
    @yield('script')

    <script>
    
    </script>

</body>

</html>