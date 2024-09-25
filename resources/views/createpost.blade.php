@php
    $userRole = auth()->user()->role; // Get the current user's role
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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Create New Post</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Post Content -->
                        <div class="form-group  border border-primary shadow-sm">
                            <label for="content">What's on your mind?</label>
                            <textarea id="content" name="content" class="form-control" rows="4" placeholder="Write something...">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Post Images -->
                        <div class="form-group">
                            <label for="post_pics">Add photos</label>
                            <input type="file" id="post_pics" name="post_pics[]" class="form-control-file" multiple>
                            @error('post_pics.*')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
