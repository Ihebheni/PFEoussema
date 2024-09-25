<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" type="image/png" href="{{asset('images/iconnn.png')}}" />
    <title>GymNationTN:</title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{asset('assets/css/nucleo-icons.css" rel="stylesheet')}}" />
    <link href="{{asset('assets/css/nucleo-svg.css" rel="stylesheet')}}" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{asset('assets/css/material-dashboard.css?v=3.1.0')}}" rel="stylesheet" />
    <style>
        body {
            margin: 0;
            padding: 0;
            display:grid;
            justify-content: center; /* Center horizontally */
            align-items: center;     /* Center vertically */
            min-height: 100vh;       /* Ensure the body takes the full height of the viewport */
            background: #ffffff;
        }

        form {
            background-color: white; /* Optionally add a background for the form */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;        /* Set a max-width to avoid the form being too large */
            margin: auto ;
        }
    </style>


</head>
<body>
    <nav>
        
    </nav>
    <div class="container-fluid py-4">
        <header class="mb-6">
            <h1>Welcome to Our Application</h1>
        </header>
        @yield('content')
    </div>


    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>


</body>
</html>
