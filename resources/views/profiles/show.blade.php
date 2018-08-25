@extends('main')

@section('content')

    <p>{{ $profile->name }}</p>
    @foreach ($links as $link )
        <a href="{{ route('links.show', $link->id) }}">{{ $link-title }}</a>
    @endforeach

@endsection
