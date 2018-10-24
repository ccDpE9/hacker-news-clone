@foreach ($comments as $comment)

    <ul>
        <li>{{ $comment->body }}
        @include ('comments.show', ['comments' => $comment->replies])
        </li>
    </ul>

@endforeach
