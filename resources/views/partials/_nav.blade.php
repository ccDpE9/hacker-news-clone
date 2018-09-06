<ul class="navbar clearfix">
    <li class="navbar__btn"><b>Hacker News Clone</b></li>
    <li class="navbar__btn"><a href="{{ route('links.create') }}">new</a></li>
    <li class="navbar__btn"><a href="#">comments</a></li>
    <li class="navbar__btn"><a href="#">show</a></li>
    <li class="navbar__btn"><a href="#">ssk</a></li>
    <li class="navbar__btn"><a href="#">jobs</a></li>
    <li class="navbar__btn"><a href="#">submit</a></li>
    
    <div class="navbar__auth">
        @if (auth()->user())
            <p>{{ Auth::user()->name }}</p>
        @else 
            <li class="navbar__btn navbar_auth--login"><a href="{{ route('login') }}">login</a></li>
        @endif
    </div>
</ul>
