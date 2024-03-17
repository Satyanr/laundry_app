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

    <style>
        /*!
     * Load Awesome v1.1.0 (http://github.danielcardoso.net/load-awesome/)
     * Copyright 2015 Daniel Cardoso <@DanielCardoso>
     * Licensed under MIT
     */
        .la-ball-atom,
        .la-ball-atom>div {
            position: relative;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .la-ball-atom {
            display: block;
            font-size: 0;
            color: #fff;
        }

        .la-ball-atom.la-dark {
            color: #333;
        }

        .la-ball-atom>div {
            display: inline-block;
            float: none;
            background-color: currentColor;
            border: 0 solid currentColor;
        }

        .la-ball-atom {
            width: 32px;
            height: 32px;
        }

        .la-ball-atom>div:nth-child(1) {
            position: absolute;
            top: 50%;
            left: 50%;
            z-index: 1;
            width: 60%;
            height: 60%;
            background: #aaa;
            border-radius: 100%;
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            -o-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            -webkit-animation: ball-atom-shrink 4.5s infinite linear;
            -moz-animation: ball-atom-shrink 4.5s infinite linear;
            -o-animation: ball-atom-shrink 4.5s infinite linear;
            animation: ball-atom-shrink 4.5s infinite linear;
        }

        .la-ball-atom>div:not(:nth-child(1)) {
            position: absolute;
            left: 0;
            z-index: 0;
            width: 100%;
            height: 100%;
            background: none;
            -webkit-animation: ball-atom-zindex 1.5s 0s infinite steps(2, end);
            -moz-animation: ball-atom-zindex 1.5s 0s infinite steps(2, end);
            -o-animation: ball-atom-zindex 1.5s 0s infinite steps(2, end);
            animation: ball-atom-zindex 1.5s 0s infinite steps(2, end);
        }

        .la-ball-atom>div:not(:nth-child(1)):before {
            position: absolute;
            top: 0;
            left: 0;
            width: 10px;
            height: 10px;
            margin-top: -5px;
            margin-left: -5px;
            content: "";
            background: currentColor;
            border-radius: 50%;
            opacity: .75;
            -webkit-animation: ball-atom-position 1.5s 0s infinite ease, ball-atom-size 1.5s 0s infinite ease;
            -moz-animation: ball-atom-position 1.5s 0s infinite ease, ball-atom-size 1.5s 0s infinite ease;
            -o-animation: ball-atom-position 1.5s 0s infinite ease, ball-atom-size 1.5s 0s infinite ease;
            animation: ball-atom-position 1.5s 0s infinite ease, ball-atom-size 1.5s 0s infinite ease;
        }

        .la-ball-atom>div:nth-child(2) {
            -webkit-animation-delay: .75s;
            -moz-animation-delay: .75s;
            -o-animation-delay: .75s;
            animation-delay: .75s;
        }

        .la-ball-atom>div:nth-child(2):before {
            -webkit-animation-delay: 0s, -1.125s;
            -moz-animation-delay: 0s, -1.125s;
            -o-animation-delay: 0s, -1.125s;
            animation-delay: 0s, -1.125s;
        }

        .la-ball-atom>div:nth-child(3) {
            -webkit-transform: rotate(120deg);
            -moz-transform: rotate(120deg);
            -ms-transform: rotate(120deg);
            -o-transform: rotate(120deg);
            transform: rotate(120deg);
            -webkit-animation-delay: -.25s;
            -moz-animation-delay: -.25s;
            -o-animation-delay: -.25s;
            animation-delay: -.25s;
        }

        .la-ball-atom>div:nth-child(3):before {
            -webkit-animation-delay: -1s, -.75s;
            -moz-animation-delay: -1s, -.75s;
            -o-animation-delay: -1s, -.75s;
            animation-delay: -1s, -.75s;
        }

        .la-ball-atom>div:nth-child(4) {
            -webkit-transform: rotate(240deg);
            -moz-transform: rotate(240deg);
            -ms-transform: rotate(240deg);
            -o-transform: rotate(240deg);
            transform: rotate(240deg);
            -webkit-animation-delay: .25s;
            -moz-animation-delay: .25s;
            -o-animation-delay: .25s;
            animation-delay: .25s;
        }

        .la-ball-atom>div:nth-child(4):before {
            -webkit-animation-delay: -.5s, -.125s;
            -moz-animation-delay: -.5s, -.125s;
            -o-animation-delay: -.5s, -.125s;
            animation-delay: -.5s, -.125s;
        }

        .la-ball-atom.la-sm {
            width: 16px;
            height: 16px;
        }

        .la-ball-atom.la-sm>div:not(:nth-child(1)):before {
            width: 4px;
            height: 4px;
            margin-top: -2px;
            margin-left: -2px;
        }

        .la-ball-atom.la-2x {
            width: 64px;
            height: 64px;
        }

        .la-ball-atom.la-2x>div:not(:nth-child(1)):before {
            width: 20px;
            height: 20px;
            margin-top: -10px;
            margin-left: -10px;
        }

        .la-ball-atom.la-3x {
            width: 96px;
            height: 96px;
        }

        .la-ball-atom.la-3x>div:not(:nth-child(1)):before {
            width: 30px;
            height: 30px;
            margin-top: -15px;
            margin-left: -15px;
        }

        /*
     * Animations
     */
        @-webkit-keyframes ball-atom-position {
            50% {
                top: 100%;
                left: 100%;
            }
        }

        @-moz-keyframes ball-atom-position {
            50% {
                top: 100%;
                left: 100%;
            }
        }

        @-o-keyframes ball-atom-position {
            50% {
                top: 100%;
                left: 100%;
            }
        }

        @keyframes ball-atom-position {
            50% {
                top: 100%;
                left: 100%;
            }
        }

        @-webkit-keyframes ball-atom-size {
            50% {
                -webkit-transform: scale(.5, .5);
                transform: scale(.5, .5);
            }
        }

        @-moz-keyframes ball-atom-size {
            50% {
                -moz-transform: scale(.5, .5);
                transform: scale(.5, .5);
            }
        }

        @-o-keyframes ball-atom-size {
            50% {
                -o-transform: scale(.5, .5);
                transform: scale(.5, .5);
            }
        }

        @keyframes ball-atom-size {
            50% {
                -webkit-transform: scale(.5, .5);
                -moz-transform: scale(.5, .5);
                -o-transform: scale(.5, .5);
                transform: scale(.5, .5);
            }
        }

        @-webkit-keyframes ball-atom-zindex {
            50% {
                z-index: 10;
            }
        }

        @-moz-keyframes ball-atom-zindex {
            50% {
                z-index: 10;
            }
        }

        @-o-keyframes ball-atom-zindex {
            50% {
                z-index: 10;
            }
        }

        @keyframes ball-atom-zindex {
            50% {
                z-index: 10;
            }
        }

        @-webkit-keyframes ball-atom-shrink {
            50% {
                -webkit-transform: translate(-50%, -50%) scale(.8, .8);
                transform: translate(-50%, -50%) scale(.8, .8);
            }
        }

        @-moz-keyframes ball-atom-shrink {
            50% {
                -moz-transform: translate(-50%, -50%) scale(.8, .8);
                transform: translate(-50%, -50%) scale(.8, .8);
            }
        }

        @-o-keyframes ball-atom-shrink {
            50% {
                -o-transform: translate(-50%, -50%) scale(.8, .8);
                transform: translate(-50%, -50%) scale(.8, .8);
            }
        }

        @keyframes ball-atom-shrink {
            50% {
                -webkit-transform: translate(-50%, -50%) scale(.8, .8);
                -moz-transform: translate(-50%, -50%) scale(.8, .8);
                -o-transform: translate(-50%, -50%) scale(.8, .8);
                transform: translate(-50%, -50%) scale(.8, .8);
            }
        }

        /* Loading indicator styles */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            /* Semi-transparent black overlay */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            /* Make sure the loading overlay appears on top of other content */
        }

    </style>
    @livewireStyles
    @stack('css')
</head>

<body class="bg-light bg-gradient">

    <x-load />

    <x-nav-head />

    <div class="content mt-5 pt-2">
        @yield('content')
    </div>

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script>
        window.addEventListener('load', function() {
            var loadingOverlay = document.getElementById('loading-overlay');
            if (loadingOverlay) {
                loadingOverlay.style.display = 'none';
            }
        });
    </script>
    @livewireScripts
    @stack('js')
</body>

</html>
