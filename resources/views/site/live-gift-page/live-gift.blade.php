@extends('site.live-gift-page.live-page-layout')

@section('header')
    <header id="gift_head" >
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 fheader">
                    <a class="navbar-brand" href="/">
                        <img src="/front/img/BirdLogo.png" alt="Fynches" title="" id="fyn_logo_1">
                    </a>
                </div>
                @if(Auth::check())
                    <div class="col-md-6 fmenu">
                        <div id="div_top_hypers">
                            <ul class="ul_top_hypers" id="ul_top_hypers">
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
                @else
                    <div class="col-md- fmenu">
                        <div id="div_top_hypers">
                            <ul class="ul_top_hypers" id="ul_top_hypers" style = 'margin: 0px'>
                                <li><a href="/about-us" class="a_top_hypers"> ABOUT</a></li>
                                <li><a href="/BLOG" class="a_top_hypers"> BLOG</a></li>
                                <li><a href="#" class="a_top_hypers" data-toggle = 'modal' data-target = '#contactPage'> CONTACT US</a></li>
                                <li><a href="/need-help" class="a_top_hypers"> HELP</a></li>
                                <li><a class="a_top_hypers" href="#" data-toggle="modal" data-target="#largeModalSI" >LOGIN</a></li>
                                <li><a class="btn common pink-btn" style="cursor: pointer;background-color: #DFF2F6;width: auto;border: 1px solid #f05;border-radius: 25px;color: #f05;font-size: 12px;font-weight: bold;letter-spacing: 2px;padding: 4px 7px;" data-toggle="modal" data-target="#largeModalS">SIGN UP FREE</a></li>
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </header>
@stop

