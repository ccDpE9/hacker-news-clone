@extends('main')

@section('content')

    <a href="{{ $link->url }}"><p>{{ $link->title }}</p></a>
    <p>{{ $link->description }}</p>
    <p>{{ $date }}</p>
    @include('comments.create', ['link_id' => $link->id])

    @include ('comments.show', ['comments' => $comments])

@endsection
    
