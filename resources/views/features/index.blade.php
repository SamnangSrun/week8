@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('features.create') }}" class="btn btn-primary mb-3">Add Feature</a>

    <div class="row">
        @foreach ($features as $feature)
            <div class="col-md-3 text-center mb-4">
                <img src="{{ asset('storage/' . $feature->image) }}" alt="{{ $feature->title }}" width="80" height="80">
                <h6 class="mt-2">{{ $feature->title }}</h6>
                <a href="{{ route('features.edit', $feature) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('features.destroy', $feature) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
            </div>
        @endforeach
    </div>
</div>
@endsection
