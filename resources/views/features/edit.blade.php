@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Feature</h2>

    <form action="{{ route('features.update', $feature->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" value="{{ old('title', $feature->title) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image (optional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        @if ($feature->image)
            <div class="mb-3">
                <p>Current Image:</p>
                <img src="{{ asset('storage/' . $feature->image) }}" alt="Feature Image" width="200">
            </div>
        @endif

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
