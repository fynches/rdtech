@extends('site.gift.gift-layout')

@section('header')
     <header id="gift_head" data-page-id="{{$page->id}}">
        <div class="container-fluid">
            <div class="row">
                <div class="fheader col-md-8 col-sm-7">
                   <a class="navbar-brand" href="https://fynches.codeandsilver.com">
                     <img src="/front/img/BirdLogo.png" alt="Fynches" title="" id="fyn_logo_1">
                    </a>
                </div>
                <div class="col-md-4">
                    <div class="fmenu"id="div_top_hypers">
                        <ul class="ul_top_hypers" id="ul_top_hypers">
                            <li><a href="" class="a_top_hypers">HELP</a></li>
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

@section('gift_content')
<!--Layer 1-->
<section class="gift_experience" @if(isset($page->background_image->image_url)) style="background: url('{{$page->background_image->image_url}}');background-size: cover;" @endif>
	<div class="container-fluid">
	    <div class="row" > 
		    <div class="col-md-3 text-left" id="pos_abs_img">
		        <div class="dropdown">
    		        <a id="Mychild_photo" data-toggle="dropdown" aria-haspopup="true" >
    		            <img @if($child->image) src="{{$child->image}}" width="75px" id="prof_pic" style="cursor:pointer" @else src="/front/img/dpImage.png" width="75px" id="prof_pic" style="cursor:pointer" @endif />
    		        </a>
    		        <div class="dropdown-menu">
                      <a class="dropdown-item" id="profile-image" href="#" data-toggle="modal" data-target="#gift_crop" >UPLOAD PHOTO</a>
                      <a class="dropdown-item" href="#" data-slug="{{$page->slug}}" id="remove_photo">REMOVE PHOTO</a>
                      <a class="dropdown-item" href="">CANCEL</a>
                    </div>
                </div>
		    </div>
		 </div>
		<div class="row" >
			<div class="col-md-6 text-right" id="pos_abs">
				@if(!$page->live)
				    <button class="btn common btn-border btn_wht_pnk" id="live-submit" data-id="{{$page->id}}">MAKE PAGE LIVE</button>
				    <a href="/gift-page/{{$page->slug}}" style="color:#000"><button class="btn common btn-border" id="btn_wht">PREVIEW GIFT PAGE</button></a>
				@else 
				    <button class="btn common btn-border btn_wht_pnk" id="private_dash" data-id="{{$page->id}}">MAKE PAGE PRIVATE</button>
				    <a href="/gift-page/{{$page->slug}}" style="color:#000"><button class="btn common btn-border" id="btn_wht">LIVE GIFT PAGE</button></a>
				@endif
				<button class="btn common btn-border bg" id="btn_wht" data-toggle="modal" data-target="#gift_background">EDIT BACKGROUND IMAGE</button>
			</div>
		</div>
	</div>
</section>

<form id="gift_form" method="post" onsubmit="event.preventDefault();">
      {{ csrf_field() }}
    <section class="gift_box">
        <div class="container-fluid cont_title">
            <div class="text-right" id="gft_title-req">Required</div>
                <div class="row">
                    <div class="col-md-2 col-sm-2" id="gift_column">
                    </div>
                    <div class="col-md-10 col-sm-10" id="gift_column">
                        <input type="text" id="page_title" aria-describedby="page_title" name="page_title" placeholder="Create a title for your gift page" maxlength="60" style="color:#000;" value="{{$page->title}}">
                        <div class="text-right" id="title-limit">{{60 - strlen($page->title)}} of 60 characters remaining</div>
                    </div>
            </div>
        </div>
    </section>

    <section class="gift_details">
        <div class="container-fluid cont">
            <div class="row">
                <input id="slug" type="hidden" value="{{$page->slug}}">
                <div class="col-md-4" id="gift_text">
                    <label for="details">Details</label><div class="text-right" id="gft_det-req">Required</div>
                        <textarea type="text" id="page_description" style="resize:none; color:#000;" placeholder="Share some information about the event" maxlength="360">{{$page->description}}</textarea>
                    <div class="text-right" id="details-limit">{{360 - strlen($page->description)}} of 360 characters remaining</div>
                </div>
                <div class="col-md-8" id="gft_col_3">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Date</label>
                            <div class="text-right" id="inp_date-req">Required</div>
                            <input required id="event_date" name="event_date" type="date" data-date-inline-picker="false" data-date-open-on-focus="true" value="{{$page->date}}" style="color:#000;" />
                        </div>
                        <div class="col-md-4">
                           <label>DOB</label><div class="text-right" id="inp_age-req">Required</div>
                           <input required id="dob" name="dob" type="date" value="{{$child->dob}}" style="color:#000; height:45px;">
                        </div>
                        <div class="col-md-4">
                           <label>Host</label><div class="text-right" id="inp_host-req">Required</div>
                           <input id="hostname" name="hostname" type="text" placeholder="Enter Host's Name" value="{{$page->hostname}}" style="color:#000;">
                        </div>
                    </div>
                    <div class="row" id="gift_share">
                        <div class="col-md-9" style="margin-top: 20px;">
                            <label>Share Your Custom Page Link</label>
                            <div class="col-md-12 chal">
                                <div class="input-group">
                                    <input readonly type="text" class="form-control" id="inp_link" @if($page->live) value="{{config('app.url')}}/gift-page/{{$page->slug}}" @else placeholder="{{ config('app.url') }}/gift-page/{{$page->slug}} @endif">
                                    <span class="input-group-btn">
                                        <a class="btn btn-default tooltips" type="button" onclick="copyURL()" data-toggle="tooltip" data-placement="top" title="Your page must be live before you copy and share your live gift share URL">COPY</a>
                                    </span>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>


