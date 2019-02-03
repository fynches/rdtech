@extends('site.account.account')

@section('header')
    <header>
        <div class="container-fluid cont ">
            <div class="row">
                <div class="fheader col-md-8">
                  <a class="navbar-brand" href="/">
        	         <img src="/front/img/logo.png" alt="Fynches" title="" id="fyn_logo">
        	        </a>
                </div>
                <div class="col-md-4">
                    <div class="fmenu" id="div_top_hypers">
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
                           </div>
                         </ul>
</div>
                </div>
            </div>
        </div>    
    </header>
    
@stop 

@if (\Request::is('password-reset')) 
@section('account_info')
<div id="acc" class="account-body">
        <div class="row">
            <div class="col-sm-3" >
            </div>    
            <div class="col-sm-9" >    
              <form id="accPass" onsubmit="event.preventDefault();">
              <div class="form-row">
              <div class="form-group col-md-6">
                <label for="npass">New Password</label>
                <input type="password" class="form-control" id="npass" required>
                <input type="hidden" class="form-control" id="no-cn" value="1">
              </div>
              </div>
              <div id="pass-row" class="form-row">
              <div class="form-group col-md-6">
                <label for="cnpass">Confirm New Password</label>
                <input type="password" class="form-control" id="cnpass" required>
              </div>
              </div>
              <div class="form-row">
                        <div class="col-md-6" style="padding:0px">
                            <input id="accPass-submit" type="submit" class="purple-submit pointer" value="SUBMIT PASSWORD">
                        </div>
                    </div>  
            </form>
         </div>
     </div>
   </div>  
@stop  
@else 


@section('account_info')

    <div id="acc" class="account-body">
        <div class="row">
            <div class="col-sm-3 " >
                <h5 style="font-weight:bold">  ACCOUNT SETTINGS </h5>
                <ul>
                <li id="accN" class="pointer" style="font-weight:bold;">  Account Info</li>
                <li id="accE" class="pointer"> Email Preferences</li>
                <li id="accP" class="pointer"> Privacy</li>
                <li id="accCP" class="pointer"> Change Password</li>
                <ul>
            </div>
    
        
       
   
    
    
    <div id="acc_name" class="col-sm-9 ">
        @include('site.account.name')
        </div>  
       
   
    <div id="acc_email" class="col-sm-9 "  style="display:none;" >
        @include('site.account.email')
    </div>
    
    
    <div id="acc_priv" class="col-sm-9 " style="display:none;"  >
        @include('site.account.privacy')
    </div>
     
    <div id="acc_pass"   class="col-sm-9 "  style="display:none;">
        @include('site.account.password')
    </div>
    
     </div>
    </div>
    </div>
    </div>
   
    
    
    
@stop 
    
@endif 

@section('footer')
<footer class="footer">
	<div class="container-fluid cont">
		<div class="footer-top">
			<div class="row align-items-center">
				<div class="col-sm-12 col-md-3 col-lg-3">
					<a href="javascript:void(0)"><img src="{{ asset('front/img/f-logo.png')}}" alt="logo" title=""></a>
				</div>
				<div class="col-sm-12 col-md-6 col-lg-6 text-center">
					<ul class="f-menu">
						<li><a href="/about-us">ABOUT</a></li>
						<li><a target="_blank" href="/blog/">BLOG</a></li>
						<li><a href="#" data-toggle="modal" data-target="#contactPage">CONTACT US</a></li>
						<li><a href="/need-help">FAQS</a></li>
						<li><a href="/search">FIND A GIFT PAGE</a></li>
					</ul>
				</div>
				<!--col-sm-12 col-md-6 col-lg-6 text-center-->
				<div class="col-sm-12 col-md-3 col-lg-3 text-right home">
					<ul class="social">
						<li><a href="https://twitter.com/fynches" target="blank"><i class="fab fa-twitter"></i></a></li>
						<li><a target="_blank" href="https://www.facebook.com/usefynches/"><i class="fab fa-facebook-f"></i></a></li>
						<li><a target="_blank" href="https://www.instagram.com/fynches/"><i class="fab fa-instagram"></i></a></li>
						<li><a target="_blank" href="https://www.pinterest.com/usefynches/"><i class="fab fa-pinterest-p"></i></a></li>
					</ul> 
				</div>
			</div>
		</div>
		<div class="footer-btm home-btm">
			<div class="row align-items-center">
				<div class="col-md-7 col-lg-7">
					<p>&copy; 2019 Fynches. All rights reserved</p>
				</div>
				<div class="col-md-5 col-lg-5 text-right">
					<ul>
						<li><a href="/privacy-policy" style="font-size:12px;font-family:'Avenir-Book',line-height:16px;letter-spacing:1.2px">Privacy Policy</a></li>
						<li><a href="/terms-condition" style="font-size:12px;font-family:'Avenir-Book',line-height:16px;letter-spacing:1.2px">Terms and Conditions</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</footer>
@stop