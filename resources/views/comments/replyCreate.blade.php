<form method="POST" class="reply-form" action="{{ route('reply.store') }}">
    {{ csrf_field() }}
    <textarea name="body" cols="60" rows="6" class="reply-form__body"></textarea>
    <input type="hidden" name="link_id" value="{{ $link->id }}">
    <input type="hidden" name="comment_id" value="{{ $comment->id }}"/>
</form>
