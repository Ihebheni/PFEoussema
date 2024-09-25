@extends('admin.dashboard')

@section('content')
<div class="container-fluid">
    <h1>Complaints</h1>

    <!-- Dropdown for filtering complaints -->
    <div class="mb-4">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="complaintFilter" data-bs-toggle="dropdown" aria-expanded="false">
            Filter by status
        </button>
        <ul class="dropdown-menu" aria-labelledby="complaintFilter">
            <li><a class="dropdown-item" href="#" id="filter-unread">Unread</a></li>
            <li><a class="dropdown-item" href="#" id="filter-read">Read</a></li>
            <li><a class="dropdown-item" href="#" id="filter-all">All</a></li>
        </ul>
    </div>

    <div id="complaints-container" class="row">
        <!-- Default: displaying all complaints -->
        @if($reclamations->isEmpty())
            <div class="col-12">
                <div class="alert alert-info">
                    No complaints available.
                </div>
            </div>
        @else
            @foreach ($reclamations as $reclamation)
                <div class="col-12 col-md-4">
                    <div class="card mb-3">
                        <div class="card-body p-2 position-relative">
                            <!-- Span indicating read/unread status -->
                            <span class="badge position-absolute top-0 end-0 m-2
                                {{ $reclamation->read ? 'bg-success' : 'bg-warning' }}">
                                {{ $reclamation->read ? 'Read' : 'Unread' }}
                            </span>
                            <h5 class="card-title">{{ $reclamation->name }}</h5>
                            <p class="card-text text-muted">
                                <small>Created on: {{ $reclamation->created_at->format('d/m/Y H:i') }}</small><br>
                                <small><strong>User:</strong> {{ $reclamation->is_user ? 'Yes' : 'No' }}</small>
                            </p>
                            <div class="d-flex justify-content-between">
                                <!-- View Button -->
                                <a href="{{ route('admin.reclamations.show', $reclamation->id) }}" class="btn btn-sm btn-info">View</a>

                                <!-- Delete Form -->
                                <form action="{{ route('admin.reclamations.delete', $reclamation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this reclamation?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

<script>
    const reclamations = @json($reclamations);

    document.getElementById('filter-unread').addEventListener('click', function() {
        filterComplaints('unread');
    });

    document.getElementById('filter-read').addEventListener('click', function() {
        filterComplaints('read');
    });

    document.getElementById('filter-all').addEventListener('click', function() {
        filterComplaints('all');
    });

    function filterComplaints(type) {
        let complaintsContainer = document.getElementById('complaints-container');
        complaintsContainer.innerHTML = ''; // Clear the current content

        let filteredComplaints = reclamations.filter(complaint => {
            if (type === 'unread') return !complaint.read;
            if (type === 'read') return complaint.read;
            return true; // 'all' option
        });

        if (filteredComplaints.length === 0) {
            complaintsContainer.innerHTML = '<div class="col-12"><div class="alert alert-info">No complaints available.</div></div>';
            return;
        }

        filteredComplaints.forEach(complaint => {
            let badgeClass = complaint.read ? 'bg-success' : 'bg-warning';
            let statusText = complaint.read ? 'Read' : 'Unread';
            let card = `<div class="col-12 col-md-4">
                            <div class="card mb-3">
                                <div class="card-body p-2 position-relative">
                                    <span class="badge position-absolute top-0 end-0 m-2 ${badgeClass}">${statusText}</span>
                                    <h5 class="card-title">${complaint.name}</h5>
                                    <p class="card-text text-muted">
                                        <small>Created on: ${new Date(complaint.created_at).toLocaleString()}<br>
                                        <strong>User:</strong> ${complaint.is_user ? 'Yes' : 'No'}</small>
                                    </p>
                                    <div class="d-flex justify-content-between">
                                        <a href="#" class="btn btn-sm btn-info">View</a>
                                        <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>`;
            complaintsContainer.innerHTML += card;
        });
    }
</script>
@endsection
