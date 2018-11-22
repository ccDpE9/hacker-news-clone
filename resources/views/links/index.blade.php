@extends('main')

@section('content')

    @if (session()->has('success_message'))
        <div class="alert alert-success">
            {{ session()->get('success_message') }}
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- $links->count() -->
    @foreach($links as $link)
        <div class="link" data-linkid="{{ $link->id }}">
            <div class="link__info">
                <a class="link__btn link__title" href="{{ $link->url }}" target="_blank"><span class="num">{{ $loop->iteration }}. {{ $link->title }}</a>
                <div class="link__meta">
                    <span>
                        <img src="/img/like.svg" class="icon" />
                    </span>
                    <span>
                        <img src="/img/avatar.svg" class="icon"/>
                        <a class="link__btn link__author" 
                           href="{{ route('profile.show', $link->user()->first()->name) }}" 
                           target="_blank">
                           {{ $link->user()->first()->name }}
                        </a>
                    </span>
                    <span>
                        <img src="/img/time.svg" class="icon" />
                        {{ $link->created_at }}
                    </span>
                    <span>
                        <a class="link__btn link__url" href="{{ $link->url }}" target="_blank">{{ $link->baseUrl() }}</a>
                    </span>
                    <span>
                        {{ $link->comments_count }}
                    </span>
                </div>
            </div>
            <div class="link__social">
                <a class="link__btn link__comments" href="{{ route('links.show', $link->id) }}">
                    <i class="fa fa-comment-o fa-lg icon--social"></i>
                </a>
                <a href="#">
                    <i class="fa fa-share-alt fa-lg icon--social" aria-hidden="true"></i>
                </a>
                <a class="link__btn link__upvote" href="#" class="link__upvote--btn">
                    <i class="fa fa-star-o fa-lg icon--social"></i>
                </a>
            </div>
        </div>
    @endforeach

    {{ $links->links() }}

    <script>
        var url = '{{ route('upvotes.store') }}';
    </script>

@endsection
