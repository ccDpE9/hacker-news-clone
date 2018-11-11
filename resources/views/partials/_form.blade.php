<form class="link-form" method="POST" action="{{ route('links.store') }}">
    {{ csrf_field() }}

    <p class="link-form__input--error">{{ $errors->first('title') }}</p>
    <input type="text" class="link-form__title link-form__input" name="title" placeholder="Title..." required value="{{ $link->title or old('title') }}" />
    
    <p class="link-form__input--error">{{ $errors->first('url') }}</p>
    <input type="text" class="link-form__url link-form__input" name="url" placeholder="Url..." required value="{{ $link->url or old('url') }}"/>

    <p class="link-form__input--error">{{ $errors->first('description') }}</p>
    <textarea class="link-form__input link-form__description" name="description" placeholder="Description...">{{ $link->description or old('description') }}</textarea>
    <button type="submit" class="link-form__btn">Create</button>
</form>
