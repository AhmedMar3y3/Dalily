@extends('layout')
@section('main')

<div class="container">
    <h1>{{ $category->name }}</h1>
    @if (Session::has('success'))
    <div class="alert alert-success" style="background:#28272f; color: white;">{{ Session::get('success') }}</div>
    @endif
    @if (Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif

    <table class="table table-boarded">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Rating</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($places as $place)
                <tr>
                    <td>{{ $place->id }}</td>
                    <td>{{ $place->name }}</td>
                    <td>{{ $place->category->name }}</td>
                    <td>
                        <a href="{{ route('admin.places.show', $place->id) }}" class="btn btn-info btn-rounded btn-sm">
                            <i class="fa fa-eye"></i>

                        </a>
                        <a href="{{ route('admin.places.edit', $place->id) }}" class="btn btn-warning btn-rounded btn-sm">
                            <i class="fa fa-pencil-square-o"></i>
                        </a>
                        <form action="{{ route('admin.places.destroy', $place->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-rounded btn-sm" onclick="return confirm('Are You sure?')">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
      <!-- Pagination Buttons -->
      <div class="d-flex justify-content-between mt-4">
        <!-- Previous Page Button -->
        @if($places->onFirstPage())
        <span class="btn btn-secondary btn-rounded disabled">Previous</span>
        @else
        <a href="{{ $places->previousPageUrl() }}" class="btn btn-primary btn-rounded">Previous</a>
        @endif

        <!-- Next Page Button -->
        @if($places->hasMorePages())
        <a href="{{ $places->nextPageUrl() }}" class="btn btn-primary btn-rounded">Next</a>
        @else
        <span class="btn btn-secondary btn-rounded disabled">Next</span>
        @endif
    </div>
</div>

@endsection