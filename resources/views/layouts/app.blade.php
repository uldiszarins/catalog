<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ZAAO API</title>

    <!-- Scripts -->
    <script src="{{ secure_asset('js/app.js') }}" defer></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ secure_asset('vendor/fontawesome-free/css/all.min.css') }}">
</head>

<body>
    <div id="app">

        <div class=" navbar-light bg-white shadow-sm">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <a class="navbar-brand  ms-1" href="{{ url('/') }}">
                            Katalogs
                        </a>
                    </div>
                    <div class="col-md-6">
                        <ul class="nav justify-content-end">
                            <li class="nav-item">
                                <a class="nav-link disabled">


                                </a>
                            </li>
                            <li class="nav-item">

                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>


        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
