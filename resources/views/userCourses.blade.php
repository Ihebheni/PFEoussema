@php
$userRole = auth()->user()->role;

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
<div class="container mt-4">
    <h2>My Courses</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('startcourse') }}" class="btn btn-primary mb-4">Add New Course</a>

    @if($courses->count())
        @foreach($courses as $course)
        <div class="card mb-4">
            <div class="card-body">
                <h5>{{ $course->title }}</h5>
                <p>{{ $course->description }}</p>
            </div>
        @endforeach
        <div>
            <a href="{{ route('editcourse', $course->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('deletecourse', $course->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>

    </div>

    @else
        <p>No courses found.</p>
    @endif
</div>
@endsection
