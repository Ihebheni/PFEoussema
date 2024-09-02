<!doctype html>
<html lang="en">

<!-- Mirrored from demo.themefisher.com/gymfit-bootstrap/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 Jul 2024 21:50:11 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="GYm,fitness,business,company,agency,multipurpose,modern,bootstrap4">

  <meta name="author" content="Themefisher.com">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>GymFit| Fitness template</title>

  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
  <!-- Icofont Css -->
  <link rel="stylesheet" href="plugins/icofont/icofont.min.css">
  <!-- Themify Css -->
  <link rel="stylesheet" href="plugins/themify/css/themify-icons.css">
  <!-- animate.css -->
  <link rel="stylesheet" href="plugins/animate-css/animate.css">
  <!-- Magnify Popup -->
  <link rel="stylesheet" href="plugins/magnific-popup/dist/magnific-popup.css">
  <!-- Owl Carousel CSS -->
  <link rel="stylesheet" href="plugins/slick-carousel/slick/slick.css">
  <link rel="stylesheet" href="plugins/slick-carousel/slick/slick-theme.css">
  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="css/style.css">

  <!-- SweetAlert CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.0/sweetalert2.min.css">

<!-- SweetAlert JS -->


</head>
<body>


<!-- Section Menu Start -->
<!-- Header Start -->
@include('sections.Navbar')
<!-- Header Close -->
<div class="main-wrapper ">
    <!-- Display SweetAlert -->



<!-- Section Menu End -->
<!-- Section Slider Start -->
<!-- Slider Start -->
@include('sections.Start')
<!-- Section Slider End -->
<!-- Section Intro Start -->
@include('sections.Intro')
<!-- Section Intro End -->
<!-- Section About start -->
@include('sections.About')
<!-- Section About End -->
<!-- Section Services Start -->
@include('sections.Services')
<!-- Section Services End -->
<!-- Section Gallery Start -->
@include('sections.Gallery')

<!-- Section Gallery END -->

<!-- Section Testimonial Start -->
@include('sections.Textimonial')
<!-- Section Testimonial END -->

<!-- Section Course Start -->
@include('sections.course')
<!-- Section Course ENd -->
<!-- contact form start -->
@include('sections.contact')
<!-- Section Footer Start -->
<!-- footer Start -->
@include('sections.Footer')
<!-- Section Footer End -->

<!-- Section Footer Scripts -->

    </div>

    <!--
    Essential Scripts
    =====================================-->


    <!-- Main jQuery -->
    <script src="plugins/jquery/jquery.js"></script>
    <!-- Bootstrap 4.3.1 -->
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- Slick Slider -->
    <script src="plugins/slick-carousel/slick/slick.min.js"></script>
    <!--  Magnific Popup-->
    <script src="plugins/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
    <!-- Form Validator -->
    <script src="../../cdnjs.cloudflare.com/ajax/libs/jquery.form/3.32/jquery.form.js"></script>
    <script src="../../cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.11.1/jquery.validate.min.js"></script>
    <!-- Google Map -->
    <script src="plugins/google-map/map.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkeLMlsiwzp6b3Gnaxd86lvakimwGA6UA&amp;callback=initMap"></script>

    <script src="js/script.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.0/sweetalert2.all.min.js"></script>


  </body>

<!-- Mirrored from demo.themefisher.com/gymfit-bootstrap/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 Jul 2024 21:50:51 GMT -->
</html>
