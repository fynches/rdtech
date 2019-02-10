@extends('site.search.search-layout')

@section('header')
    
 <header class="redeem_head">
    <div class="container-fluid cont">
        <div class="row">
            <div class="fheader col-md-6">
                <a class="navbar-brand" href="/">
        	         <img src="/front/img/logo.png" alt="Fynches" title="" id="fyn_logo">
        	    </a>
            </div>
            <div class="col-md-6" id="shop_list" style="font-family: 'Avenir-Book';">
                <div id="div_top_hypers">
                    <ul id="ul_top_hypers">
                        <li><a href="/about">ABOUT</a></li>
                        <li><a href="/blog/" target="_blank">BLOG</a></li>
                        <li><a href="/">CONTACT US</a></li>
                        <li><a href="need-help">HELP</a></li>
                        <li><a href="/">LOG IN</a></li>
                        <li><a href="/" style="cursor: pointer;font-family:Avenir-Light;background-color: #DFF2F6;width: auto;border: 1px solid #f05;border-radius: 25px;color: #f05;font-size: 12px;font-weight: bold;letter-spacing: 2px;padding: 4px 7px;">SIGN UP FREE</a></li>
                    </ul>    
                </div>
            </div>
        </div>
    </div>
</header>
@stop

@section('search_content')
<section class="search_cont">
    <div class="container">
        <div class="row">
            <h5 class="text-center">FIND A GIFT PAGE</h5>
            <div class="form-group col-sm-6 text-center" id="search_input">
                <div class="inner-addon left-addon">
                      <i class="glyphicon glyphicon-search"></i>
                      <input type="text" id="page-search" class="form-control" placeholder="Search By Host's Last Name" />
                </div>
                <div class="loading"></div>
                <p id="search-count" class="text-center">We Found 0 Gift Pages</p>
            </div>
            
            <div id="search-row" class="row search_row" >
                
            </div>
            
        </div>
    </div>
</section>

@stop

@section('footer')
<footer class="footer">
	<div class="container-fluid cont">
		<div class="footer-top">
			<div class="row ">
				<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12 text-left">
					<a href="javascript:void(0)"><img src="/front/img/f-logo.png" alt="logo" title=""></a>
				</div>
				<div class="col-sm-6 col-md-5 col-xs-12 text-center" id="f-menu">
				    <div class="col-md-2 col-xs-2 pad"><a href="/about">ABOUT</a></div>
				    <div class="col-md-2 col-xs-2 pad"><a target="_blank" href="/blog/">BLOG</a></div>
				    <div class="col-md-3 col-xs-3 pad"><a href="#" data-toggle="modal" data-target="#contactPage">CONTACT US</a></div>
				    <div class="col-md-2 col-xs-2 pad"><a href="/help">FAQS</a></div>
				    <div class="col-md-3 col-xs-3 pad"><a href="/search">FIND A GIFT PAGE</a></div>
				</div>
				<div class="col-sm-3 col-md-3 col-xs-12  home text-right">
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
				<div class="col-md-4 col-sm-6 text-left">
					<p style="font-size:14px;font-family:'Avenir-Book',line-height:28px">© 2019 Fynches. All rights reserved</p>
				</div>
				<div class="col-md-8 col-sm-6 text-right">
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
