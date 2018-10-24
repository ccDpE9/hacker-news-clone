<form method="POST" class="comment-form" action="{{ route('comments.store') }}">
    {{ csrf_field() }}
    <textarea name="body" cols="60" rows="6" class="comment-form__body"></textarea>
    <input type="hidden" name="link_id" value="{{ $link->id }}">
    <br>
    <br>
    <input value="Add comment" class="comment-form__btn" type="submit">
</form>
