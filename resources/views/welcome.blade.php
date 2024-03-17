<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Styles -->
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        html {
            line-height: 1.15;
            -webkit-text-size-adjust: 100%
        }

        body {
            margin: 0
        }

        a {
            background-color: transparent
        }

        [hidden] {
            display: none
        }

        html {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            line-height: 1.5
        }

        *, :after, :before {
            box-sizing: border-box;
            border: 0 solid #e2e8f0
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        svg, video {
            display: block;
            vertical-align: middle
        }

        video {
            max-width: 100%;
            height: auto
        }

        .bg-gray-100 {
            --bg-opacity: 1;
            background-color: #f7fafc;
            background-color: rgba(247, 250, 252, var(--bg-opacity))
        }

        .flex {
            display: flex
        }

        .justify-center {
            justify-content: center
        }

        .h-16 {
            height: 4rem
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto
        }

        .max-w-6xl {
            max-width: 72rem
        }

        .min-h-screen {
            min-height: 100vh
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem
        }

        .pt-8 {
            padding-top: 2rem
        }

        .relative {
            position: relative
        }

        .text-gray-700 {
            --text-opacity: 1;
            color: #4a5568;
            color: rgba(74, 85, 104, var(--text-opacity))
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .w-auto {
            width: auto
        }

        @media (min-width: 640px) {

            .sm\:items-center {
                align-items: center
            }

            .sm\:h-20 {
                height: 5rem
            }

            .sm\:px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem
            }

            .sm\:pt-0 {
                padding-top: 0
            }
        }

        @media (min-width: 1024px) {
            .lg\:px-8 {
                padding-left: 2rem;
                padding-right: 2rem
            }
        }

        @media (prefers-color-scheme: dark) {

            .dark\:bg-gray-900 {
                --bg-opacity: 1;
                background-color: #1a202c;
                background-color: rgba(26, 32, 44, var(--bg-opacity))
            }
        }
    </style>

</head>
<body class="antialiased">
<div class="flex items-top justify-center bg-gray-100 dark:bg-gray-900 py-4 sm:pt-0">
    <div>
        <div class="mb-3">
            <div class="flex justify-center pt-8 sm:pt-0">
                <img style="    width: 150px;height: 150px;border-radius: 50%;object-fit: cover;" src="/dug.jpg" alt="">
            </div>
            <form action="{{route('pars')}}" method="POST" class="flex row row-cols-lg-auto g-3 align-items-center pt-8">
                    @csrf
                <div class="col-10">
                    <label class="visually-hidden" for="inlineFormInputGroupUsername">Имя пользователя</label>
                    <div class="input-group">
                        <div class="input-group-text"><svg fill="#000000" height="15px" width="15px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M278.718,0C150.086,0,45.435,104.65,45.435,233.282c0,55.642,19.592,106.789,52.228,146.928L0,477.872L34.128,512 l97.663-97.663c40.137,32.635,91.284,52.228,146.926,52.228C407.35,466.565,512,361.914,512,233.282S407.35,0,278.718,0z M278.718,418.299c-102.018,0-185.017-82.999-185.017-185.017S176.699,48.265,278.718,48.265s185.017,82.999,185.017,185.017 S380.736,418.299,278.718,418.299z"></path> </g> </g> </g></svg></div>
                        <input type="text"
                               name="text"
                               value="{{$text ?? ''}}"
                               class="form-control"
                               id="inlineFormInputGroupUsername"
                               placeholder="Имя пользователя">
                    </div>
                </div>

                <div class="col-2">
                    <button type="submit" class="btn btn-primary">Поиск</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="d-flex flex-column" style="margin: 0 20px;">

    @if(isset($data))
        <b>TABLETKA.BY</b>

    @foreach($data as $key => $item)
            @if($item)<p>Стр: {{$key - 1}}</p>@endif
            @foreach($item as $i)
                <p>{!! str_replace($text ?? strtolower($text) ?? strtoupper($text) ?? ucfirst($text), "<b style='color: white; background: red'>$text</b>", $i); !!}</p>
                <hr/>
            @endforeach
        @endforeach
    @endif
</div>


</body>

<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        min-width: 480px;
    }

    @media (max-width: 900px) {
        table {
            min-width: 100vw;
        }
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        max-width: 200px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }

    .t-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .filter {
        display: flex;
        flex-direction: column;
    }

    .filter span {
        margin: 0;
        cursor: pointer;
    }
    hr {
        margin: 1rem 0;
        color: inherit;
        background-color: currentColor;
        border: 0;
        opacity: 0.25;
    }
</style>
</html>
