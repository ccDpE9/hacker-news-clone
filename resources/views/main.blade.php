<!DOCTYPE html>
<html lang="en">

    <head>
        @include('partials._head')
    </head>

    <body>

        @include ('partials._header')

        <div class="container">

            @include('partials._nav')

            @yield('content')

        </div>

        @include('partials._scripts')

    </body>

</html>
