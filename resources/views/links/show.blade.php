@extends('main')

@section('content')

    <a href="{{ $link->url }}"><p>{{ $link->title }}</p></a>
    <p>{{ $link->description }}</p>
    <p>{{ $date }}</p>
    @include('comments.show', ['link_id' => $link->id])

@endsection
    
