@extends('admin.dashboard')

@section('content')
<div class="container-fluid px-2 px-md-4">
    <div class="card card-body mx-3 mx-md-4 mt-n2">
        <div class="row gx-4 mb-2">
            <div class="col-auto">
                <div class="avatar avatar-xxl position-relative">
                    <img id="profile-photo-preview" src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('images/defaultimage.jpg') }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                    <input type="file" id="profile-photo-input" class="form-control d-none" accept="image/*">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ $user->name }} {{ $user->secondname }}
                    </h5>
                    <p class="mb-0 font-weight-normal text-sm">
                        {{ $user->occupation ?? 'No occupation' }}
                    </p>
                </div>
            </div>
            <div class="col-auto my-auto ms-auto">
                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#manageAccountModal">Manage Account</button>
                <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#managePersonalInfoModal">Personal Info</button>
                <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</button>
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">Delete Account</button>
            </div>
        </div>

        <!-- Profile Information Section -->
        <div class="row">
            <div class="col-12">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Profile Information</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">
                            <!-- First Column -->
                            <div class="col-12 col-md-6">
                                <ul class="list-group">
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; {{ $user->name }} {{ $user->secondname }}</li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; {{ $user->email }}</li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong> &nbsp; {{ $user->phone ?? 'No phone provided' }}</li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Civility:</strong> &nbsp; {{ $user->civility ?? 'Not provided' }}</li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Gender:</strong> &nbsp; {{ $user->sexe ?? 'Not provided' }}</li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Occupation:</strong> &nbsp; {{ $user->occupation ?? 'No occupation provided' }}</li>
                                </ul>
                            </div>

                            <!-- Second Column -->
                            <div class="col-12 col-md-6">
                                <ul class="list-group">
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Company Name:</strong> &nbsp; {{ $user->company_name ?? 'No company provided' }}</li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Sector:</strong> &nbsp; {{ $user->sector ?? 'No sector provided' }}</li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong> &nbsp;
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
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Attendance Mode:</strong> &nbsp; {{ $user->attendance_mode ?? 'Not provided' }}</li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">CIN:</strong> &nbsp; {{ $user->cin ?? 'Not provided' }}</li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Social Media:</strong>
                                        <div class="d-flex mt-2">
                                            @if($user->facebook)
                                                <a href="{{ $user->facebook }}" target="_blank" class="btn btn-outline-primary btn-sm me-2">
                                                    <i class="fab fa-facebook"></i>
                                                </a>
                                            @endif
                                            @if($user->twitter)
                                                <a href="{{ $user->twitter }}" target="_blank" class="btn btn-outline-info btn-sm me-2">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            @endif
                                            @if($user->instagram)
                                                <a href="{{ $user->instagram }}" target="_blank" class="btn btn-outline-danger btn-sm me-2">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            @endif
                                            @if($user->linkedin)
                                                <a href="{{ $user->linkedin }}" target="_blank" class="btn btn-outline-secondary btn-sm">
                                                    <i class="fab fa-linkedin"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modals -->
<!-- Manage Account Modal -->
<div class="modal fade" id="manageAccountModal" tabindex="-1" aria-labelledby="manageAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="manageAccountModalLabel">Manage Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control border border-primary shadow-sm" value="{{ $user->email }}" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="phone">Phone:</label>
                        <input type="text" name="phone" class="form-control border border-primary shadow-sm" value="{{ $user->phone }}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="profile_photo">Profile Photo:</label>
                        <input type="file" name="profile_photo" class="form-control border border-primary shadow-sm" accept="image/*">
                    </div>
                    <div class="form-group mt-3">
                        <label for="facebook">Facebook:</label>
                        <input type="text" name="facebook" class="form-control border border-primary shadow-sm" value="{{ $user->facebook }}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="twitter">Twitter:</label>
                        <input type="text" name="twitter" class="form-control border border-primary shadow-sm" value="{{ $user->twitter }}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="instagram">Instagram:</label>
                        <input type="text" name="instagram" class="form-control border border-primary shadow-sm" value="{{ $user->instagram }}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="linkedin">LinkedIn:</label>
                        <input type="text" name="linkedin" class="form-control border border-primary shadow-sm" value="{{ $user->linkedin }}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="cin">CIN:</label>
                        <input type="text" name="cin" class="form-control border border-primary shadow-sm" value="{{ $user->cin }}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="attendance_mode">Attendance Mode:</label>
                        <input type="text" name="attendance_mode" class="form-control border border-primary shadow-sm" value="{{ $user->attendance_mode }}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="occupation">Occupation:</label>
                        <input type="text" name="occupation" class="form-control border border-primary shadow-sm" value="{{ $user->occupation }}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="company_name">Company Name:</label>
                        <input type="text" name="company_name" class="form-control border border-primary shadow-sm" value="{{ $user->company_name }}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="sector">Sector:</label>
                        <input type="text" name="sector" class="form-control border border-primary shadow-sm" value="{{ $user->sector }}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="sector">activity_description:</label>
                        <input type="textera" name="activity_description" class="form-control border border-primary shadow-sm" value="{{ $user->activity_description }}">
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
                            <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Additional modals for Change Password and Delete Account can be added similarly -->


<!-- Manage Personal Info Modal -->
<div class="modal fade" id="managePersonalInfoModal" tabindex="-1" aria-labelledby="managePersonalInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('user.updatePersonalInfo', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="managePersonalInfoModalLabel">Manage Personal Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">First Name:</label>
                        <input type="text" name="name" class="form-control border border-primary shadow-sm" value="{{ $user->name }}" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="secondname">Last Name:</label>
                        <input type="text" name="secondname" class="form-control border border-primary shadow-sm" value="{{ $user->secondname }}" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="city">City:</label>
                        <input type="text" name="city" class="form-control border border-primary shadow-sm" value="{{ $user->city }}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="country">Country:</label>
                        <input type="text" name="country" class="form-control border border-primary shadow-sm" value="{{ $user->country }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('user.changePassword', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="current_password">Current Password:</label>
                        <input type="password" name="current_password" class="form-control border border-primary shadow-sm" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="new_password">New Password:</label>
                        <input type="password" name="new_password" class="form-control border border-primary shadow-sm" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="new_password_confirmation">Confirm New Password:</label>
                        <input type="password" name="new_password_confirmation" class="form-control border border-primary shadow-sm" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('user.delete', $user->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAccountModalLabel">Delete Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete your account? This action is irreversible.</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