<section class="gift_reco">
    <div class="container-fluid cont">
        <div class="row" id="recommended">
            @if(isset($recommendedGifts))
                <h5 style="margin-bottom:30px;">RECOMMENDED GIFTS FOR {{strToUpper($child->first_name)}}</h5>
                @foreach($recommendedGifts as $gift)
                    <div class="col-md-3 col-sm-6 reco_col" id="{{$gift->id}}">
                        <div id="img-height" style="position: relative; background: url({{$gift->image}}); width:100%; height:250px; background-size:100% 100%; ">
                            <?php //dd($page); ?>
                            <div style="position: absolute; top: 1em; left: 1em; font-weight: bold; color: #fff;">
                                <a href="javascript:void(0)" class="favorite-button"><i class="fas fa-heart fa-2x heart-{{$gift->id}}" @if(!$page->favorite_gifts || !in_array($gift->id,$page->favorite_gifts))  style="color:#fff;" @else style="color:red;" @endif></i></a>
                            </div>
                        </div>
                        <div class="shad-effect">
                            <label>{{$gift->title}}</label>
                            <p>{{$gift->description}}</p>
                            <div class="btns-{{$gift->id}}">
                                @if(isset($page->added_gifts) && in_array($gift->id, $page->added_gifts))
                                     <div class="row" id="marg">
                                        <div class="col-md-6 col-xs-6">
                                            <button class="btn btn-lg add_submit" data-id="{{$gift->id}}" name="remove">REMOVE</button>
                                        </div>
                                        <div class="col-md-6 col-xs-6 text-right">
                                            @php
                                            $gifted = $gift->purchases($page->id)->sum('amount');
                                            $needed = $gift->price - $gifted;
                                            @endphp
                                            <div class="col-md-6 col-xs-6"> <p class="text-center" style="font-family:Avenir-Black;font-size:16px;color:#34344A;margin-top: 10px;line-height: 16px;">${{$gift->purchases($page->id)->sum('amount')}}</p><p class="text-center" style="font-weight:100;font-size:10px;font-family:'Avenir-Book';margin-top:5px">GIFTED</p></div>
                                            <div class="col-md-6 col-xs-6"><p class="text-center new-{{$gift->id}}" style="font-family:Avenir-Black;font-size:16px;color:#34344A;margin-top: 10px;line-height: 16px;">${{$needed}}</p><p class="text-center" style="font-size:10px;font-family:'Avenir-Light';line-height:10px;margin-top:5px">NEEDED</p></div>
                                        </div>
                                    </div>
                                @else
                                    <div class="btns-{{$gift->id}}">
                                        <div class="row">
                                            <div id="img_1" class="col-md-6 col-xs-6">
                                                <button class="btn btn-primary btn-lg btn_purp gift-dets " id="giftdets-{{$gift->id}}" data-id="{{$gift->id}}" data-toggle="modal" data-target="#myModal">GIFT DETAILS</button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-xs-6">
                                                <button class="btn btn-primary btn-lg yellow_submit" name="add" data-id="{{$gift->id}}">QUICK ADD</button>
                                            </div>
                                            <div class="col-md-6 col-xs-6 text-right gift_price" id="gift_price" data-id="{{$gift->id}}">
                                                <p style="font-size:16px;font-family:'Avenir-Black';color:#34344A;line-height:16px">${{number_format($gift->cost, 2)}}</p>
                                                <p>Est. Price <i class="fas fa-info-circle tooltips" data-toggle="tooltip" data-placement="top" title="Estimated gift cost."></i></p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>    

