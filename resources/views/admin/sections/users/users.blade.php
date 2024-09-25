@extends('admin.dashboard')
@section('content')
<div class="container-fluid">
    <h1>All users</h1>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('users.create') }}" class="btn btn-primary">Add New Coach</a>
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
            @foreach ($normalusers as $normaluser)
            <tr>
                <td>{{ $normaluser->name }} {{ $normaluser->secondname }}</td>
                <td>{{ $normaluser->email }}</td>
                <td>{{ $normaluser->phone }}</td>
                <td>{{ $normaluser->sexe }}</td>

                <td>
                    <a href="{{ route('users.show', $normaluser->id) }}" class="btn btn-info btn-sm">View</a>
                    <form action="{{ route('users.destroy' , $normaluser->id) }}" method="POST" style="display:inline;">
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
