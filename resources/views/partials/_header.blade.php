<header class="header-wrapper clearfix">

    <div class="logo">
        <img src="{{ asset('img/logo.png') }}" alt="Hacker news logo" class="logo__image"/>
        <p class="logo__name">
            Search
            <br>
            Hacker News
        </p>
    </div>

    <div class="search-wrapper">
        <ion-icon class="search-form__icon" src="{{ asset('img/search.svg') }}"></ion-icon>
        <form action="{{ route('links.search') }}" method="GET" class="search-form">
            <input type="text" name="query" id="query" class="search-form__input" value="{{ request()->input('query') }}" placeholder="Stories, polls, jobs, comments">
        </form>
    </div>

</header>
