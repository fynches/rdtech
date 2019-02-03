@extends('site.checkout.checkout-layout')

@section('header')
    <header class="check_header">
        <div class="container-fluid cont">
            <div class="row">
                <div class="col-md-8">
                    <a class="navbar-brand" href="/">
                        <img src="/front/img/BirdLogo.png" alt="Fynches" title="" style="margin:20px 0">
                    </a>
                </div>
            </div>
        </div>
    </header>
@stop

@section('checkout_content')
    <section class="checkout_content">
        <div class="container-fluid cont">
            <div class="row" id="checkout_cont">
                <div class="col-md-3">
                    <h5>CHECKOUT</h5>
                </div>
                <div class="col-md-3">
                    <p>Already have an account?<a href="#" data-toggle="modal" data-target="#largeModalSI" style="color:#4444ce"> Log In </a></p>
                </div>
                <div class="col-md-3">
                    <p>Don't have an account? <a href="#" data-toggle="modal" data-target="#largeModalS" style="color:#4444ce"> Sign Up </a></p>
                </div>
                <div class="col-md-3">
                    <a href="/gift-page/{{$page->slug}}"><button class="btn common btn-border" id="btn_blk">CONTINUE SHOPPING</button></a>
                </div>
            </div>
        </div>
    </section>

    <section class="step_1">
        <div class="container-fluid cont">
            <div class="row">
                <h5><strong>STEP 1: REVIEW YOUR GIFTS</strong></h5>
                <div class="container cart-items">
                    <h4>YOU HAVE {{count($purchases)}} @if(count($purchases) > 1) GIFTS @else GIFT @endif IN YOUR CART</h4>
                    @foreach($purchases as $purchase)
                        <div class="row step_gift" id="prch-{{$purchase->id}}" >
                            <div class="col-md-6 col-xs-12">
                                <div class="col-md-3 col-xs-3" style="margin-top: 20px;">
                                    <img src="/front/img/Gift.png" />
                                </div>
                                <div class="col-md-9 col-xs-9" style="margin:30px 0" id="gftamt">
                                    <label><strong>{{$purchase->gift->title}}</strong></label>
                                    <p>{{$purchase->gift->description}}</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12" style="margin:30px 0"  >
                                <div class="col-md-4 text-center" >
                                    <p id="step_amt">GIFT AMOUNT</p>
                                </div>
                                <div class="col-md-2 text-center step_price">
                                    <p>
                                        <input class="purchase-amounts" data-id="{{$purchase->id}}" type="text" value="{{$purchase->amount}}">
                                    </p>
                                </div>
                                <div class="col-md-3 text-center step_info" style="padding:0px">
                                    <p>
                                        $<span id="left-{{$purchase->id}}" data-left="{{$purchase->giftBalance()}}" data-price="{{$purchase->gift->price}}">
                                            {{$purchase->giftBalance()}}
                                        </span> LEFT TO FULFILL GIFT</p>
                                </div>
                                <div class="col-md-3 text-center">
                                    <button type="button" data-id="{{$purchase->id}}" class="close remove" aria-label="Close" style="margin: 10px !important;font-size: 2.5em !important;">
                                         <span aria-hidden="true">&times;<h6 style="font-family:'Avenir-Heavy';font-size:8px;line-height:8px;color:#34344A">REMOVE</h6></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="row" id="tot_amt">
                        <div class="col-md-6 "></div>
                        <div class="col-md-6">
                            <div class="row total_amt">
                                <div class="col-md-8 col-xs-7 text-right">
                                    <h1>TOTAL GIFT AMOUNT</h1>
                                </div>
                                <div class="col-md-4  col-xs-5 text-left">
                                    <h5>$ <span id="total">{{$pageTotal}}</span></h5>
                                    <input id="payment-total" type="hidden" value="{{$pageTotal}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="gift_message">
        <div class="container-fluid cont">
            <div class="row">
                <h5><strong>STEP 2 : GIFT MESSAGE</strong></h5>
                <div class="container">
                    <div class="col-md-12 msg_pad">
                        <h6><strong>ENTER GIFT MESSAGE</strong> <span> * Optional</span></h6>
                        <textarea class="col-md-12 col-xs-12" type="text" name="message" id = 'message'></textarea>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="gift_payment">
        <div class="container-fluid cont">
            <h5><strong>STEP 3 : PAYMENT INFORMATION</strong></h5>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pretty p-default p-round">
                            <input id="credit-card" type="radio" name="radio1" checked />
                            <div class="state">
                                <label><img src="/front/img/card.png" style="width: 80%;margin-top: -12px" id="disc_img" /></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <label><i class="fas fa-asterisk"></i>CARDHOLDER NAME</label>
                        <input id="cc_name" type="text" class="form-control" />
                    </div>
                    <div class="col-md-3">
                        <label><i class="fas fa-asterisk"></i>CARD NUMBER</label>
                        <input id="cc_number" type="text" class="form-control" value="" />
                    </div>
                    <div class="col-md-2">
                        <label>
                            <i class="fas fa-asterisk"></i>EXP MONTH
                        </label>
                        <select id="cc_month" class="form-control" value="">
                            <option value = ''>MM</option><option>01</option><option>02</option><option>03</option>
                            <option>04</option><option>05</option><option>06</option><option>07</option>
                            <option>08</option><option>09</option><option>10</option><option>11</option>
                            <option>12</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label>
                            <i class="fas fa-asterisk"></i>EXP YEAR
                        </label>
                        <select id="cc_year" class="form-control" value="">
                            <option value = ''>YYYY</option><option>2019</option><option>2020</option><option>2021</option>
                            <option>2022</option><option>2023</option><option>2024</option><option>2025</option>
                            <option>2026</option><option>2027</option><option>2028</option><option>2029</option>
                            <option>2030</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label><i class="fas fa-asterisk"></i>SECURITY CODE</label>
                        <input id="cc_cvv" type="text" class="form-control" value="" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="gift_bill">
        <div class="container-fluid cont">
            <h5><strong>STEP 4 : BILLING INFORMATION</strong></h5>
            <div class="container">
                <div class="row form-group">
                    <div class="col-md-3">
                        <label>FIRST NAME</label>
                        <input id="cc_fname" type="text" class="form-control" value="" />
                    </div>
                    <div class="col-md-3">
                        <label>LAST NAME</label>
                        <input id="cc_lname" type="text" class="form-control" value="" />
                    </div>
                    <div class="col-md-3">
                        <label><i class="fas fa-asterisk"></i>ADDRESS</label>
                        <input id="cc_address" type="text" class="form-control" value="" />
                    </div>
                    <div class="col-md-3">
                        <label><i class="fas fa-asterisk"></i>CITY/TOWN</label>
                        <input id="cc_city" type="text" class="form-control" />
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2">
                        <label><i class="fas fa-asterisk"></i>STATE</label>
                        <input id="cc_state" type="text" class="form-control" />
                    </div>
                    <div class="col-md-2">
                        <label><i class="fas fa-asterisk"></i>ZIP CODE</label>
                        <input id="cc_zip" type="text" class="form-control" />
                    </div>
                    <div class="col-md-2">
                        <label>COUNTRY</label>
                        <input id="cc_country" type="text" class="form-control" />
                    </div>
                    <div class="col-md-3">
                            <label><i class="fas fa-asterisk"></i>EMAIL</label>
                           <input id="cc_email" type="text" class="form-control" />
                    </div>
                    <div class="col-md-3">
                        <label><i class="fas fa-asterisk"></i>CONFIRM EMAIL</label>
                       <input id="cc_confirm" type="text" class="form-control" />
                    </div>
                </div>
                <div class = 'row form-group'>
                    <div id = 'error' class = 'col-md-12'></div>
                </div>
                <div class="row form-group">
                    <a id="place-order" href="" class="btn btn-primary">PLACE ORDER  <i class="fa fa-lock" aria-hidden="true" style="margin: 10px;border: 1px solid;border-radius: 25px;padding: 5px;"></i></a>
                </div>
            </div>
        </div>
    </section>

    @include('modal.signup');
    @include('modal.signin');
{{--@include('site.signup.signup-modal')--}}
{{--@include('site.user.signin-modal')--}}
{{--@include('site.user.password-modal')--}}
@stop



