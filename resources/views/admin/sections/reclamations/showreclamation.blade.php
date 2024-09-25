@extends('admin.dashboard')

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4>Reclamation Details</h4>
                </div>
                <div class="card-body">
                    <!-- Display Reclamation Information -->
                    <p><strong>Name:</strong> {{ $reclamation->name }}</p>
                    <p><strong>Email:</strong> {{ $reclamation->email }}</p>
                    <p><strong>Text:</strong> {{ $reclamation->text }}</p>
                    <p><strong>Status:</strong>
                        @if ($reclamation->read)
                            <span class="badge bg-success">Read</span>
                        @else
                            <span class="badge bg-warning">Unread</span>
                        @endif
                    </p>
                    <p><strong>Is User:</strong>
                        @if ($reclamation->is_user)
                            Yes
                            <!-- Display user details if `is_user` is true -->
                            @php
                                $relevantUser = \App\Models\User::where('email', $reclamation->email)->first();
                            @endphp
                            @if ($relevantUser)
                                <br>
                                <strong>User Details:</strong>
                                <p><strong>Name:</strong> {{ $relevantUser->name }} {{ $relevantUser->secondname }}</p>
                                <p><strong>Email:</strong> {{ $relevantUser->email }}</p>
                                <p><strong>Phone:</strong> {{ $relevantUser->phone ?? 'No phone provided' }}</p>
                                <p><strong>Location:</strong> {{ $relevantUser->city ? $relevantUser->city . ', ' : '' }}{{ $relevantUser->country ?? 'No location provided' }}</p>

                                <!-- Link to User Profile based on role -->
                                @if ($relevantUser->role == 'coach')
                                    <a href="{{ route('coachs.show', $relevantUser->id) }}" class="btn btn-info">View Coach Profile</a>
                                @elseif ($relevantUser->role == 'user')
                                    <a href="{{ route('users.show', $relevantUser->id) }}" class="btn btn-info">View User Profile</a>
                                @else
                                    <p>Profile link not available for this role.</p>
                                @endif
                            @else
                                <p>User not found.</p>
                            @endif
                        @else
                            No
                        @endif
                    </p>

                    <!-- Back and Delete Buttons -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.reclamations') }}" class="btn btn-secondary">Back to List</a>

                        <form action="{{ route('admin.reclamations.delete', $reclamation->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reclamation?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


     before
    <link href="../assets/css/style.css" rel="stylesheet" />
    <script src="../assets/js/app.js"></script>

     after
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/app.js') }}"></script>


@endsection
