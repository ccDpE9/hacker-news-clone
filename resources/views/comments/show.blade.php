@foreach ($comments as $comment)

    <div class="thread__reply comment">
        <span class="thread__reply--author">
            <a href="#">{{ $comment->user->name }}</a>
        </span>
        <span class="thread__reply--date">
            {{ $comment->created_at }}
        </span>
        <p class="thread__reply--body">{{ $comment->body }}</p>
        <p class="btn--reply">reply</p>
        @include ('comments.show', ['comments' => $comment->replies])
    </div>

@endforeach
