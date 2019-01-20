<header>
	<nav class="navbar navbar-expand-lg navbar-default beta-pg">
		<div class="container-fluid cont">
			<a class="navbar-brand navbar-left" href="/">
				<img src="{{asset('front/img/Bird3x.png')}}" alt="Fynches" title="" >
			</a>
			<button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
				<span> </span>
				<span> </span>
				<span> </span>
			</button>
			<div class="collapse navbar-collapse" id="collapsingNavbar">
				<ul class="nav navbar-nav ml-auto navbar-right">
					<li class="nav-item">
						<a class="nav-link" href="/about-us">ABOUT</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" target="_blank" href="/blog">BLOG</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#" data-toggle="modal" data-target="#contactPage">CONTACT US</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/need-help">HELP</a>
					</li>
					@if(Auth::check())
						<li class="nav-item">
							<a class="nav-link" href="/gift-dashboard">DASHBOARD</a>
						</li>
					@else
						<li class="nav-item">
							<a class="nav-link" href="#" style="cursor: pointer;" data-toggle="modal" data-target="#largeModalSI" >LOGIN</a>
						</li>
						<li class="nav-item">
							<a class="btn common pink-btn" style="cursor: pointer;background-color: #DFF2F6;width: auto;border: 1px solid #f05;border-radius: 25px;color: #f05;font-size: 12px;font-weight: bold;letter-spacing: 2px;padding: 4px 7px;" data-toggle="modal" data-target="#largeModalS">SIGN UP FREE</a>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>
</header>