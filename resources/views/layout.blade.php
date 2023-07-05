<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <title>ZeZnajomym NAJLEPIEJ</title>
    @livewireStyles
</head>

<body>
    <div class="container">
        <h1 class="form-title">
            ZeZnajomym.pl <br> BETA
        </h1>
        @yield('content')
    </div>
    @livewireScripts
</body>

</html>
