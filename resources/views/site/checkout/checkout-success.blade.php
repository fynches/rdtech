@extends('site.checkout.checkout-layout')

@section('header')
    
 <header class="redeem_head">
    <div class="container-fluid cont">
        <div class="row">
            <div class="col-md-6">
                <a class="navbar-brand" href="http://fynches.codeandsilver.com">
        	         <img src="http://fynches.codeandsilver.com/public/front/img/logo_2.png" alt="Fynches" title="" id="fyn_logo_1">
        	    </a>
            </div>
            <div class="col-md-6" id="shop_list" style="font-family: 'Avenir-Book';">
                <div id="div_top_hypers">
                    <ul id="ul_top_hypers">
                        <li><a href="">ABOUT</a></li>
                        <li><a href="">BLOG</a></li>
                        <li><a href="">CONTACT US</a></li>
                        <li><a href="">HELP</a></li>
                        <li><a href="">LOG IN</a></li>
                        <li style="border: 1px solid #FF0055;border-radius: 25px;"><a href="" style="color:#FF0055">SIGN UP</a></li>
                    </ul>    
                </div>
            </div>
        </div>
    </div>
</header>
@stop


@section('checkout-success-content')
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
                
            <h5 class="text-center">Thank You, Your Payment Was Successful</h5>
            
            <p>We have sent receipt to your email @isset($email->email) at {{$email->email}}@endisset</p>
            
                <img src="http://fynches.codeandsilver.com/public/front/img/reco_5.png">
                <p class="text-center">Try using Fynches for your child's next<br> events. Create an account below</p><br>
                <a href="/parent-child-info"><button class="btn btn-border btn-purp text-center" id="btn_purp">CREATE YOUR OWN GIFT PAGE</button></a><br><br>
            
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
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<a href="javascript:void(0)"><img src="http://fynches.codeandsilver.com/public/front/img/f-logo.png" alt="logo" title=""></a>
				</div>
				<div class="col-sm-6 col-md-6 col-xs-12 text-center" id="f-menu">
				    <div class="col-md-2 col-xs-2 pad"><a href="javascript:void(0)">ABOUT</a></div>
				    <div class="col-md-2 col-xs-2 pad"><a href="javascript:void(0)">BLOG</a></div>
				    <div class="col-md-3 col-xs-3 pad"><a href="#" data-toggle="modal" data-target="#contactPage">CONTACT US</a></div>
				    <div class="col-md-2 col-xs-2 pad"><a href="javascript:void(0)">FAQS</a></div>
				    <div class="col-md-3 col-xs-3 pad"><a href="javascript:void(0)">FIND A GIFT PAGE</a></div>
				</div>
				<div class="col-sm-3 col-md-3 col-xs-12  home">
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
				<div class="col-md-6">
					<p>&copy; 2019 Fynches. All rights reserved</p>
				</div>
				<div class="col-md-6">
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


