@php
$userRole = auth()->user()->role;
$userId = auth()->id();
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
    <div class="card">
        <div class="card-header">
            @if(auth()->user()->id == $course->coach_id)
            <a href="{{ route('profile', $course->coach_id) }}"
                class="nav-link text-body p-0 d-flex align-items-center">
                <img class="img-profile rounded-circle"
                    src="{{ $course->coach->profile_photo ? asset('storage/' . $course->coach->profile_photo) : asset('images/defaultimage.jpg') }}"
                    alt="Profile Photo" style="width: 60px; height: 60px;">
                <span class="fw-bold ms-2 me-2">{{ $course->coach->civility . ' ' . $course->coach->name }}</span>
            </a>
            @else
            <a href="{{ route('coachs.show', $course->coach->id)  }}"
                class="nav-link text-body p-0 d-flex align-items-center">
                <img class="img-profile rounded-circle"
                    src="{{ $course->coach->profile_photo ? asset('storage/' . $course->coach->profile_photo) : asset('images/defaultimage.jpg') }}"
                    alt="Profile Photo" style="width: 60px; height: 60px;">
                <span class="fw-bold ms-2 me-2">{{ $course->coach->civility . ' ' . $course->coach->name }}</span>
            </a>
            @endif
            <h3>{{ $course->title }}</h3>
        </div>
        <div class="card-body">
            @if ($course->picture)
                <img src="{{ asset('storage/' . $course->picture) }}" alt="Course Image" class="img-fluid mb-3">
            @endif
            <p>{{ $course->description }}</p>
            <p><strong>Duration:</strong> {{ $course->duration }}</p>

            @if ($course->coach_id === $userId || $userRole === 'admin')
                <a href="{{ route('editcourse', $course->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('deletecourse', $course->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
