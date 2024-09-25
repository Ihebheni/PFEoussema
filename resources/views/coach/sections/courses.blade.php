@extends('coach.dashboard')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Edit Course</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('updatecourse', $course->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Course Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $course->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $course->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="duration">Duration</label>
                    <input type="text" name="duration" class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration', $course->duration) }}" required>
                    @error('duration')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="picture">Change Image (optional)</label>
                    <input type="file" name="picture" class="form-control-file @error('picture') is-invalid @enderror">
                    @error('picture')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update Course</button>
            </form>
        </div>
    </div>
</div>
@endsection
