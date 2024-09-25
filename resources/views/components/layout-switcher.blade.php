{{-- resources/views/components/layout-switcher.blade.php --}}
@props(['user'])

@php
    $role = $user->role ?? 'default'; // Utilise 'default' si aucun utilisateur n'est authentifié
    switch ($role) {
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
            $layout = 'default'; // Fallback layout
            break;
    }
@endphp

{{$layout}}
