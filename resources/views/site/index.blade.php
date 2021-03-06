@extends('layouts.app_front')

@section('header')
  @include('layouts.header')
@stop

@section('pagetitle', 'Home')


@section('content')

<!-- Banner Sec -->

@if(isset($banner_section_block))
		{!!html_entity_decode($banner_section_block->description)!!}
@endif

@if(isset($work_section_block))
		{!!html_entity_decode($work_section_block->description)!!}
@endif

@if(isset($happiness_section_block))
		{!!html_entity_decode($happiness_section_block->description)!!}
@endif
<!-- Banner Sec -->
<section class="banner-sec">
	<div class="inner-banner">
		<div class="container-fluid cont">
			<div class="row">
				<div class="col-sm-12 col-md-6 col-lg-7 col-xl-6 order-sm-1 order-md-2 order-lg-2 order-xl-2">
					<div class="rgt-img">
						<img data-aos="fade-up" src="{{ asset('front/img/balloon.png')}}" alt="ballon" title="" class="img-fluid" />
					</div>
				</div>
				<div class="col-sm-12 col-md-6 col-lg-5 col-xl-6 order-sm-2 order-md-1 order-lg-1 order-xl-1">
					<div class="lft-cnt" >
						<h2 class="">The Gift Registry for Modern Parents</h2>
						<p>Simply create your child's gift page, add curated or custom activities, share with your friends and family, and get what your child wants</p>
						<button class="btn common pink-btn" data-toggle="modal" data-target="#launch">SIGN UP FOR EARLY ACCESS</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>	

<section class="banner-sec-gift">	
	
	<div class="gift-page">
		<div class="container-fluid cont">
			<div class="row">
			<!--	<div class="col-sm-12 col-md-5 col-lg-5">
					<h3>Find a Fynches gift page</h3>
				</div>
				<div class="col-sm-12 col-md-7 col-lg-7">
					<form id-"home-search" method="GET" action="/search">
						<input id="host_name" type="text" name="last_name" placeholder="Search By Hosts Last Name">
						<button>SEARCH</button>
					</form>-->
					
				<div class="col-md-4" style="padding:0px">
				    <div class="col-md-6" style="float:left" id="page-img">
				       <img src="{{ asset('front/img/5bill.png')}}" style="width: 100%;padding:20px 0"/> 
				    </div>
				    <div class="col-md-6" style="float:right;padding:40px 0" id="page-cont">
				        <h3>POUNDS OF RETURNS</h3>
				        <p>Ends up as trash in landfills each year</p>
				    </div>
				</div>
					
				<div class="col-md-4" style="padding:0px">
				   <div class="col-md-6" style="float:left" id="page-img">
				       <img src="{{ asset('front/img/88per.png')}}" style="width: 100%;padding:20px 0"/> 
				    </div>
				    <div class="col-md-6" style="float:right;padding:40px 0" id="page-cont">
				        <h3>of Millennial Parents</h3>
				        <p>Perfer cash gifts to more stuff for child's birthday </p>
				    </div>
				</div>
				
				<div class="col-md-4" style="padding:0px">
				    <div class="col-md-6" style="float:left" id="page-img" >
				       <img src="{{ asset('front/img/7hour.png')}}" style="width: 100%;padding:20px 0"/> 
				    </div>
				    <div class="col-md-6" style="float:right;padding:40px 0" id="page-cont">
				        <h3 style="padding: 0 46px 0 0;">of screen time</h3>
				        <p>Average time per child per day</p>
				    </div>
				</div>
					
					
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End -->
<!-- How It Work Sec -->
<section class="how-it-work">
	<div class="container-fluid cont">
		<div class="row">
			<div class="col-md-12"><h2 class="title">The Old Way Of Gifting Just Doesn't Work Anymore</h2></div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-4 col-lg-4 text-center pt-3">
				<div class="cust-icon"><img src="{{ asset('front/img/help.png')}}" alt="flag" title="" style="width: 50%;"></div>
				<p>Are you drowing in mounds of unused toys and tired of the clutter</p>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 text-center pt-3">
				<div class="cust-icon"><img src="{{ asset('front/img/panda.png')}}" alt="gift" title="" style="width: 100%;margin-top: 40px;" id="panda"></div>
				<p>Are you done dealing with gift duplicates and returns</p>
			</div>
			<div class="col-sm-12 col-md-4 col-lg-4 text-center pt-3">
				<div class="cust-icon"><img src="{{ asset('front/img/tree.png')}}" alt="bird" title="" style="width: 50%;"></div>
				<p>Want to provide more meaningful gifts that help your child grow</p>
			</div>
		</div>
		
	</div>
</section>
<!-- End -->
<!-- Gifts and Experiences Sec -->
<section class="experience">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<h2 class="title">A Simple Solution To A Messy Problem</h2>
				<p>Giving kids experience as gifts doesn't need to be a frustrating process. &nbsp;&nbsp;&nbsp;Fynches makes finding, sharing and gifting activities quick and easy.</p>
				<button class="btn common btn-border" data-toggle="modal" data-target="#launch" style="border:1px solid #fff">SIGN UP FOR EARLY ACCESS</button>
			</div>
		</div>
	</div>
