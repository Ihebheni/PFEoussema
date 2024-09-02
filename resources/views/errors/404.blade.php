<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 100px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .container img {
            max-width: 100%;
            height: auto;
        }
        .container h1 {
            font-size: 3em;
            margin: 0;
            color: #e74c3c;
        }
        .container p {
            font-size: 1.2em;
            margin: 20px 0;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1em;
            color: #fff;
            background-color: #3498db;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('images/404-image.jpg') }}" alt="404 Not Found">
        <h1>404</h1>
        <p>Sorry, the page you are looking for could not be found.</p>
        <a href="/" class="btn">Go to Homepage</a>
    </div>
</body>
</html>
