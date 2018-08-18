@extends('main')

@section('content')

    <section class="create-link">

        {{ Form::open([
            'route' => 'link.store',
            'class' => 'link-form']) }}

            {{ Form::text(
                'title',
                null,
                ['placeholder' => 'Title...'],
                ['class' => 'link-form__title']) }}

            {{ Form::text(
                'url',
                null,
                ['placeholder' => 'Url..'],
                ['class' => 'link-form__url']) }}

            {{ Form::textarea(
                'description',
                null,
                ['placeholder' => 'Text...'],
                ['class' => 'link-form__description']) }}
    
            {{ Form::submit('Create') }}

        {{ Form::close() }}

    </section>
