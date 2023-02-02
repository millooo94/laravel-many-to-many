@extends('layouts.app')

@section('content')
<div class="card show-card index mb-3 m-auto" style="width: 70%;">
    <div class="row g-0">
      <div class="col-md-8 d-flex align-items-center">
        <div class="card-body p-5">
            <h5 class="card-title">{{$category->name}}</h5>
            <p>{{$category->description}}</p>
            <ul>
                @foreach ($category->posts as $post)
                <li><a href="{{route('admin.posts.show', ['post' => $post])}}">{{$post->title}}</a></li>
                @endforeach
            </ul>
            <div class="btn-container d-flex justify-content-center align-items-center">
              <a class="btn btn-secondary" href="{{route('admin.categories.index', ['category' => $category])}}">INDEX</a>
          <div class="btn-container d-flex justify-content-center align-items-center">
            <a class="btn btn-warning m-4" href="{{route('admin.categories.edit', ['category' => $category])}}">EDIT</a>
            <form action="{{ route('admin.categories.destroy', ['category' => $category]) }}" method="post">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger">DELETE</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