<section class="add_gifts">
    <div class="container-fluid cont">
        <div class="row">
            <h5>ADD GIFTS</h5>
            <div class="col-md-12 dash text-center">
                <img src="/front/img/custAdd.png" data-toggle="modal" data-target="#cashfund"><br><h6>ADD GIFTS</h6>
            </div>
        </div>
    </div>
</section>

<section class="gift_reco">
    <div class="container-fluid cont">
        <div class="row" id="added">
            <h5 style="margin:20px;">GIFTS ADDED TO {{strToUpper($child->first_name)}}'S PAGE</h5>
            <div class="added_gifts">
                <div class="col-md-3 col-sm-6 reco_col pointer" id="100">
                    <div id="hoverimg-100" class="" data-id="100" style="position: relative; background: url('http://fynches.codeandsilver.com/public/front/img/give-any.jpg'); width:100%; height:250px; background-size:100% 100%; ">
                        <div id="cartimg-100" class="cart_1" data-id="100"></div>
                        <div style="position: absolute; top: 1em; left: 1em; font-weight: bold; color: #fff;"></div>
                    </div>
                    <div class="shad-effect">
                        <label>GIVE A GIFT OF ANY AMOUNT</label>
                        <div class="row" id="marg">
                            <div class="col-md-6 col-xs-6"></div>
                            <div class="col-md-6 col-xs-6 text-right"></div>
                        </div>
                    </div>
                </div>
                @if($page->added_gift_models && count($page->added_gift_models))
                    @foreach($page->added_gift_models as $gift)
                        @php
                            $gifted = $gift->purchases($page->id)->sum('amount');
                            $needed = $gift->price - $gifted;
                        @endphp
                        <div class="col-md-3 col-sm-6 reco_col pointer" id="{{$gift->id}}">
                            <div id="hoverimg-{{$gift->id}}" class="hoverimg" data-id="{{$gift->id}}" style="position: relative; background: url({{$gift->image}}); width:100%; height:250px; background-size:100% 100%; ">
                                <div id="cartimg-{{$gift->id}}" class="cart_1" data-id="{{$gift->id}}"></div>
                                <div class="row cancel_1"  data-id="{{$gift->id}}" id="cancel_1-{{$gift->id}}">
                                    <div class="col-md-6 col-sm-6 col-xs-6 text-left"></div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                        @if($needed <= 0)<div class="col-md-4 col-sm-4 col-xs-4"></div>@endif
                                        <div class="col-md-4 col-sm-4 col-xs-4"><img id="move-{{$gift->id}}" class="draggable" data-id="{{$gift->id}}" src="/front/img/Move_white.png" style="width:100%"></div>
                                        <div class="col-md-4 col-sm-4 col-xs-4"><img id="edit-{{$gift->id}}" class="edit-dets" data-id="{{$gift->id}}" data-toggle="modal" data-target="#gift_Add" src="/front/img/edit_white.png" style="width:100%"></div>
                                        @if($needed)<div class="col-md-4 col-sm-4 col-xs-4"><img id="move-{{$gift->id}}" class="trash" data-id="{{$gift->id}}" src="/front/img/Delete_white.png" style="width:100%"></div>@endif
                                    </div>
                                </div>
                                <div style="position: absolute; top: 1em; left: 1em; font-weight: bold; color: #fff;">
                                    <a href="javascript:void(0)" class="favorite-button"><i class="fas fa-heart fa-2x heart-{{$gift->id}}" @if(!in_array($gift->id,$page->favorite_gifts))  style="color:#fff;" @else style="color:red;" @endif></i></a>
                                </div>
                            </div>
                            <div class="shad-effect">
                                <label class="l-{{$gift->id}}">{{$gift->title}}</label>
                                <p class="d-{{$gift->id}}">{{$gift->description}}</p>
                                <div class="row" id="marg">
                                    <div class="col-md-6 col-xs-6">
                                        <button class="btn btn-lg add_submit" name="remove" data-id="{{$gift->id}}">REMOVE</button>
                                    </div>
                                    <div class="col-md-6 col-xs-6 text-right">
                                        <div class="col-md-6 col-xs-6"> <p class="text-center" style="font-family:Avenir-Black;font-size:16px;color:#34344A;margin-top: 10px;line-height: 16px;">${{$gift->purchases($page->id)->sum('amount')}}</p><p class="text-center" style="font-weight:100;font-size:12px;font-family:'Avenir-Book';margin-top:5px">GIFTED</p></div>
                                        <div class="col-md-6 col-xs-6"><p class="text-center new-{{$gift->id}}" style="font-family:Avenir-Black;font-size:16px;color:#34344A;margin-top: 10px;line-height: 16px;">${{$needed}}</p><p class="text-center" style="font-weight:100;font-size:12px;font-family:'Avenir-Book';margin-top:5px">NEEDED</p></div>
                                    </div>
                                </div>  
                            </div>    
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>

