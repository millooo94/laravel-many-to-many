@extends('layouts.app')
@section('content')
<div class="container">
    @if (session('success_delete'))
    <div class="alert alert-success" role="alert">
        ID post {{ session('success_delete')->id }} correctly deleted
    </div>
    @endif
    <div class="row">
        @foreach ($posts as $post)
        <div class="col-12">
            <div class="card index mb-3 m-auto" style="width: 60%;">
                <div class="row g-0">
                  <div class="col-md-4 d-flex">
                    <img src="{{$post->image}}" class="img-fluid rounded-start" alt="...">
                  </div>
                  <div class="col-md-8 d-flex align-items-center">
                    <div class="card-body">
                      <h3>{{$post->id}}</h3>
                      <h4>{{$post->slug}}</h4>
                      <h5 class="card-title">{{$post->title}}</h5>
                      <h6>{{$post->category->name}}</h6>
                      <p class="series fw-bold"> {{$post->content}}</p>
                      <p class="type text-uppercase">{{$post->excerpt}}</p>
                      <div class="btn-container d-flex justify-content-center align-items-center">
                        <a class="btn btn-info" href="{{route('admin.posts.show', ['post' => $post])}}">INFO</a>
                        <a class="btn btn-warning m-2" href="{{route('admin.posts.edit', ['post' => $post])}}">EDIT</a>
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
        </div>
        @endforeach
    </div>
    {{ $posts->links() }}
</div>
@endsection
