@php
$userRole = auth()->user()->role; // Récupérer le rôle de l'utilisateur actuel

switch ($userRole) {
case 'admin':
    $layout = 'admin.dashboard';
    break;
case 'coach':
    $layout = 'coach.dashboard';
    break;
case 'user':
    $layout = 'user.dashboard';
    break;
default:
    $layout = 'default';
    break;
}
@endphp

@extends($layout)
@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3>Create New Course</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="coach_id" value="{{ auth()->user()->id }}">

                <div class="form-group border border-primary shadow-sm">
                    <label for="title">Course Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter course title" value="{{ old('title') }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group border border-primary shadow-sm">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Course description">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group border border-primary shadow-sm">
                    <label for="duration">Duration</label>
                    <input type="text" name="duration" class="form-control @error('duration') is-invalid @enderror" placeholder="Course duration" value="{{ old('duration') }}">
                    @error('duration')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group border border-primary shadow-sm">
                    <label for="picture">Add Photos</label>
                    <input type="file" id="picture" name="picture[]" class="form-control-file @error('picture.*') is-invalid @enderror" multiple>
                    @error('picture.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success mt-3">Create Course</button>
            </form>
        </div>
    </div>
</div>
@endsection
