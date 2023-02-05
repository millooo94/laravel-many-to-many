@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success_delete'))
            <div class="alert alert-warning" role="alert">
                La categoria "{{ session('success_delete')->name }}" e' stata eliminata correttamente
            </div>
        @endif

        <h1>Categorie</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Nome</th>
                    <th scope="col" style="text-align: center">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <th scope="row">{{ $category->id }}</th>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->name }}</td>

                        <td>
                            <div class="btn-container d-flex justify-content-center align-items-center">
                                <a class="btn btn-info" href="{{route('admin.categories.show', ['category' => $category])}}">INFO</a>
                                <a class="btn btn-warning m-2" href="{{route('admin.categories.edit', ['category' => $category])}}">EDIT</a>
                                <form action="{{ route('admin.categories.destroy', ['category' => $category]) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger">DELETE</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $categories->links() }}
    </div>
@endsection
