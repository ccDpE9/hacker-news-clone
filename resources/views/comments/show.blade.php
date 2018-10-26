@foreach ($comments as $comment)

    <div class="reply">
        <p>{{ $comment->body }}</p>
        @include ('comments.show', ['comments' => $comment->replies])
    </div>

@endforeach
