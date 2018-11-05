<!DOCTYPE html>
<html lang="en">

    <head>
        @include('partials._head')
    </head>

    <body>

        @include ('partials._header')

        <main>

            @include('layout._sidebar')

            <section class="container">

                @yield('content')

            </section>
    
        </main>

        @include('partials._scripts')

    </body>

</html>
