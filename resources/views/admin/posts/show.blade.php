@extends('layouts.app')

@section('content')
<div class="card show-card index mb-3 m-auto" style="width: 70%;">
    <div class="row g-0">
      <div class="col-md-4 d-flex">
        <img src="{{$post->image}}" class="img-fluid rounded-start" alt="...">
        <img src="{{asset('storage/' . $post->uploaded_img)}}" class="img-fluid rounded-start" alt="...">
      </div>
      <div class="col-md-8 d-flex align-items-center">
        <div class="card-body p-5">
            <h5 class="card-title">{{$post->title}}</h5>
            <h6>Nella categoria: {{$post->category->name}}</h6>
            <p class="series fw-bold"> {{$post->content}}</p>
            <p class="type text-uppercase">{{$post->excerpt}}</p>
            <div class="btn-container d-flex justify-content-center align-items-center">
              <a class="btn btn-secondary" href="{{route('admin.posts.index', ['post' => $post])}}">INDEX</a>
          <div class="btn-container d-flex justify-content-center align-items-center">
            <a class="btn btn-warning m-4" href="{{route('admin.posts.edit', ['post' => $post])}}">EDIT</a>
            <form action="{{ route('admin.posts.destroy', ['post' => $post]) }}" method="post">
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

