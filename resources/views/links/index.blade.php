@extends('main')

@section('content')

    @foreach($links as $link)
        <ul>
            <li>
                <a href="{{ route('show', $link->id) }}">Comments</a>
            </li>
            <li>
                <a href="{{ $link->url }}">{{ $link->url }}</a>
            </li>
        </ul>
    @endforeach 

@endsection
