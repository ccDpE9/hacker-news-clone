@extends('main')

@section('content')

    @if (session()->has('success_message'))
        <div class="alert alert-success">
            {{ session()->get('success_message') }}
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <ul>
        <!-- $links->count() -->
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
