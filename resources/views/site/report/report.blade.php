@extends('site.report.report-layout')

@section('header')
    
 <header class="report_head">
    <div class="container-fluid cont">
        <div class="row">
            <div class="col-md-8" id="report-cent">
                <a class="navbar-brand" href="http://fynches.codeandsilver.com">
        	         <img src="http://fynches.codeandsilver.com/public/front/img/logo.png" alt="Fynches" title="" id="fyn_logo">
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

@section('report_content')

<section class="dash_link">
    <div class="container-fluid cont">
        <div class="row">
            <div class="col-md-12">
                <h5><a href="/gift-dashboard">BACK TO DASHBOARD</a></h5>
            </div>
        </div>
    </div>
</section>

<!-- Layer2-->
<section class="gift_report">
    <div class="container-fluid cont">
        <div class="row">
            <h1 class="text-center" id="report_head">GIFT REPORT</h1>
            
            <div class="container gift_marg">
                <div class="col-md-3 col-sm-3  text-center">
                    <h1>${{$purchases}}</h1>
                    <p>OF ${{$requested}}<br>REQUESTED</p>
                </div>
                <div class="col-md-3 col-sm-3 text-center">
                    <h1>{{$count}}</h1>
                    <p>TOTAL NUMBER<br>OF GIFTS</p>
                </div>
                <div class="col-md-3 col-sm-3  text-center">
                    <h1>${{$avaerage}}</h1>
                    <p>AVERAGE AMOUNT <br>PER GIFT</p>
                </div>
                <div class="col-md-3 col-sm-3  text-center">
                    <h1>${{$bank}}</h1>
                    <p>CURRENT BALANCE<br><a href="/redeem-gifts" style="color:#4444ce">VIEW</a></p>
                </div>
            </div>
            
            @foreach($gift_purchases as $purchase)
            <div class="purchases">
            <div class="row" id="report_info">
                <div class="col-md-3 col-sm-2 text-center">
                    <h5>{{$purchase->name}}</h5>
                </div>
                <div class="col-md-3 col-sm-4 text-center">
                    <h5>{{$purchase->email}}</h5>
                </div>
                <div class="col-md-3 col-sm-4 text-center">
                    @php 
                        $stime = strtotime($purchase->created_at);
                        $date = date('F jS Y', $stime);
                    @endphp
                     <h5>{{$date}}</h5>
                </div>
                <div class="col-md-3 col-sm-2 text-center">
                    <div class="col-md-6 col-sm-6"><h5>${{$purchase->amount}} </h5></div> <div class="arrow-up"></div>
                </div>
            </div>
            
            <div class="row" id="report_tab">
                <div class="col-md-1 col-sm-2 col-xs-4 text-center">
                   <img src="{{$purchase->child->recipient_image}}" style="width: 100%;">
                </div>
                <div class="col-md-2 col-sm-3 text-center" id="report-cent">
                    <h5>{{$purchase->gift->title}}</h5>
                </div>
                <div class="col-md-6 col-sm-5">
                     <div class="col-md-2 col-sm-2">
                     <h5>Message:</h5>
                     </div>
                     <div class="col-md-10 col-sm-10" style="padding-left: 0px;">
                         <p style="margin-top: 10px;">{{$purchase->message}}</p>
                     </div>     
                </div>
                <div class="col-md-3 col-sm-2 text-center" id="report-cent">
                    <button class="btn btn-border yellow-submit" data-toggle="modal" data-target="#thank_you"> SEND THANK YOU</button>
                </div>
            </div>
            </div>
            @endforeach
            
            <div class="row" id="report_trans">
                <div class="col-md-3 col-sm-3  text-center">
                    <h5><strong>Transaction ID :</strong> f8mrcnnn</h5>
                </div>
                
                <div class="col-md-3 col-sm-3 text-center">
                    <h5><strong>Date Posted:</strong> 11/27/2018 11:23:55 EST </h5>
                </div>
                
                <div class="col-md-6 col-sm-6 text-center">
                    <p>Total amount listed after service fee paid. See <a href="#" style="color:#4444ce;text-decoration:underline">FAQ's</a> for more information</p>
                </div>
                
            </div>
            
        </div>
    </div>
</section>
@include('site.redeem.thank-you')
@stop


@section('footer')
<footer class="footer">
	<div class="container-fluid cont">
		<div class="footer-top">
			<div class="row ">
				<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12 text-left" id="foot_img">
					<a href="javascript:void(0)"><img src="https://fynches.codeandsilver.com/public/front/img/f-logo.png" alt="logo" title=""></a>
				</div>
				<div class="col-sm-5 col-md-5 col-xs-12 text-center" id="f-menu">
				    <div class="col-md-2 col-xs-2 pad"><a href="/about-us">ABOUT</a></div>
				    <div class="col-md-2 col-xs-2 pad"><a target="_blank" href="https://fynches.com/blog/">BLOG</a></div>
				    <div class="col-md-3 col-xs-3 pad"><a href="#" data-toggle="modal" data-target="#contactPage">CONTACT US</a></div>
				    <div class="col-md-2 col-xs-2 pad"><a href="/need-help">FAQS</a></div>
				    <div class="col-md-3 col-xs-3 pad"><a href="/search">FIND A GIFT PAGE</a></div>
				</div>
				<div class="col-sm-3 col-md-3 col-xs-12  home text-right" style="padding: 0px;">
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
		    <div class="container-fluid">
			<div class="row align-items-center">
				<div class="col-md-4 col-sm-6 text-left" id="foot_img">
					<p style="font-size:14px;font-family:'Avenir-Book',line-height:28px">© 2019 Fynches. All rights reserved</p>
				</div>
				<div class="col-md-8 col-sm-6 text-right" id="foot_img">
					<ul>
						<li><a href="/privacy-policy" style="font-size:12px;font-family:'Avenir-Book',line-height:16px;letter-spacing:1.2px">Privacy Policy</a></li>
						<li><a href="/terms-condition" style="font-size:12px;font-family:'Avenir-Book',line-height:16px;letter-spacing:1.2px">Terms and Conditions</a></li>
					</ul>
				</div>
			</div>
			</div>
		</div>
	</div>
</footer>
@stop
