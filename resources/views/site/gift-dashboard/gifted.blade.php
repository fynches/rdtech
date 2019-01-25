@extends('site.gift-dashboard.gift-info')
@section('header')
    <header id="gift-dash">
        <div class="container-fluid">
            <div class="row">
                <div class="fheader col-md-8 col-sm-7">
                    <a class="navbar-brand" href="/">
                        <img src="/front/img/logo.png" alt="Fynches" title="" id="fyn_logo">
                    </a>
                </div>
                <div class="col-md-4">
                    <div class="fmenu"id="div_top_hypers">
                        <ul class="ul_top_hypers" id="ul_top_hypers">
                            <li><a href="" class="a_top_hypers">HELP</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">MY ACCOUNT <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu" style="padding: 0px;">
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

@section('content')
<div class="container-fluid gift-dashboard">
    <div class="row" style="margin-top:50px;">
        <div class="col-md-2" id="dashboard-list">
            <ul class="dashboard-list">
                <h4>DASHBOARD</h4>
                <li><a href="/gift-dashboard">Gift Pages</a></li>
                <li><a href="/gifted">Gifted</a></li>
            </ul>
        </div>
        <div class="col-md-9 dashboard-items">
            <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-4" style="padding:0px">
                    <h3>Gifted</h3>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-8 text-center">
                    <a href="/parent-child-info" style="color:#fff;margin-left:auto" class="pointer"><button class="create-gift" style="margin-left:auto;">CREATE GIFT PAGE</button></a>
                </div>
            </div>
            @foreach($user->completedPurchases() as $purchase)
                <div class="marg-dash">
                    <div class="row" style="margin-top:20px;">
                        <div class="col-md-2 col-sm-2 col-xs-4">
                            <img src="{{ $purchase->page->child->image }}" width="100" />
                        </div>
                        <div class="col-md-10 col-sm-10 col-xs-8">
                            <h4>{{$purchase->gift->title}}</h4>
                            <p>{{$purchase->gift->description}}</p>
                        </div>
                    </div>
                    <div class="row" style="margin-top:30px;">
                        <div class="col-md-2 "></div>
                        <div class="col-md-3 col-xs-4">
                            <p class="gifted_right" style="font-size:14px;line-height:14px;color:#34344A">Gifted To: {{$purchase->page->child->first_name}}</p>
                        </div>
                        <div class="col-md-4 col-xs-4">
                            <p style="font-size:14px;line-height:14px;color:#34344A">Gifted ${{$purchase->amount}} of ${{$purchase->gift->price}} Requested</p>
                        </div>
                        <div class="col-md-3 col-xs-4">
                            <p class="gifted_too_left" style="font-size:14px;line-height:14px;color:#34344A">Gifted On: {{ date('m/d/Y', strtotime($purchase->created_at)) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
 
@section('footer')
<footer class="footer">
	<div class="container-fluid cont">
		<div class="footer-top">
			<div class="row ">
				<div class="col-sm-3 col-md-4 col-lg-4 col-xs-12 text-left" id="foot-cent">
					<a href="javascript:void(0)"><img src="/front/img/f-logo.png" alt="logo" title=""></a>
				</div>
				<div class="col-sm-6 col-md-5 col-xs-12 text-center" id="f-menu">
				    <div class="col-md-2 col-xs-2 pad"><a href="/about-us">ABOUT</a></div>
				    <div class="col-md-2 col-xs-2 pad"><a target="_blank" href="/blog">BLOG</a></div>
				    <div class="col-md-3 col-xs-3 pad"><a href="#" data-toggle="modal" data-target="#contactPage">CONTACT US</a></div>
				    <div class="col-md-2 col-xs-2 pad"><a href="/need-help">FAQS</a></div>
				    <div class="col-md-3 col-xs-3 pad"><a href="/search">FIND A GIFT PAGE</a></div>
				</div>
				<div class="col-sm-3 col-md-3 col-xs-12  home text-right" id="foot-cent">
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
				<div class="col-md-4 col-sm-6 text-left" id="foot-cent">
					<p style="font-size:14px;font-family:'Avenir-Book',line-height:28px">© 2019 Fynches. All rights reserved</p>
				</div>
				<div class="col-md-8 col-sm-6 text-right" id="foot-cent">
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
