@extends('layouts.app')
@section('content')
<div class="container">
    @if (session('success_delete'))
    <div class="alert alert-success" role="alert">
        The category {{ session('success_delete')->name }} correctly deleted
    </div>
    @endif
    <div class="row">
        @foreach ($categories as $category)
        <div class="col-12">
            <div class="card index mb-3 m-auto" style="width: 60%;">
                <div class="row g-0">
                  <div class="col-md-8 d-flex align-items-center">
                    <div class="card-body">
                      <h3>{{$category->id}}</h3>
                      <h4>{{$category->slug}}</h4>
                      <h5 class="card-title">{{$category->name}}</h5>
                      <div class="btn-container d-flex justify-content-center align-items-center">
                        <a class="btn btn-info" href="{{route('admin.categories.show', ['category' => $category])}}">INFO</a>
                        <a class="btn btn-warning m-2" href="{{route('admin.categories.edit', ['category' => $category])}}">EDIT</a>
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
        </div>
        @endforeach
    </div>
    {{ $categories->links() }}
</div>
@endsection
