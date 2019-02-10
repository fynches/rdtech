@extends('site.redeem.redeem-layout')

@section('header')
    
 <header class="redeem_head">
    <div class="container-fluid cont">
        <div class="row">
            <div class="fheader col-md-8">
                <a class="navbar-brand" href="/">
        	         <img src="/front/img/logo.png" alt="Fynches" title="" id="fyn_logo">
        	    </a>
            </div>
            <div class="fheader col-md-4" id="shop_list">
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

@section('redeem_content')

    <section class="dash_link">
        <div class="container-fluid cont">
            <div class="row">
                <div class="col-md-12">
                    <h5><a href="/gift-dashboard">BACK TO DASHBOARD</a></h5>
                </div>
            </div>
        </div>
    </section>

    <section class="redeem_gift">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>REDEEM GIFTS</h1>
                    <p>Fynches makes it easy for you to redeem your gifts.Simply check your
                        <br> balance and setup your payment account so you can receive gifts</p>
                </div>
            </div>
            @if($errors->any())
                <div class = 'row'>
                    <div class = 'col-md-12 alert alert-danger'>
                        {!! implode('<br/>', $errors->all()) !!}
                    </div>
                </div>
            @endif
        </div>
    </section>

    <section class="gift_table">
        <div class="container">
            <h5 class="gift_header">GIFT BALANCE</h5>
            <div class="row" id="gift-border">
                <div class="col-md-6 text-left">
                    <p>Total Balance</p>
                </div>
                <div class="col-md-6 text-right">
                    <p>${{ number_format($total, 2) }}</p>
                </div>
            </div>
            <div class="row" id="gift-border">
                <div class="col-md-6 text-left">
                    <p>72 Hour Hold Balance <a href="#">What does this mean</a></p>
                </div>
                <div class="col-md-6 text-right">
                    <p> - ${{ number_format($hold, 2) }}</p>
                </div>
            </div>
            <div class="row" id="gift-border">
                <div class="col-md-6 text-left">
                    <p>Previous Withdrawals</p>
                </div>
                <div class="col-md-6 text-right">
                    <p> - ${{ number_format($previous, 2) }}</p>
                </div>
            </div>
            <div class="row" id="gift-total">
                <div class="col-md-11 text-right">
                    <h5>TOTAL AVAILABLE BALANCE</h5>
                </div>
                <div class="col-md-1 text-left">
                    <h5 class="gift_second">${{ number_format($available, 2) }}</h5>
                </div>
            </div>
        </div>
    </section>

    @if($available)
        <section class="gift_bank">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6 text-left">
                        <div class="col-md-6" style="padding:0px"><h5>BANK INFO <img src="/front/img/dollar.png" style="width: 10%;margin-top: -10px;"></h5></div>
                    </div>
                    <div class="col-md-6 text-right">
                        <img src="/front/img/stripe.png" style="margin: 10px;">
                    </div>
                </div>
            </div>
            @if($user->stripeAccounts && count($user->stripeAccounts))
                <div class = 'row'>
                    <div class = 'col-md-6'>
                        <form id = 'formWithAccount' method="post" action = '/redeem-gifts-account'>
                            {{ csrf_field() }}
                            <label>Select an account</label>
                            <select id = 'selectAccount' class = 'form-control' name = 'stripeAccount'>
                                <option value = ''>Select a bank account</option>
                                @foreach($user->stripeAccounts as $account)
                                    <option value = '{{ $account->id }}'>{{ $account->bank_name . ' - ' . $account->last4 }}</option>
                                @endforeach
                                <option value = 'new'>Add a new bank account</option>
                            </select>
                        </form>
                    </div>
                    <div class = 'col-md-6'>
                        <button id = 'buttonRedeemFromAccount' class = 'btn btn-primary' style = 'display: none; margin-top: 25px;'>REDEEM ${{ number_format($available, 2) }} <i class = 'fa fa-lock'></i></button>
                    </div>
                </div>
            @endif
            <div id = 'formWrapper' {!! ($user->stripeAccounts && count($user->stripeAccounts)) ? "style = 'display: none'" : '' !!}>
                <div class="row">
                    <div class="col-md-12">
                        <p>We've partnered with Stripe to make receiving your money safe and easy. All funds are transferred through ACH Electronic Check, and funds arrive in your bank account
                            within 5 business days.<br><br>
                            Please enter your banking info below. At the bottom of your personal checks,there are three sets of numbers. Your routing number is a set of nine digits
                            and your account number is typically 3 - 17 digits.</p>
                        <div class="col-md-4">
                            <img src="/front/img/bank.png" style="width: 100%;">
                        </div>
                    </div>
                </div>
                <form method="post" action = '/redeem-gifts'>
                    {{ csrf_field() }}
                    <div class="row form-group">
                        <div class="col-md-4">
                            <label>Bank Name</label>
                            <input type="text" class="form-control" name = 'bankName' value = '{{ old('bankName') }}' />
                        </div>
                        <div class="col-md-4">
                            <label>Routing Number (9 digits number)</label>
                            <input type="text" class="form-control" name = 'routing' value = '{{ old('routing') }}' />
                        </div>
                        <div class="col-md-4">
                            <label>Account Number (3 - 17 digits)</label>
                            <input type="text" class="form-control" name = 'account' value = '{{ old('account') }}' />
                        </div>
                    </div>
                    <div class = 'row form-group'>
                        <div class = 'col-md-4'>
                            <label>
                                Birthday Day
                            </label>
                            <select name = 'day' class = 'form-control'>
                                <option value = ''>Select Day</option>
                                @for($i = 1; $i <= 31; $i++)
                                    <option {{ old('day') == $i ? "selected = 'selected'" : '' }} value = '{{ $i }}'>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class = 'col-md-4'>
                            <label>
                                Birthday Month
                            </label>
                            <select name = 'month' class = 'form-control'>
                                <option value = ''>Select Month</option>
                                @for($i = 1; $i <= 12; $i++)
                                    <option {{ old('month') == $i ? "selected = 'selected'" : '' }} value = '{{ $i }}'>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class = 'col-md-4'>
                            <label>
                                Birthday Year
                            </label>
                            <select name = 'year' class = 'form-control'>
                                <option value = ''>Select Year</option>
                                @for($i = 1; $i <= 100; $i++)
                                    <option value = '{{ date('Y') - (17 + $i) }}' {{ old('year') == date('Y') - (17 + $i) ? "selected = 'selected'" : '' }} >{{ date('Y') - (17 + $i) }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class = 'row form-group'>
                        <div class="col-md-4">
                            <label>First Name</label>
                            <input type="text" class="form-control" name = 'firstName' value = '{{ old('firstName') ? old('firstName') : $user->first_name }}' />
                        </div>
                        <div class="col-md-4">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name = 'lastName' value = '{{ old('lastName') ? old('lastName') : $user->last_name }}' />
                        </div>
                        <div class = 'col-md-4'>
                            <label>Last 4 of Social Security</label>
                            <input type = 'text' class = 'form-control' name = 'ss' value = '{{ old('ss') }}' />
                        </div>
                    </div>
                    <div class = 'row form-group'>
                        <div class="col-md-4">
                            <label>Address</label>
                            <input type="text" class="form-control" name = 'address' value = '{{ old('address') }}' />
                        </div>
                        <div class="col-md-4">
                            <label>City</label>
                            <input type="text" class="form-control" name = 'city' value = '{{ old('city') }}' />
                        </div>
                        <div class = 'col-md-4'>
                            <label>State</label>
                            <input type = 'text' class = 'form-control' name = 'state' value = '{{ old('state') }}' />
                        </div>
                    </div>
                    <div class = 'row form-group'>
                        <div class="col-md-4">
                            <label>Zip Code</label>
                            <input type="text" class="form-control" name = 'zip' value = '{{ old('zip') }}' />
                        </div>
                    </div>
                    <div class="row">
                        <div class = 'col-md-12'>
                            <button type = 'submit' class = 'btn btn-primary'>REDEEM ${{ number_format($available, 2) }} <i class = 'fa fa-lock'></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    @endif

@include('site.redeem.thank-you')

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
				    <div class="col-md-2 col-xs-2 pad"><a target="_blank" href="/blog">BLOG</a></div>
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
