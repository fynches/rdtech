@extends('site.redeem.redeem-layout')

@section('header')
    
 <header class="redeem_head">
    <div class="container-fluid cont">
        <div class="row">
            <div class="col-md-8 fheader">
                <a class="navbar-brand" href="http://fynches.codeandsilver.com">
        	         <img src="http://fynches.codeandsilver.com/public/front/img/logo_2.png" alt="Fynches" title="" id="fyn_logo_1">
        	    </a>
            </div>
            <div class="col-md-4" id="shop_list">
                <div id="div_top_hypers">
                    <ul id="ul_top_hypers">
                        <li><a href="" class="a_top_hypers"> HELP</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">MY ACCOUNT <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/account">ACCOUNT SETTINGS</a></li>
                                <li><a href="/gift-dashboard">DASHBOARD</a></li>
                                <li><a href="{{ url('/logout') }}">LOGOUT</a></li>
                            </ul>
                        </li>
                    </ul>    
                </div>
            </div>
        </div>
    </div>
</header>
@stop


@section('redeem-success')
<section class="dash_link">
    <div class="container-fluid cont">
        <div class="row">
            <div class="col-md-12">
                <h5><a href="/gift-dashboard">BACK TO DASHBOARD</a></h5>
            </div>
        </div>
    </div>
</section>

<section class="redeem-success">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="http://fynches.codeandsilver.com/public/front/img/reco_5.png">
           
            <h5 class="text-center">Your Gift Redemption of $100.00 was Successful!</h5>
            <p class="text-center">Please allow 5 for the funds to be deposited in your account.<br>We have sent an email confirmation to the following address.</p><br>
            <p class="text-center">someone@something.com</p>
            
           
                <img src="http://fynches.codeandsilver.com/public/front/img/reco_6.png">
            </div>
            
        </div>
    </div>
</section>
@stop


@section('footer')
<footer class="footer">
	<div class="container">
		<div class="footer-top">
			<div class="row align-items-center">
				<div class="fheader topheader col-sm-12 col-md-3 col-lg-3">
					<a href="javascript:void(0)"><img src="http://fynches.codeandsilver.com/public/front/img/f-logo.png" alt="logo" title=""></a>
				</div>
				<div class="fheader col-sm-12 col-md-6 col-lg-6 text-center">
					<ul class="f-menu">
						<li><a href="javascript:void(0)">ABOUT</a></li>
						<li><a href="javascript:void(0)">BLOG</a></li>
						<li><a href="javascript:void(0)">CONTACT US</a></li>
						<li><a href="javascript:void(0)">FAQS</a></li>
						<li><a href="javascript:void(0)">FIND A GIFT PAGE</a></li>
					</ul>
				</div>
				<div class="fheader col-sm-12 col-md-3 col-lg-3 text-right home">
					<ul class="social">
						<li><a href="javascript:void(0)"><i class="fab fa-twitter"></i></a></li>
						<li><a href="javascript:void(0)"><i class="fab fa-facebook-f"></i></a></li>
						<li><a href="javascript:void(0)"><i class="fab fa-instagram"></i></a></li>
						<li><a href="javascript:void(0)"><i class="fab fa-pinterest-p"></i></a></li>
					</ul> 
				</div>
			</div>
		</div>
		<div class="footer-btm home-btm">
			<div class="row align-items-center">
				<div class=" fheader col-md-7 col-lg-7">
					<p>&copy; 2019 Fynches. All rights reserved</p>
				</div>
				<div class="fheader col-md-5 col-lg-5 text-right">
					<ul>
						<li><a href="javascript:void(0)">Privacy Policy</a></li>
						<li><a href="javascript:void(0)">Terms and Conditions</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</footer>
@stop


