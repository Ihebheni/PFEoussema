
<nav class="navbar navbar-expand-lg navigation fixed-top" id="navbar">
	<div class="container-fluid">
	  <a class="navbar-brand" href="index.html">
	  		<h2 class="text-white text-capitalize"></i>Gym<span class="text-color">Fit</span></h2>
	  </a>

	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsid" aria-controls="navbarsid" aria-expanded="false" aria-label="Toggle navigation">
		<span class="ti-view-list"></span>
	  </button>

	  <div class="collapse text-center navbar-collapse" id="navbarsid">
		<ul class="navbar-nav mx-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item"><a class="nav-link" href="#About">About</a></li>
              <li class="nav-item"><a class="nav-link" href="#Services">Services</a></li>
              <li class="nav-item"><a class="nav-link" href="#Gallery">Gallery</a></li>
              <li class="nav-item"><a class="nav-link" href="#Textimonial">Textimonial</a></li>
              <li class="nav-item"><a class="nav-link" href="#Course">Course</a></li>

               <li class="nav-item"><a class="nav-link" href="#contactus">Contact</a></li>
		   {{-- <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages.</a>
				<ul class="dropdown-menu  text-center" aria-labelledby="dropdown03">
				  <li><a class="dropdown-item" href="about.html">About</a></li>
				  <li><a class="dropdown-item" href="trainer.html">Trainer</a></li>
				  <li><a class="dropdown-item" href="course.html">Courses</a></li>
				</ul>
		  </li>
		   <li class="nav-item"><a class="nav-link" href="service.html">Services</a></li>
		   <li class="nav-item"><a class="nav-link" href="pricing.html">Memebership</a></li>
		   <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Blog.</a>
				<ul class="dropdown-menu  text-center text-lg-left" aria-labelledby="dropdown05">
				  <li><a class="dropdown-item" href="blog.html">Blog Grid</a></li>
				  <li><a class="dropdown-item" href="blog-sidebar.html">Blog Sidebar</a></li>
				  <li><a class="dropdown-item" href="blog-single.html">Blog Details</a></li>
				</ul>
		  </li>
		   <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li> --}}
		</ul>
        <div class="d-flex flex-column flex-lg-row justify-content-lg-end align-items-center mt-4 mt-lg-0 mb-3 mb-lg-0">
            @if (Route::has('login'))
                <div class="text-lg-right">
                    @auth
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle font-semibold text-gray-600 dark:text-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 rounded-sm" type="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            @if (Auth::user()->role == 'admin')
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-tachometer-alt"></i> Admin Dashboard
                                </a>
                            @elseif (Auth::user()->role == 'coach')
                                <a class="dropdown-item" href="{{ route('coach.dashboard') }}">
                                    <i class="fas fa-tachometer-alt"></i> Coach Dashboard
                                </a>
                            @elseif (Auth::user()->role == 'user')
                                <a class="dropdown-item" href="{{ route('user.dashboard') }}">
                                    <i class="fas fa-tachometer-alt"></i> User Dashboard
                                </a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary font-semibold text-white focus:outline-none focus:ring-2 focus:ring-red-500 rounded-sm">
                            <i class="fas fa-sign-in-alt"></i> Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-success ml-4 font-semibold text-white focus:outline-none focus:ring-2 focus:ring-red-500 rounded-sm">
                                <i class="fas fa-user-plus"></i> Register
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>




	</div>
</nav>