<section class="gift_reco">
    <div class="container-fluid cont">
        <div class="row" id="favorites">
            <h5 id="high">SAVED FAVORITES <i class="fas fa-info-circle cir tooltips" data-toggle="tooltip" data-placement="top" title="Click the heart on any gift to save here as a favorite."></i> </h5>
            @if($page->favorite_gift_models && count($page->favorite_gift_models))
                @foreach($page->favorite_gift_models as $gift)
                    <div class="col-md-3 col-sm-6 reco_col pointer" id="{{$gift->id}}">
                        <div id="img-height" style="position: relative; background: url({{$gift->image}}); width:100%; height:250px; background-size:100% 100%; ">
                            <div style="position: absolute; top: 1em; left: 1em; font-weight: bold; color: #fff;">
                                <a href="javascript:void(0)" class="favorited-button"  data-pnum="{{$gift->id}}"><i class="fas fa-heart fa-2x heart-{{$gift->id}}" @if(!in_array($gift->id, $page->favorite_gifts))  style="color:#fff;" @else style="color:red;" @endif></i></a>
                            </div>
                        </div>
                        <div class="shad-effect">
                            <label class="l-{{$gift->id}}">{{$gift->title}}</label>
                            <p class="d-{{$gift->id}}">{{$gift->description}}</p>
                            <div class="btns-{{$gift->id}}">
                                @if(isset($page->added_gifts) && in_array($gift->id, $page->added_gifts))
                                    <div class="row" id="marg">
                                        <div class="col-md-6 col-xs-6">
                                            <button class="btn btn-lg add_submit" name="remove" data-id="{{$gift->id}}">REMOVE</button>
                                        </div>
                                        <div class="col-md-6 col-xs-6 text-right">
                                            @php
                                            $gifted = $gift->purchases($page->id)->sum('amount');
                                            $needed = $gift->price - $gifted;
                                            @endphp
                                            <div class="col-md-6 col-xs-6"> <p class="text-center" style="font-family:Avenir-Black;font-size:16px;color:#34344A;margin-top: 10px;line-height: 16px;">${{$gift->purchases($page->id)->sum('amount')}}</p><p class="text-center" style="font-weight:100;font-size:12px;font-family:'Avenir-Book';margin-top:5px">GIFTED</p></div>
                                            <div class="col-md-6 col-xs-6"><p class="text-center new-{{$gift->id}}" style="font-family:Avenir-Black;font-size:16px;color:#34344A;margin-top: 10px;line-height: 16px;">${{$needed}}</p><p class="text-center" style="font-weight:100;font-size:12px;font-family:'Avenir-Book';margin-top:5px">NEEDED</p></div>
                                        </div>
                                    </div>
                                @else
                                    <div class="btns-{{$gift->id}}">
                                        <div class="row">
                                            <div class="col-md-6 col-xs-6">
                                                <button class="btn btn-primary btn-lg btn_purp gift-dets" data-id="{{$gift->id}}" data-toggle="modal" data-target="#myModal">GIFT DETAILS</button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-xs-6">
                                                <button class="btn btn-primary btn-lg yellow_submit" name="add" data-id="{{$gift->id}}">QUICK ADD</button>
                                            </div>
                                            <div class="col-md-6 col-xs-6 text-right gift_price" id="gift_price" data-id="{{$gift->id}}">
                                                <p style="font-size:16px;font-family:'Avenir-Black';color:#34344A;line-height:16px">${{number_format($gift->cost, 2)}}</p>
                                                <p>Est. Price <i class="fas fa-info-circle tooltips" data-toggle="tooltip" data-placement="top" title="Estimated gift cost."></i></p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>    

@include('site.gift.gift-background')
@include('site.gift.gift_Add')
@include('site.gift.gift-zip')
@include('site.gift.gift_crop')
@include('modal.contact')
@include('site.gift.cash-fund')

<!--@include('site.gift.gift-modal')-->
    <link type="text/css" rel="stylesheet" href="{{ asset('asset/css/lightslider.css') }}" />
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
				    <div class="col-md-2 col-xs-2 pad"><a target="_blank" href="/blog">BLOG</a></div>
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
					<p style="font-size:14px;font-family:'Avenir-Book',line-height:28px">© @php echo date('Y'); @endphp Fynches. All rights reserved</p>
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
