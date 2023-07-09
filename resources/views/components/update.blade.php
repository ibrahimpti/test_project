@extends('components.layout.layout')
@section('content')
    <form method="post" action="{{ route('post.update', ['id' => $post->id]) }}">
        @csrf
        @method('PUT')
        Name: <input type="text" name="uname" value="{{ $post->name }}">
        <br>
        Email: <input type="text" name="uemail" value="{{ $post->email }}">
        <br>
        <button type="submit" name="save">Save Change</button>
    </form>
@endsection
