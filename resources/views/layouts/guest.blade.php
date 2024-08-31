<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Application' }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Guest Layout Styles */
        .guest-layout {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .error-message {
            color: red;
            font-size: 0.875rem;
            margin-top: 4px;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .forgot-password {
            color: #007bff;
            text-decoration: none;
            font-size: 0.875rem;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .submit-button {
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: white;
            font-size: 1rem;
            cursor: pointer;
        }

        .submit-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="guest-layout">
        <header class="mb-6">
            <h1>Welcome to Our Application</h1>
        </header>
        @yield('content')
    </div>
</body>
</html>
