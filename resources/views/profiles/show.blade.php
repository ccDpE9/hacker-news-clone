@extends('main')

@section('content')

    <p>{{ $profile->name }}</p>
    <a href="{{ route('profile.links', $profile->name) }}">submissions</a>

@endsection
