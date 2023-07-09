@extends('components.layout.layout')
@section('content')
<div class="bg-light m-auto w-50">
<form class="form" method="post">
    @csrf

    Name:<input type="text" placeholder="name" name="name">
    <br>
    Email:<input type="text" placeholder="email" name="email">
    <br>
    <button type='submit' name="submit">Add</button>
{{--    @if(session('success'))--}}
{{--        <div class="alert alert-success">--}}
{{--            {{ session('success') }}--}}
{{--        </div>--}}
{{--    @endif--}}
{{--    @if(session('error'))--}}
{{--        <div class="alert alert-danger">--}}
{{--            {{ session('error') }}--}}
{{--        </div>--}}
{{--    @endif--}}
  <br>
</form>

    <table class="border">

    @foreach($posts as $post)
            <tr class="border">
                <td class="border">{{$post->id }}</td>
                <td class="border">{{$post->name}}</td>
                <td class="border">{{$post->email}}</td>
                <td class="border">
                    <form action="{{route('post.delete',['id' => $post->id])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="delete">Delete</button>
                    </form>
                </td>
                <td><a href="/update/{{$post->id}}"> <button type="submit" name="update">update</button></a> </td>
            </tr>
        @endforeach

    </table>




@endsection
