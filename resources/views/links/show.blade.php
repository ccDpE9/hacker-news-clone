@extends('main')

@section('content')

    <a href="{{ $link->url }}"><p>{{ $link->title }}</p></a>
    <p>{{ $link->description }}</p>
    <p>{{ $date }}</p>
    @include('comments.create', ['link_id' => $link->id])

    @foreach ($comments as $comment)
        <div class="comment">
            <p>{{ $comment->body }}</p>
            @include ('comments.show', ['comments' => $comment->replies])
        </div>
    @endforeach

@endsection
    
