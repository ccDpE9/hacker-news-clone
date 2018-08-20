@extends('main')

@section('content')

    @foreach($links as $link)
        <ul>
            <li>
                <a href="{{ route('links.show', $link->id) }}">Comments</a>
            </li>
            <li>
                <a href="{{ $link->url }}" target="_blank">{{ $link->url }}</a>
            </li>
        </ul>
    @endforeach 

@endsection
