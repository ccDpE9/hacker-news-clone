@extends('main')

@section('content')

    <ul>
        @foreach($links as $link)
            <div class="links">
                <li class="links__btn links__title">
                    <a href="{{ $link->url }}" target="_blank">{{ $link->title }}</a>
                </li>
                <li class="links__btn links__comments">
                    <a href="{{ route('links.show', $link->id) }}">Comments</a>
                </li>
                <li class="links__btn links__url">
                    <a href="{{ $link->url }}" target="_blank">{{ $link->url }}</a>
                </li>
                <li class="links__btn links__date">
                    <a href="{{ $link->url }}" target="_blank">{{ $link->created_at }}</a>
                </li>
                <li class="links__btn links_author">
                    <a href="{{ route('profile.show', $link->user()->first()->name) }}" target="_blank">{{ $link->user()->first()->name }}</a>
                </li>
            </div>
            
        @endforeach
    </ul>

@endsection
