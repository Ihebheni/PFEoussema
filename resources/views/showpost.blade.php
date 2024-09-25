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
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                @if(auth()->user()->id == $post->user_id)
                <a href="{{ route('profile', $post->user->id) }}"
                    class="nav-link text-body p-0 d-flex align-items-center">
                    <img class="img-profile rounded-circle"
                        src="{{ $post->user->profile_photo ? asset('storage/' . $post->user->profile_photo) : asset('images/defaultimage.jpg') }}"
                        alt="Profile Photo" style="width: 60px; height: 60px;">
                    <span class="fw-bold ms-2 me-2">{{ $post->user->civility . ' ' . $post->user->name }}</span>
                </a>
                @else
                <a href="{{ $post->user->role == 'coach' ? route('coachs.show', $post->user->id) : route('users.show', $post->user->id) }}"
                    class="nav-link text-body p-0 d-flex align-items-center">
                    <img class="img-profile rounded-circle"
                        src="{{ $post->user->profile_photo ? asset('storage/' . $post->user->profile_photo) : asset('images/defaultimage.jpg') }}"
                        alt="Profile Photo" style="width: 60px; height: 60px;">
                    <span class="fw-bold ms-2 me-2">{{ $post->user->civility . ' ' . $post->user->name }}</span>
                </a>
                @endif
            </div>
            <div>
                <small>Posted on {{ $post->created_at->format('M d, Y h:i A') }}</small>
            </div>

            @if(auth()->user()->id == $post->user_id)
            <div>
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
            @endif
        </div>

        <div class="card-body">
            <h3>Show Post</h3>
            <p>{{ $post->content }}</p>

            @if($post->post_pics)
            <div class="row mt-3">
                @foreach(json_decode($post->post_pics) as $image)
                <div class="col-md-4">
                    <img src="{{ asset('storage/posts/' . $image) }}" alt="Post Image" class="img-fluid rounded">
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <div class="card-footer">
            @if($post->comments->count() > 0)
            <h5>Comments:</h5>
            <ul class="list-group list-group-flush">
                @foreach($post->comments as $comment)
                <li class="list-group-item mx-2">
                    <strong>{{ $comment->user->name }}</strong>: {{ $comment->content }}   : {{ $comment->created_at->format('M d, Y h:i A') }}
                </li>
                @endforeach
            </ul>
            @else
            <p>No comments yet.</p>
            @endif   <!-- Add Comment Button -->
            <button class="btn btn-primary mt-3" onclick="toggleCommentForm()">Add Comment</button>

            <!-- Comment Form (Initially hidden) -->
            <div id="commentForm" style="display: none; margin-top: 20px;">
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <div class="form-group mb-3">
                        <label for="content">Comment</label>
                        <textarea id="content" name="content" class="form-control control border border-primary shadow-sm" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" onclick="toggleCommentForm()">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleCommentForm() {
        var form = document.getElementById('commentForm');
        if (form.style.display === 'none' || form.style.display === '') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    }
</script>

@endsection
