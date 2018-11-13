@foreach ($comments as $comment)

    <div class="link__reply comment">
        <span class="link__reply--author">
            <a href="#">{{ $comment->user->name }}</a>
        </span>
        <span class="link__reply--date">
            {{ $comment->created_at }}
        </span>
        <p class="link__reply--body">{{ $comment->body }}</p>
        <div>
            @can('update', $comment)
                <span class="comment__reply"><a href="#">Reply</a></span>
            @cannot('update', $comment)
                <span class="comment__report"><a href="#">Report</a></span>
            @endcan
            <span class="comment__share">Share</span>
            <span class="comment__save">Save</span>
        </div>
        @include ('comments.show', ['comments' => $comment->replies])
    </div>

@endforeach
