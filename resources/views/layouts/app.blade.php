<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laundry - SMKN 1 Ciamis</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="/summernote/summernote-lite.min.css" rel="stylesheet">
    <script src="/summernote/summernote-lite.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <style>
        html,
        body {
            height: 100vh;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        :root::-webkit-scrollbar {
            display: none;
        }

        :root {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .content {
            flex: 1 0 auto;
        }

        footer {
            flex-shrink: 0;
            margin-top: auto;
            background-color: #0168fa;
        }

        .navbar-collapse {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .navbar-toggler-icon {
            filter: invert(1);
        }
    </style>
    @livewireStyles
    @stack('css')
</head>

<body class="bg-light bg-gradient">
    <nav class="navbar fixed-top navbar-expand-lg" style="background-color: #2F5296 ">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('login') }}">
                {{-- <img src="/image/brand.png" alt="Logo" width="36" height="36"> --}}
                <span class="text-white">
                    SMKN 1 Ciamis Laundry
                </span>
            </a>
            <div class="row me-2" style="margin-left: auto;">
                <div class="col me-2" style="margin-left: auto;">
                    <a href="#" class="btn btn-outline-light border-0" type="button">
                        <i class="fas fa-home"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>


    <div class="content mt-5 pt-5">
        @yield('content')
    </div>

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    @livewireScripts
    @stack('js')
</body>

</html>
