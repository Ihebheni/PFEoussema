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
@endsection
