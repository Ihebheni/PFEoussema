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
    <h2>My Posts</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('createpost') }}" class="btn btn-primary mb-4">Add New Post</a>

    @if($posts->count())
        @foreach($posts as $post)
        <div class="card mb-4">
            <div class="card-header">
                <h5>{{ $post->title }}</h5>
                <small>Posted on {{ $post->created_at->format('M d, Y h:i A') }}</small>
            </div>
            <div class="card-body">
                <p>{{ $post->content }}</p>

                @if($post->post_pics)
                <div class="row mt-3">
                    @foreach(json_decode($post->post_pics) as $image)
                    <div class="col-md-4">
                        <img src="{{ asset('storage/' . $image) }}" alt="Post Image" class="img-fluid rounded">
                    </div>
                    @endforeach
                </div>
                @endif
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Options
                    </button>
                    <ul class="dropdown-menu text-center">
                        <li>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-success">Edit</a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('posts.destroy', $post->id) }}" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        @endforeach
    @else
        <p>No posts found.</p>
    @endif
</div>
@endsection