@section('live_content')

    <section class="live_experience" style="@if ($page->background_image->image_url) background: url('{{$page->background_image->image_url}}'); @endif background-size: cover;">
        <div class="container-fluid">
            <div class="row" >
                <div class="col-md-12 text-left" id="child_col">
                    <div class="dropdown" id="my_child">
                        <a  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img  src="{{$page->child->image}}"></a>
                    </div>
                </div>
             </div>
        </div>
    </section>

    <section class="live_box">
        <div class="container-fluid cont_title">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12" id="live_column">
                     <h5 id="ctitle">
                         {{$page->title}}
                     </h5>
                </div>
            </div>
        </div>
    </section>
    <section class="live_details">
        <div class="container-fluid cont">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12" id="live_text">
                    <label for="details">Details</label>
                       <p>{{$page->description}}</p>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-12" id="live_col_2" style="padding: 0px;">
                    <div class="row">
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <label>Name</label>
                            <h5><strong>{{$page->child->first_name}}</strong></h5>
                            <input id="page-id" type="hidden" value="{{$page->id}}">
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <label>Age</label>
                            <h5><strong>{{$page->child->age}}</strong></h5>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-6">
                            <label>Host</label>
                             <h5><strong>{{$page->hostname}}</strong></h5>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-6">
                            <label>Date</label>
                            <h5><strong>@isset($page->date){{date('F d,Y',strtotime($page->date))}}@endisset</strong></h5>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-12">
                            <p>Share</p>
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-2">
                                    <a class="twitter-share-button" target= "_blank" href="https://twitter.com/intent/tweet?url={{ config('app.url') }}/gift-page/{{$page->slug}}"><i class="fab fa-twitter"></i></a>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-2">
                                    <a target= "_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ config('app.url') . $page->child->image }}&display=popup" style="color:#000"><i class="fab fa-facebook-f"></i></a>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-2">
                                   <a target= "_blank" href="https://www.instagram.com" style="color:#000"><i class="fab fa-instagram"></i></a>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-2">
                                   <i class="far fa-envelope" data-toggle="modal" data-target="#gift_share"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="gift_reco">
        <div class="container-fluid cont">
            <div class="row">
                <div class="col-md-3 reco_col" id="reco_col">
                    <div id="gift-image-100" class="add-money" data-id="100" style="background:url('/front/img/give-any.jpg');background-size:cover">
                        <img class="img-height" src="/front/img/give-any.jpg" width="100%" id="img-100" style="height:250px">
                        <img id="imgrp-100" class="cart" data-id="100" src="/front/img/whitecheck.png">
                        <img  id="fagift-100" class="gifted_icon" data-id="100" src="/front/img/giftbox.png">
                        <p class="cancel" id="cancel-100" data-id="100"><i class="fas fa-times-circle"></i>  Cancel</p>
                    </div>
                    <div class="shad-effect">
                        <label>GIVE A GIFT OF ANY AMOUNT</label>
                        <p style="font-weight:100"></p>
                        <div class="row im_giving text-center four-columns">
                            <div class="col-md-6 col-xs-6 gift-item">
                            <p class="im-giving">I'M GIVING</p>
                            </div>
                            <div class="col-md-6 col-xs-6 gift-item">
                                <span id="dlr-100" class="currencyinput" style="">$</span>
                                <input id="prch-100" class="purchase" data-id="100" type="number" value="" placeholder="ENTER AMOUNT" style="" min="0" max="60.5">
                            </div>
                        </div>
                    </div>
                </div>
                @if(isset($page->added_gifts) && count($page->added_gifts))
                    @foreach($page->added_gift_models as $gift)
                        <div class="col-md-3 reco_col" id="reco_col">
                            <div id="gift-image-{{$gift->id}}" class="add-money" data-id="{{$gift->id}}" style="background:url('{{$gift->gift_image}}');background-size:cover">
                                <img class="img-height" src="{{$gift->image}}" width="100%" id="img-{{$gift->id}}" style="height:250px">
                                <img id="imgrp-{{$gift->id}}" class="cart" data-id="{{$gift->id}}" src="/front/img/whitecheck.png">
                                <img  id="fagift-{{$gift->id}}" class="gifted_icon" data-id="{{$gift->id}}" src="/front/img/giftbox.png">
                                <p class="cancel" id="cancel-{{$gift->id}}" data-id="{{$gift->id}}"><i class="fas fa-times-circle"></i>  Cancel</p>
                            </div>
                            <div class="shad-effect">
                                <label>{{$gift->title}}</label>
                                <p style="font-weight:100">{{$gift->name}}</p>
                                <div class="row gift_giving text-center four-columns">
                                    <div class="col-md-3 col-xs-3" style="padding:0px">
                                        <h6><strong>$<span id="gifted-{{$gift->id}}" data-result="" data-amount="{{ $gift->gifted }}">{{ $gift->gifted }}</span></strong></h6>
                                        <p style="font-weight:100">GIFTED</p>
                                    </div>
                                    <div class="col-md-3 col-xs-3" style="padding:0px">
                                        <h6><strong>$<span  id="needed-{{$gift->id}}" data-result="" data-amount="{{ $gift->balance }}">{{ $gift->balance }}</span></strong></h6>
                                        <p style="font-weight:100 ">NEEDED</p>
                                    </div>
                                    <div class="col-md-6 col-xs-6 gift-item">
                                        <a id="gft-{{$gift->id}}" data-id="{{$gift->id}}" href="{{url('checkout')}}" class="btn btn-primary give-gift"> GIVE THIS GIFT</a>
                                        <span id="dlr-{{$gift->id}}" class="currencyinput" style="display:none;">$</span>
                                        <input id="prch-{{$gift->id}}" class="purchase" data-id="{{$gift->id}}" type="number" value="" placeholder="ENTER AMOUNT" style="display:none;" min="0" max="{{$gift->price - 0}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <section class="live_messages">
        <p id="titlemessage" class="text-center">MESSAGES FROM FRIENDS AND FAMILY</p>
        @if(isset($page->child->message))
            <div class="container" id="messages">
                @foreach($page->child->message as $message)
                    @php
                        $datetime = $message->created_at;
                        $full = false;
                        $now = new DateTime();
                        $ago = new DateTime($datetime, new DateTimeZone('America/Los_Angeles'));
                        $diff = $now->diff($ago);
                        $diff->w = floor($diff->d / 7);
                        $diff->d -= $diff->w * 7;
                        $string = array(
                            'y' => 'year',
                            'm' => 'month',
                            'w' => 'week',
                            'd' => 'day',
                            'h' => 'hour',
                            'i' => 'minute',
                            's' => 'second',
                        );
                        foreach ($string as $k => &$v )
                        {
                            if ($diff->$k)
                            {
                                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                            }
                            else
                            {
                                unset($string[$k]);
                            }
                        }
                        if (!$full)
                        {
                            $string = array_slice($string, 0, 1);
                        }
                        $ago =  $string ? implode(', ', $string) . ' ago' : 'just now';
                    @endphp
                    <div class="row" id="msg">
                        <div class="col-md-1 col-sm-2 col-xs-4">
                            <img  id="photoIcon" src="{{$page->child->image}}" style="width:100%">
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-8">
                            <div class="row">
                                <div class="col-md-2 col-xs-4">
                                    <h5><strong style="font-family:'Poppins',sans-serif; font-weight:700;">{{$message->name}}</strong></h5>
                                </div>
                                <div class="col-md-10 col-xs-8">
                                    <p style="color:#d9d9d9;margin: 10px 0 0 0;font-size:12px"><i class="far fa-clock"></i>{{$ago}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-xs-12" >
                                    <p class="small_msg">{{$message->message}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>

    <section class="live_textbox">
        <div class="container">
            <form id="message-form" method="POST" action="/gift-live/{{$page->child->first_name}}">
                <input id="childs_name" type="hidden" name="childs_name" value="{{$page->child->first_name}}" />
                <div class="row" id="msg">
                    <div class="col-md-12"></div>
                    <div class="col-md-1 col-xs-3">
                        <img src="{{$page->child->image}}" style="width:100%">
                    </div>
                    <div class="col-md-11 col-xs-8">
                        <label id="inputName" for="message_name">Name:</label>
                        <input id="live_textname" placeholder="Enter Name" type="text" name="message_name"><br>
                        <label for="message">Message:</label>
                        <textarea type="text" name="message" id="live_textmsg" placeholder="Write a message to {{$page->child->first_name}}"></textarea>
                    </div>
                </div>
                <div class="row text-right">
                     <button class="btn btn-lg btn_blk" data-id="{{$page->child->id}}" id="post_message">Post Message</button>
                </div>
           </form>
        </div>
    </section>

    <section>
        <div id="checkout" class="container-fluid checkout-wrap" style="display:none;">
            <div id="cart"><span id="total-text">TOTAL $</span><span id="total">0</span><a href="/checkout">
            <button class="btn common btn-border white-border" id="post_message" style="margin-left: 22px;">CONTINUE TO CHECKOUT</button></a></div>
        </div>
    </section>

    @include('site.live-gift-page.gift_share')
    @include('modal.contact')
    @include('modal.signin')
    @include('modal.signup')
    @include('modal.password')
@stop

@section('footer')
<footer class="footer">
	<div class="container-fluid cont">
		<div class="footer-top">
			<div class="row ">
				<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12 text-left" id="foot_img">
					<a href="javascript:void(0)"><img src="/front/img/f-logo.png" alt="logo" title=""></a>
				</div>
				<div class="col-sm-6 col-md-5 col-xs-12 text-center" id="f-menu">
				    <div class="col-md-2 col-xs-2 pad"><a href="/about-us">ABOUT</a></div>
				    <div class="col-md-2 col-xs-2 pad"><a target="_blank" href="/blog/">BLOG</a></div>
				    <div class="col-md-3 col-xs-3 pad"><a href="#" data-toggle="modal" data-target="#contactPage">CONTACT US</a></div>
				    <div class="col-md-2 col-xs-2 pad"><a href="/need-help">FAQS</a></div>
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
                    <div class="col-md-4 col-sm-6 text-left" id="foot_img">
                        <p style="font-size:14px;font-family:'Avenir-Book',line-height:28px">&copy; {{ date('Y') }} Fynches. All rights reserved</p>
                    </div>
                    <div class="col-md-8 col-sm-6 text-right" id="foot_img" >
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
