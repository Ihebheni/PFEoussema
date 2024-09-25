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
@section('content')<div class="container-fluid px-2 px-md-4">
        <div class="page-header min-height-300 border-radius-xl mt-4"
            style="background-image: url('{{ $normaluser->couverture_pic ? asset('storage/' . $normaluser->couverture_pic) : asset('images/defaultimage.jpg') }}');">
            <span class="mask  opacity-6"></span>
        </div>
        <div class="card card-body mx-3 mx-md-4 mt-n6">
            <div class="row gx-4 mb-2">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="{{ $normaluser->profile_photo ? asset('storage/' . $normaluser->profile_photo) : asset('images/defaultimage.jpg') }}"
                            alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ $normaluser->name }} {{ $normaluser->secondname }}
                        </h5>
                        <p class="mb-0 font-weight-normal text-sm">
                            {{ $normaluser->occupation ?? 'no occupation' }}
                        </p>
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <!-- Follow/Unfollow Buttons -->
                    @if(auth()->check() && auth()->user()->id !== $normaluser->id)
                        @php
                            $isFollowing = auth()->user()->followings->contains($normaluser->id);
                        @endphp
                        <div class="col-12 mt-4">
                            @if($isFollowing)
                                <form action="{{ route('unfollow', $normaluser->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Unfollow</button>
                                </form>
                                <p class="text-success mt-2">Already following this user.</p>
                            @else
                                <form action="{{ route('follow', $normaluser->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Follow</button>
                                </form>
                            @endif
                        </div>
                    @endif
                </div>

            </div>
            <div class="row">
                <div class="col-12 col-xl-4">
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Profile Information</h6>
                        </div>
                        <div class="card-body p-3">
                            <p class="text-sm">
                                {{ $normaluser->activity_description }}
                            </p>
                            <hr class="horizontal gray-light my-4">
                            <ul class="list-group">
                                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full
                                        Name:</strong> &nbsp; {{ $normaluser->name }} {{ $normaluser->secondname }}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong>
                                    &nbsp; {{ $normaluser->phone }}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong>
                                    &nbsp; {{ $normaluser->email }}</li>
                                <li class="list-group-item border-0 ps-0 text-sm">
                                    <strong class="text-dark">Location:</strong> &nbsp;
                                    @if ($normaluser->city && $normaluser->country)
                                        {{ $normaluser->city }}, {{ $normaluser->country }}
                                    @elseif ($normaluser->city)
                                        {{ $normaluser->city }}
                                    @elseif ($normaluser->country)
                                        {{ $normaluser->country }}
                                    @else
                                        No location provided
                                    @endif
                                </li>
                                <li class="list-group-item border-0 ps-0 pb-0">
                                    <strong class="text-dark text-sm">Social:</strong> &nbsp;
                                    @if ($normaluser->facebook || $normaluser->twitter || $normaluser->instagram || $normaluser->linkedin)
                                        @if ($normaluser->facebook)
                                            <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0"
                                                href="{{ $normaluser->facebook }}" target="_blank"
                                                rel="noopener noreferrer">
                                                <i class="fab fa-facebook fa-lg"></i>
                                            </a>
                                        @endif
                                        @if ($normaluser->twitter)
                                            <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0"
                                                href="{{ $normaluser->twitter }}" target="_blank"
                                                rel="noopener noreferrer">
                                                <i class="fab fa-twitter fa-lg"></i>
                                            </a>
                                        @endif
                                        @if ($normaluser->instagram)
                                            <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0"
                                                href="{{ $normaluser->instagram }}" target="_blank"
                                                rel="noopener noreferrer">
                                                <i class="fab fa-instagram fa-lg"></i>
                                            </a>
                                        @endif
                                        @if ($normaluser->linkedin)
                                            <a class="btn btn-linkedin btn-simple mb-0 ps-1 pe-2 py-0"
                                                href="{{ $normaluser->linkedin }}" target="_blank"
                                                rel="noopener noreferrer">
                                                <i class="fab fa-linkedin fa-lg"></i>
                                            </a>
                                        @endif
                                    @else
                                        No social media provided
                                    @endif
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-4">
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Following: {{ $normaluser->followings->count() }}</h6>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">
                                @foreach ($normaluser->followings as $followednormaluser)
                                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                                        <div class="avatar me-3">
                                            <a
                                                href="{{ $followednormaluser->role === 'user' ? route('users.show', $followednormaluser->id) : route('coachs.show', $followednormaluser->id) }}">
                                                <img src="{{ $followednormaluser->profile_photo ? asset('storage/' . $followednormaluser->profile_photo) : asset('images/defaultimage.jpg') }}"
                                                    alt="normaluser" class="border-radius-lg shadow">
                                            </a>
                                        </div>
                                        <div class="d-flex align-items-start flex-column justify-content-center">
                                            <a href="{{ $followednormaluser->role === 'user' ? route('users.show', $followednormaluser->id) : route('coachs.show', $followednormaluser->id) }}"
                                                class="text-decoration-none">
                                                <h6 class="mb-0 text-sm">{{ $followednormaluser->name }}
                                                    {{ $followednormaluser->secondname }}</h6>
                                            </a>
                                            <p class="mb-0 text-xs">{{ $followednormaluser->role }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-4">
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Followers : {{ $normaluser->followers->count() }}</h6>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">
                                @foreach ($normaluser->followers as $follower)
                                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                                        <div class="avatar me-3">
                                            <a
                                                href="{{ $follower->role === 'user' ? route('users.show', $follower->id) : route('coachs.show', $follower->id) }}">
                                                <img src="{{ $follower->profile_photo ? asset('storage/' . $follower->profile_photo) : asset('images/defaultimage.jpg') }}"
                                                    alt="normaluser" class="border-radius-lg shadow">
                                            </a>
                                        </div>
                                        <div class="d-flex align-items-start flex-column justify-content-center">
                                            <a href="{{ $follower->role === 'user' ? route('users.show', $follower->id) : route('coachs.show', $follower->id) }}"
                                                class="text-decoration-none">
                                                <h6 class="mb-0 text-sm">{{ $follower->name }} {{ $follower->secondname }}
                                                </h6>
                                            </a>
                                            <p class="mb-0 text-xs">{{ $follower->role }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Posts -->
            <div class="col-12 col-xl-6">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Posts: {{ $normaluser->posts->count() }}</h6>
                        @if ($normaluser->posts->isEmpty())
                            <h6 class="mt-3 text-center">No posts available </h6>
                        @endif
                    </div>
                    <div class="card-body p-3">
                        <div class="row">
                            @foreach ($normaluser->posts as $post)
                                <div class="col-md-12 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                {{ $post->created_at ? $post->created_at->format('F j, Y, g:i a') : 'Date not available' }}
                                            </h5>
                                            <p class="card-text">{{ $post->content }}</p>
                                            <a href="{{ route('viewpost', $post->id) }}" class="btn btn-primary">View Post</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection








