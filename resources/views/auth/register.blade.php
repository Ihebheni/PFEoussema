@extends('layouts.guest')

@section('content')
<div class="registration-container">

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input id="name" type="text" class="form-control  border border-primary shadow-sm" name="name" value="{{ old('name') }}" required>
            @error('name')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Second Name -->
        <div class="form-group mt-4">
            <label for="secondname">{{ __('Second Name') }}</label>
            <input id="secondname" type="text" class="form-control  border border-primary shadow-sm" name="secondname" value="{{ old('secondname') }}">
            @error('secondname')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="form-group mt-4">
            <label for="email">{{ __('Email') }}</label>
            <input id="email" type="email" class="form-control  border border-primary shadow-sm" name="email" value="{{ old('email') }}" required>
            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group mt-4">
            <label for="password">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control  border border-primary shadow-sm" name="password" required>
            @error('password')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="form-group mt-4">
            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" type="password" class="form-control  border border-primary shadow-sm" name="password_confirmation" required>
            @error('password_confirmation')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Sexe -->
        <div class="form-group mt-4">
            <label for="sexe">{{ __('Sexe') }}</label>
            <select id="sexe" name="sexe" class="form-control  border border-primary shadow-sm" required>
                <option value="male" {{ old('sexe') == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('sexe') == 'female' ? 'selected' : '' }}>Female</option>
            </select>
            @error('sexe')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Civility -->
        <div class="form-group mt-4">
            <label for="civility">{{ __('Civility') }}</label>
            <select id="civility" name="civility" class="form-control  border border-primary shadow-sm">
                <option value="Mr" {{ old('civility') == 'Mr' ? 'selected' : '' }}>Mr</option>
                <option value="Ms" {{ old('civility') == 'Ms' ? 'selected' : '' }}>Ms</option>
                <option value="Dr" {{ old('civility') == 'Dr' ? 'selected' : '' }}>Dr</option>
                <option value="Prof" {{ old('civility') == 'Prof' ? 'selected' : '' }}>Prof</option>
            </select>
            @error('civility')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Phone -->
        <div class="form-group mt-4">
            <label for="phone">{{ __('Phone') }}</label>
            <input id="phone" type="text" class="form-control  border border-primary shadow-sm" name="phone" value="{{ old('phone') }}">
            @error('phone')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Country -->
        <div class="form-group mt-4">
            <label for="country">{{ __('Country') }}</label>
            <input id="country" type="text" class="form-control  border border-primary shadow-sm" name="country" value="{{ old('country') }}">
            @error('country')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- City -->
        <div class="form-group mt-4">
            <label for="city">{{ __('City') }}</label>
            <input id="city" type="text" class="form-control  border border-primary shadow-sm" name="city" value="{{ old('city') }}">
            @error('city')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Profile Photo -->
        <div class="form-group mt-4">
            <label for="profile_photo">{{ __('Profile Photo') }}</label>
            <input id="profile_photo" type="file" class="form-control  border border-primary shadow-sm" name="profile_photo">
            @error('profile_photo')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Couverture Pic -->
        <div class="form-group mt-4">
            <label for="couverture_pic">{{ __('Couverture Picture') }}</label>
            <input id="couverture_pic" type="file" class="form-control  border border-primary shadow-sm" name="couverture_pic">
            @error('couverture_pic')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Occupation -->
        <div class="form-group mt-4">
            <label for="occupation">{{ __('Occupation') }}</label>
            <input id="occupation" type="text" class="form-control  border border-primary shadow-sm" name="occupation" value="{{ old('occupation') }}">
            @error('occupation')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Company Name -->
        <div class="form-group mt-4">
            <label for="company_name">{{ __('Company Name') }}</label>
            <input id="company_name" type="text" class="form-control  border border-primary shadow-sm" name="company_name" value="{{ old('company_name') }}">
            @error('company_name')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Role -->
        <div class="form-group mt-4">
            <label for="role">{{ __('Role') }}</label>
            <select id="role" name="role" class="form-control  border border-primary shadow-sm" required>
                <option value="coach" {{ old('role') == 'coach' ? 'selected' : '' }}>Coach</option>
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
            </select>
            @error('role')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Accepted Terms -->
       <!-- Accepted Terms -->
<div class="form-group mt-4">
    <label for="accepted_terms">
        <input id="accepted_terms" type="checkbox" name="accepted_terms" value="1" {{ old('accepted_terms') ? 'checked' : '' }}>
        {{ __('I accept the terms and conditions') }}
    </label>
    @error('accepted_terms')
        <span class="error-message">{{ $message }}</span>
    @enderror
</div>

        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Register') }}
            </button>
        </div>

        <div class="mt-4">
            <a href="{{ route('login') }}">{{ __('Already registered?') }}</a>
        </div>
    </form>
</div>

@endsection

<!-- Inline CSS for centering everything on the page -->
<style>
    .registration-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f8f9fa;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-control  {
        width: 100%;
        padding: 0.5rem;
        margin-top: 0.25rem;
    }

    .error-message {
        color: red;
        font-size: 0.875rem;
    }

    .btn {
        padding: 0.5rem 1rem;
        font-size: 1rem;
    }
</style>
