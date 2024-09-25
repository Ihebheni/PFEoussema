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
        <div class="card-header">
            <h3>Edit Post #{{ $post->id }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group mb-3 " >
                    <label for="content">Content</label>
                    <textarea id="content" name="content" class="form-control control border border-primary shadow-sm" rows="4">{{ old('content', $post->content) }}</textarea>
                </div>

                <div class="form-group mb-3 ">
                    <label for="post_pics ">Post Images</label>
                    <input type="file" id="post_pics" name="post_pics[]" class="form-control control border border-primary shadow-sm" multiple>
                </div>

                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary">Update Post</button>
                    <a href="#" onclick="redirectback()" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function redirectback() {
        // Go back to the previous page in the browser's history
        window.history.back();
    }
    </script>

@endsection
