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

    <div class="comments">
        @foreach ($comments as $comment)
            <div class="thread">
                <div class="comment">
                    <span class="comment__author">
                        <a href="#">{{ $comment->user->name }}</a>
                    </span>
                    <span class="comment__date">
                        {{ $comment->created_at }}
                    </span>
                    <p class="comment__body">{{ $comment->body }}</p>
                    <div class="comment__social">
                        <span><a class="btn--reply" href="#">Reply</a></span>
                        <span><a class="btn--share" href="#">Share</a></span>
                        <span><a class="btn--save" href="#">Save</a></span>
                        @can('update', $comment)
                            <span><a class="btn--edit" href="#">Edit</a></span>
                        @else
                            <span><a class="btn--report" href="#">Report</a></span>
                        @endcan
                    </div>
                    <div class="comment-reply">
                        @include('comments.replyCreate', ['comment' => $comment])
                    </div>
                    @include ('comments.show', ['comments' => $comment->replies])
                </div>
            </div>
        @endforeach
    </div>

@endsection

