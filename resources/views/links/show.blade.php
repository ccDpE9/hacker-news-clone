@extends('main')

@section('content')

    <a href="{{ $link->url }}"><p>{{ $link->title }}</p></a>
    <p>{{ $link->description }}</p>

@endsection
    
