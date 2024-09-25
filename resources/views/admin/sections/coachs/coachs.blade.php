@extends('admin.dashboard')
@section('content')
<div class="container-fluid">
    <h1>All Coaches</h1>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('coachs.create') }}" class="btn btn-primary">Add New Coach</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>gender</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($coaches as $coach)
            <tr>
                <td>{{ $coach->name }} {{ $coach->secondname }}</td>
                <td>{{ $coach->email }}</td>
                <td>{{ $coach->phone }}</td>
                <td>{{ $coach->sexe }}</td>

                <td>
                    <a href="{{ route('coachs.show', $coach->id) }}" class="btn btn-info btn-sm">View</a>
                    <form action="{{ route('coachs.destroy', $coach->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
