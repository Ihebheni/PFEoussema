<section class="slider">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
                <span class="h6 d-inline-block mb-4 subhead text-uppercase">Your Ultimate Fitness Destination</span>
                <h1 class="text-uppercase text-white mb-5">Elevate Your <span class="text-color">Fitness Challenge</span><br>with GymNationTN</h1>
                <a href="{{ auth()->check() ? route(auth()->user()->role . '.dashboard') : route('login') }}" class="btn btn-main">
                    {{ auth()->check() ? 'Home' : 'Join Us' }} <i class="ti-angle-right ml-3"></i>
                </a>

            </div>
		</div>
	</div>
</section>
