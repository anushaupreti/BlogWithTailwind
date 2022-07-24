@extends('layouts.app')

@section('content')
<div class="w-4/5 m-auto text-center">
  <div class="py-15 border-b border-gray-200">
    <h1 class="text-6xl">
      Blog Posts
    </h1>
  </div>
</div>
@if (session()->has('message'))
    <div class="w-4/6 m-auto mt-10 pl-2">
      <p class="w-1/6 mb-4 text-gray-50 bg-green-500 rounded-2xl py-4">
          {{ session()-> get('message')}}
      </p>
    </div>
@endif

@if (Auth::check())
    <div class="pt-15 w-4/5 m-auto">
      <a href="/blog/create" class="bg-blue-500 uppercase bg-transparent text-xs text-gray-100 font-extrabold py-3 rounded-3xl px-5">
        Create Post
      </a>
    </div>
@endif

@foreach ($posts as $post )
<div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-15 border-b border-gray-200">
  <div>
    <img src="{{ asset('images/'. $post->image_path)}}" width="700" alt="this is blog-img">
  </div>
  <div>
    <h2 class="text-gray-700 font-bold text-5xl pb-4">
      {{$post-> title}}
    </h2>
    <span class="text-gray-500">
      By <span class="font-bold italic text-gray-800">{{$post->user->name}}</span>, Created on {{date('JS M Y', strtotime ($post->updated_at))}}
    </span>
    <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
     {{$post->description}}
    </p>
    <a href="/blog/{{ $post->slug }}" class="uppercase bg-blue-500 text-gray-100 text-large text-extrabold py-4 px-8 rounded-3xl">
      Keep Reading
    </a>

    @if (isset(Auth::user()->id)&& Auth::user()->id == $post->user_id)
    <span class="float-right">
      <a href="/blog/{{$post->slug}}/edit" class="text-gray-700 italic hover:text-gray-900 pb-1 border-b-2">
        Edit
      </a>

      <span class="float-right">
        <form action="/blog/{{$post->slug}}" method="POST">
        @csrf
        @method('delete')

        <button class="text-red-500 pr-3" type="submit"></button>
      </form>

      </span>
    </span>
        
    @endif
  </div>
</div>
    
@endforeach

@endsection