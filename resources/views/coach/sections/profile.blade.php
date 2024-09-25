@extends('coach.dashboard')
@section('content')
    <div class="container-fluid px-2 px-md-4">
        <div class="page-header min-height-300 border-radius-xl mt-4"
            style="background-image: url('{{ $user->couverture_pic ? asset('storage/' . $user->couverture_pic) : asset('images/defaultimage.jpg') }}');">
            <span class="mask  opacity-6"></span>
        </div>
        <div class="card card-body mx-3 mx-md-4 mt-n6">
            <div class="row gx-4 mb-2">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('images/defaultimage.jpg') }}"
                            alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ $user->name }} {{ $user->secondname }}
                        </h5>
                        <p class="mb-0 font-weight-normal text-sm">
                            {{ $user->occupation ?? 'no occupation' }}
                        </p>
                    </div>
                </div>
                <div class="col-auto my-auto">

                    <!-- Follow/Unfollow Buttons -->
                    @if (auth()->check() && auth()->user()->id !== $user->id)
                        @php
                            $isFollowing = auth()
                                ->user()
                                ->followings->contains($user->id);
                        @endphp
                        <div class="col-12 mt-4">
                            @if ($isFollowing)
                                <form action="{{ route('unfollow', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Unfollow</button>
                                </form>
                                <p class="text-success mt-2">Already following this user.</p>
                            @else
                                <form action="{{ route('follow', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Follow</button>
                                </form>
                            @endif
                        </div>
                    @endif
                </div>
                <!-- Boutons pour gérer le compte -->
                <div class="col-12 mt-4 d-flex justify-content-center">
                    <button class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#updateProfileModal">Manage
                        Account</button>
                    <button class="btn btn-secondary mx-3" data-bs-toggle="modal"
                        data-bs-target="#updatePersonalInfoModal">Personal Info</button>
                    <button class="btn btn-warning mx-3" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change
                        Password</button>
                    <button class="btn btn-danger mx-3" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">Delete
                        Account</button>
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
                                {{ $user->activity_description }}
                            </p>
                            <hr class="horizontal gray-light my-4">
                            <ul class="list-group">
                                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full
                                        Name:</strong> &nbsp; {{ $user->name }} {{ $user->secondname }}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong>
                                    &nbsp; {{ $user->phone }}</li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong>
                                    &nbsp; {{ $user->email }}</li>
                                <li class="list-group-item border-0 ps-0 text-sm">
                                    <strong class="text-dark">Location:</strong> &nbsp;
                                    @if ($user->city && $user->country)
                                        {{ $user->city }}, {{ $user->country }}
                                    @elseif ($user->city)
                                        {{ $user->city }}
                                    @elseif ($user->country)
                                        {{ $user->country }}
                                    @else
                                        No location provided
                                    @endif
                                </li>
                                <li class="list-group-item border-0 ps-0 pb-0">
                                    <strong class="text-dark text-sm">Social:</strong> &nbsp;
                                    @if ($user->facebook || $user->twitter || $user->instagram || $user->linkedin)
                                        @if ($user->facebook)
                                            <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0"
                                                href="{{ $user->facebook }}" target="_blank" rel="noopener noreferrer">
                                                <i class="fab fa-facebook fa-lg"></i>
                                            </a>
                                        @endif
                                        @if ($user->twitter)
                                            <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0"
                                                href="{{ $user->twitter }}" target="_blank" rel="noopener noreferrer">
                                                <i class="fab fa-twitter fa-lg"></i>
                                            </a>
                                        @endif
                                        @if ($user->instagram)
                                            <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0"
                                                href="{{ $user->instagram }}" target="_blank" rel="noopener noreferrer">
                                                <i class="fab fa-instagram fa-lg"></i>
                                            </a>
                                        @endif
                                        @if ($user->linkedin)
                                            <a class="btn btn-linkedin btn-simple mb-0 ps-1 pe-2 py-0"
                                                href="{{ $user->linkedin }}" target="_blank" rel="noopener noreferrer">
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
                <!-- Card to display users the logged-in user is following -->
                <div class="col-12 col-xl-4">
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Following: {{ $user->followings->count() }}</h6>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">
                                @foreach ($user->followings as $followedUser)
                                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                                        <div class="avatar me-3">
                                            <a href="{{ $followedUser->role === 'coach' ? route('coachs.show', $followedUser->id) : route('users.show', $followedUser->id) }}">
                                                <img src="{{ $followedUser->profile_photo ? asset('storage/' . $followedUser->profile_photo) : asset('images/defaultimage.jpg') }}"
                                                    alt="user" class="border-radius-lg shadow">
                                            </a>
                                        </div>
                                        <div class="d-flex align-items-start flex-column justify-content-center">
                                            <a href="{{ $followedUser->role === 'coach' ? route('coachs.show', $followedUser->id) : route('users.show', $followedUser->id) }}" class="text-decoration-none">
                                                <h6 class="mb-0 text-sm">{{ $followedUser->name }} {{ $followedUser->secondname }}</h6>
                                            </a>
                                            <p class="mb-0 text-xs">{{ $followedUser->role }}</p>
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
                            <h6 class="mb-0">Followers : {{ $user->followers->count() }}</h6>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">
                                @foreach ($user->followers as $follower)
                                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                                        <div class="avatar me-3">
                                            <a href="{{ $follower->role === 'coach' ? route('coachs.show', $follower->id) : route('users.show', $follower->id) }}">
                                                <img src="{{ $follower->profile_photo ? asset('storage/' . $follower->profile_photo) : asset('images/defaultimage.jpg') }}"
                                                    alt="user" class="border-radius-lg shadow">
                                            </a>
                                        </div>
                                        <div class="d-flex align-items-start flex-column justify-content-center">
                                            <a href="{{ $follower->role === 'coach' ? route('coachs.show', $follower->id) : route('users.show', $follower->id) }}" class="text-decoration-none">
                                                <h6 class="mb-0 text-sm">{{ $follower->name }} {{ $follower->secondname }}</h6>
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
            <div class="row mt-4">
                <!-- Enrolled Courses -->
                <div class="col-12 col-xl-6">
                    <div class="mb-5 ps-3">
                        <h6 class="mb-1">Created Courses</h6>
                        <p class="text-sm">Courses the user is teaching.</p>
                        <a href="{{ route('startcourse') }}" class="btn btn-primary">Start New Course</a>
                    </div>
                    <div class="row">
                        @forelse($user->createdCourses as $course)
                            <div class="col-xl-4 col-md-6 mb-xl-0 mb-4">
                                <div class="card card-blog card-plain">
                                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-1">
                                        <a href="{{ route('viewcourse', $course->id) }}">
                                            @if ($course->picture)
                                            <img src="{{ asset('storage/' . $course->picture) }}" alt="Course Image" class="img-fluid mb-3">
                                            @else
                                                <img src="default-course-image.jpg" alt="Default Course Image" class="img-fluid border-radius-lg">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="card-body p-3">
                                        <a href="{{ route('viewcourse', $course->id) }}" class="text-decoration-none">
                                            <h5>{{ $course->title }}</h5>
                                        </a>
                                        <p class="mb-0">{{ $course->description }}</p>
                                        <a class="btn btn-primary" href="{{ route('viewcourse', $course->id) }}">
                                            View Course
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">No courses available</p>
                        @endforelse
                    </div>
                </div>


                <!-- Posts -->
                <div class="col-12 col-xl-6">
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Posts: {{ $user->posts->count() }}</h6>
                            @if ($user->posts->isEmpty())
                                <h6 class="mt-3 text-center">No posts available <br>Create New Post</h6>
                                <a href="{{ route('createpost') }}" class="btn btn-primary mt-3">Create New Post</a>
                            @else
                                <a href="{{ route('createpost') }}" class="btn btn-primary mt-3">Create New Post</a>
                            @endif
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                @foreach ($user->posts as $post)
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
        <!-- Modal to update profile -->
        <div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="updateProfileLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateProfileLabel">Update Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control border border-primary shadow-sm" name="email"
                                    value="{{ $user->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control border border-primary shadow-sm" name="phone"
                                    value="{{ $user->phone }}">
                            </div>
                            <div class="mb-3">
                                <label for="profile_photo" class="form-label">Profile Photo</label>
                                <input type="file" class="form-control border border-primary shadow-sm"
                                    name="profile_photo">
                            </div>
                            <div class="mb-3">
                                <label for="couverture_pic" class="form-label">Cover Image</label>
                                <input type="file" class="form-control border border-primary shadow-sm"
                                    name="couverture_pic">
                            </div>
                            <div class="mb-3">
                                <label for="facebook" class="form-label">Facebook</label>
                                <input type="url" class="form-control border border-primary shadow-sm"
                                    name="facebook" value="{{ $user->facebook }}">
                            </div>
                            <div class="mb-3">
                                <label for="twitter" class="form-label">Twitter</label>
                                <input type="url" class="form-control border border-primary shadow-sm" name="twitter"
                                    value="{{ $user->twitter }}">
                            </div>
                            <div class="mb-3">
                                <label for="instagram" class="form-label">Instagram</label>
                                <input type="url" class="form-control border border-primary shadow-sm"
                                    name="instagram" value="{{ $user->instagram }}">
                            </div>
                            <div class="mb-3">
                                <label for="linkedin" class="form-label">LinkedIn</label>
                                <input type="url" class="form-control border border-primary shadow-sm"
                                    name="linkedin" value="{{ $user->linkedin }}">
                            </div>
                            <div class="form-group mt-3">
                                <label for="cin">CIN:</label>
                                <input type="text" name="cin" class="form-control border border-primary shadow-sm"
                                    value="{{ $user->cin }}">
                            </div>
                            <div class="form-group mt-3">
                                <label for="attendance_mode">Attendance Mode:</label>
                                <input type="text" name="attendance_mode"
                                    class="form-control border border-primary shadow-sm"
                                    value="{{ $user->attendance_mode }}">
                            </div>
                            <div class="form-group mt-3">
                                <label for="occupation">Occupation:</label>
                                <input type="text" name="occupation"
                                    class="form-control border border-primary shadow-sm" value="{{ $user->occupation }}">
                            </div>
                            <div class="form-group mt-3">
                                <label for="company_name">Company Name:</label>
                                <input type="text" name="company_name"
                                    class="form-control border border-primary shadow-sm"
                                    value="{{ $user->company_name }}">
                            </div>
                            <div class="form-group mt-3">
                                <label for="sector">Sector:</label>
                                <input type="text" name="sector" class="form-control border border-primary shadow-sm"
                                    value="{{ $user->sector }}">
                            </div>
                            <div class="form-group mt-3">
                                <label for="sector">activity_description:</label>
                                <input type="textera" name="activity_description"
                                    class="form-control border border-primary shadow-sm"
                                    value="{{ $user->activity_description }}">
                            </div>
                            <div class="form-group mt-3">
                                <label for="civility">Civility:</label>
                                <select name="civility" class="form-control border border-primary shadow-sm">
                                    <option value="Mr" {{ $user->civility == 'Mr' ? 'selected' : '' }}>Mr</option>
                                    <option value="Ms" {{ $user->civility == 'Ms' ? 'selected' : '' }}>Ms</option>
                                    <option value="Dr" {{ $user->civility == 'Dr' ? 'selected' : '' }}>Dr</option>
                                    <option value="Prof" {{ $user->civility == 'Prof' ? 'selected' : '' }}>Prof</option>
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <label for="gender">Gender:</label>
                                <select name="gender" class="form-control border border-primary shadow-sm">
                                    <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female
                                    </option>
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Modal to update personal information -->
        <div class="modal fade" id="updatePersonalInfoModal" tabindex="-1" aria-labelledby="updatePersonalInfoLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('user.updatePersonalInfo', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="updatePersonalInfoLabel">Update Personal Information</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">First Name</label>
                                <input type="text" class="form-control border border-primary shadow-sm" name="name"
                                    value="{{ $user->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="secondname" class="form-label">Last Name</label>
                                <input type="text" class="form-control border border-primary shadow-sm"
                                    name="secondname" value="{{ $user->secondname }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control border border-primary shadow-sm" name="city"
                                    value="{{ $user->city }}">
                            </div>
                            <div class="mb-3">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" class="form-control border border-primary shadow-sm" name="country"
                                    value="{{ $user->country }}">
                            </div>
                            <!-- Add additional fields if necessary -->
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal to change password -->
        <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('user.changePassword', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="changePasswordLabel">Change Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" class="form-control border border-primary shadow-sm"
                                    name="current_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" class="form-control border border-primary shadow-sm"
                                    name="new_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control border border-primary shadow-sm"
                                    name="new_password_confirmation" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal to delete account -->
        <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('user.delete', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteAccountLabel">Delete Account</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this account? This action is irreversible.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