</section>
<!-- End -->
<!-- Gifting Sec -->
<section class="gifting">
	<div class="container-fluid cont">
		<div class="row">
		    <h2 class="col-md-12 title text-center">Here's How It Works</h2>
			<div class="col-md-7 text-left" style="float:left; padding-top: 50px;">
			    <img src="{{ asset('front/img/giftstart.png')}}" alt="bird" title="" style="width: 90%;">
			</div>
			<div class="col-md-5" style="float:right;padding: 70px 40px;">
			    <h6>Create A Gift Page. 100% Free</h6>
			    <ul style="list-style: none;padding:0px">
			        <li>&#10004; &nbsp;&nbsp; Easy as 1-2-3...to Setup and Customize</li>
			        <li>&#10004; &nbsp;&nbsp; Hand Currated Gifts and Experiences</li>
			        <li>&#10004; &nbsp;&nbsp; Locations Based Gift Recommendations</li>
			        <li>&#10004; &nbsp;&nbsp; Perfect for Birthdays and All Ocassions </li>
			    <ul>
			 <button class="btn common purp-btn" data-toggle="modal" data-target="#launch">SIGN UP FOR EARLY ACCESS</button>     
			 <img src="{{ asset('front/img/pinata.png')}}" alt="bird" title="" style="width: 50%;margin:0 50px">
			        
			</div>
			
			<div class="col-md-5" style="float:left;padding: 70px 40px;">
			    <h6>Makes Gifting Easy-Peasy for Parents and their Guests</h6>
			    <ul style="list-style: none;padding:0px">
			        <li>&#10004; &nbsp;&nbsp; Eliminates Duplicate and Un-needed Gifts</li>
			        <li>&#10004; &nbsp;&nbsp; Gift Ideas are Easily Shared and Purchased</li>
			        <li>&#10004; &nbsp;&nbsp; Allows Guests To Give Experiences as Gifts</li>
			        <li>&#10004; &nbsp;&nbsp; Guests Can Contribute to Multiple Gifts </li>
			    <ul>
			 <button class="btn common purp-btn" data-toggle="modal" data-target="#launch">SIGN UP FOR EARLY ACCESS</button>  
			 <img src="{{ asset('front/img/sleep.png')}}" alt="bird" title="" style="width: 70%;margin-top: 20px;">
			</div>
			<div class="col-md-7 text-center" style="float:right">
			 <img src="{{ asset('front/img/giftcre.png')}}" alt="bird" title="" style="width:90%">
			</div>
			
			<div class="col-md-7 text-center" style="float:left; padding-top: 60px;">
			    <img src="{{ asset('front/img/report.png')}}" alt="bird" title="" style="width: 90%;">
			</div>
			<div class="col-md-5" style="float:right;padding: 140px 50px 0px 50px;">
			    <h6>Take The Stress Out of Tracking gifts and Sending Thank You's</h6>
			    <ul style="list-style: none;padding:0px">
			        <li>&#10004; &nbsp;&nbsp; Automatically Generate Gift Reports</li>
			        <li>&#10004; &nbsp;&nbsp; Simple and Quick Gift Redemption</li>
			        <li>&#10004; &nbsp;&nbsp; Easily Track Your Received Gifts</li>
			        <li>&#10004; &nbsp;&nbsp; Quickly Send Thank You's To Guests</li>
			    <ul>
			 <button class="btn common purp-btn" data-toggle="modal" data-target="#launch">SIGN UP FOR EARLY ACCESS</button>     
			 <img src="{{ asset('front/img/mailbird.png')}}" alt="bird" title="" style="width: 50%;">
			        
			</div>
			
		</div>
	</div>
</section>
<!-- End -->
<!-- Testimonial section -->

@include('site.testimonial')
@include('site.user.launch')

<!-- End -->
<!-- Happiness Is Our Mission Sec -->
<section class="our-mission">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<h2 class="title">Made By Parents For Kids</h2>
				<p>Meet Reena, the founder of Fynches. A mom who's on a mission to help make gifting for parents fun, easy, and a lot more meaningful.</p>
				 <img src="{{ asset('front/img/reena.png')}}" alt="bird" title="">
				 <p style="font-size:16px">"Like all moms, I want nothing more than for my daughter to be happy and to experience the world around her. But having family and
				 friends gift activities or experiences for her birthday rather than another toy that I know would go unused was hard. This got me thinking...there must be another way"</p>
			<button class="btn common pink-btn" data-toggle="modal" data-target="#launch" style="margin: 30px;">JOIN ME IN OUR MISSION</button>
			</div>
		</div>
		
	</div>
</section>
<!-- End -->

<!-- SignUp Model -->
@include('site.signup.signup-modal')


<!-- SignUp Model -->
@include('site.user.signin-modal')

@include('site.user.password-modal')



@section('jsscript')
<script type="text/javascript" src="{{ asset('front/common/signup/signup.js')}}"></script>
<script type="text/javascript">	
	$( document ).ready(function() {
		AOS.init({
			duration: 1200,
		});
	});
</script>
@endsection

<!-- SignIn Model -->
<div class="modal fade user-mdl signin" id="signin" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header text-center">
      	<img src="{{ asset('front/img/logo.png')}}" alt="Fynches" title="">
        <h2 class="title">Sign In</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fas fa-times"></i></span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<div class="col-md-12">
      			<form>
      				<div class="form-group">
					  <label for="usr">E-mail<sup>*</sup></label>
					  <input type="text" class="form-control">
					</div>
					<div class="form-group pass">
					  <label for="usr">Password</label>
					  <input type="text" class="form-control">
					</div>
					<a href="javascript:void(0)" class="forgot">Forgot Password</a>
					<div class="btns">
						<button class="btn common pink-btn">SIGN UP WITH EMAIL</button>
						<button class="btn common drk-blue">SIGN UP WITH FACEBOOK</button>
					</div>
      			</form>
      			<p>By creating your Fynches account you agree to your <a href="javascript:void(0)">Term of Use</a> and <a href="javascript:void(0)">Privacy Policy</a>.</p>
      			<p>Already have an account? <a href="javascript:void(0)">Log In</a></p>
      		</div>
      	</div>
      </div>
    </div>
  </div>
</div>
<!-- End -->
@include('site.gift.contact-us')
@endsection