@section('footer')
<footer class="footer">
	<div class="container" style="max-width: 1000px;">
		<div class="footer-top">
			<div class="row text-center">
				<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
					<a href="javascript:void(0)"><img src="/front/img/f-logo.png" alt="logo" title=""></a>
				</div>
				<div class="col-sm-6 col-md-6 col-xs-12 text-center" id="f-menu">
				    <div class="col-md-2 col-xs-2 pad"><a href="/about-us">ABOUT</a></div>
				    <div class="col-md-2 col-xs-2 pad"><a target="_blank" href="/blog/">BLOG</a></div>
				    <div class="col-md-3 col-xs-3 pad"><a href="#" data-toggle="modal" data-target="#contactPage">CONTACT US</a></div>
				    <div class="col-md-2 col-xs-2 pad"><a href="/need-help">FAQS</a></div>
				    <div class="col-md-3 col-xs-3 pad"><a href="/search">FIND A GIFT PAGE</a></div>
				</div>
				<div class="col-sm-3 col-md-3 col-xs-12  home">
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
			<div class="row text-center">
				<div class="col-md-6 col-sm-6">
					<p>&copy; {{ date('Y') }} Fynches. All rights reserved</p>
				</div>
				<div class="col-md-6 col-sm-6">
					<ul>
						<li><a href="/privacy-policy">Privacy Policy</a></li>
						<li><a href="/terms-condition">Terms and Conditions</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</footer>
@stop
