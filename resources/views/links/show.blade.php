@extends('main')

@section('content')

    <a href="{{ $link->url }}"><p>{{ $link->title }}</p></a>
    <div>
        <span>{{ $link->user->name }}</span>
        <span>{{ $link->created_at }}</span>
    </div>
    <p>{{ $link->description }}</p>

    @can('update', $link)
        <span><a href="{{ route('links.edit', $link) }}">Edit</a></span>
    @elsecannot('update', $link)
        <span><a href="#">Report</a></span>
    @endcan

    @include('comments.create', ['link_id' => $link->id])

    <hr>

    @foreach ($comments as $comment)
        <div class="thread">
            <div class="thread__comment comment">
                <span class="thread__comment__author">
                    <a href="#">{{ $comment->user->name }}</a>
                </span>
                <span class="thread__comment__date">
                    {{ $comment->created_at }}
                </span>
                <p class="thread__comment__body">{{ $comment->body }}</p>
                <span class="btn--reply">Reply</span>
                <span><a href="#">Share</a></span>
                <span><a href="#">Save</a></span>
                @can('update', $comment)
                    <span><a href="#">Edit</a></span>
                @elsecannot('update', $comment)
                    <span><a href="#">Report</a></span>
                @endcan
            </div>
            @include ('comments.show', ['comments' => $comment->replies])
        </div>
    @endforeach

@endsection
    
