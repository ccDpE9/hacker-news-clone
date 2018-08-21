<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials._head')
</head>

<body>

    <div class="container">

        @include('partials._nav')

        @yield('content')

    </div>

</body>

</html>
