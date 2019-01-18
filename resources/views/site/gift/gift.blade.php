@extends('site.gift.gift-layout')

@section('header')
    
 <header id="gift_head" data-page-id="{{$gift_page->id}}">
        <div class="container-fluid">
            <div class="row">
                <div class="fheader col-md-8 col-sm-7">
                   <a class="navbar-brand" href="https://fynches.codeandsilver.com">
        	         <img src="https://fynches.codeandsilver.com/public/front/img/BirdLogo.png" alt="Fynches" title="" id="fyn_logo_1">
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
        </div>
    </ul>
</div>
                </div>
            </div>
        </div>
    </header>
@stop

@section('gift_content')
<!--Layer 1-->
<section class="gift_experience" @if(isset($gift_page->background_image->image_url)) style="background: url('{{$gift_page->background_image->image_url}}');background-size: cover;" @endif>
	<div class="container-fluid">
	    
	    <div class="row" > 
		    <div class="col-md-3 text-left" id="pos_abs_img">
		        <div class="dropdown">
    		        <a id="Mychild_photo" data-toggle="dropdown" aria-haspopup="true" >
    		        <img @if(isset($gift_page->child->recipient_image)) src="{{$gift_page->child->recipient_image}}" width="75px" id="prof_pic" style="cursor:pointer" @else src="https://fynches.codeandsilver.com/public/front/img/dpImage.png" width="75px" id="prof_pic" style="cursor:pointer" @endif />
    		        
    		        </a>
    		        
    		        <div class="dropdown-menu">
                      <a class="dropdown-item" id="profile-image" href="#" data-toggle="modal" data-target="#gift_crop" >UPLOAD PHOTO</a>
                      <a class="dropdown-item" href="#" data-slug="{{$gift_page->slug}}" id="remove_photo">REMOVE PHOTO</a>
                      <a class="dropdown-item" href="">CANCEL</a>
                    </div>
                </div>
		    </div>
		 </div>
	    
	    
		<div class="row" >
			<div class="col-md-6 text-right" id="pos_abs">
				@if($gift_page->live == 0)
				<button class="btn common btn-border btn_wht_pnk" id="live-submit" data-id="{{$gift_page->id}}">MAKE PAGE LIVE</button>
				<a href="/gift-page/{{$gift_page->slug}}" style="color:#000"><button class="btn common btn-border" id="btn_wht">PREVIEW GIFT PAGE</button></a>
				@else 
				<button class="btn common btn-border btn_wht_pnk" id="private_dash" data-id="{{$gift_page->id}}">MAKE PAGE PRIVATE</button>
				<a href="/gift-page/{{$gift_page->slug}}" style="color:#000"><button class="btn common btn-border" id="btn_wht">LIVE GIFT PAGE</button></a>
				@endif
				
				<button class="btn common btn-border bg" id="btn_wht" data-toggle="modal" data-target="#gift_background">EDIT BACKGROUND IMAGE</button>
			</div>
		</div>
		
	</div>
</section>


<form id="gift_form" method="post" onsubmit="event.preventDefault();">
      {{ csrf_field() }}
<!--Layer 2-->
<section class="gift_box">
    <div class="container-fluid cont_title">
         <div class="text-right" id="gft_title-req">Required</div>
        <div class="row">
            <div class="col-md-2 col-sm-2" id="gift_column">
            </div>   
            <div class="col-md-10 col-sm-10" id="gift_column">
                 <input type="text" id="gft_title" aria-describedby="gift_title" name="gift_title" placeholder="Create a title for your gift page" maxlength="60" @if(isset($gift_page)) style="color:#000;" value="{{$gift_page->page_title}}"@endif>
                 <div class="text-right" id="title-limit" @if(isset($gift_page->page_title)) @endif>{{60 - strlen($gift_page->page_title)}} of 60 characters remaining</div>
            </div>
        </div>
    </div>
</section>
<!--Layer 3-->
<section class="gift_details">
    <div class="container-fluid cont">
        <div class="row">
            <input id="slug" type="hidden" value="@if(isset($gift_page->slug)){{$gift_page->slug}}@endif">
            <div class="col-md-4" id="gift_text">
                <label for="details">Details</label><div class="text-right" id="gft_det-req">Required</div>
                    <textarea type="text" name="message" id="gft_det" style="resize:none; color:#000;" placeholder="Share some info about the gift recepient and events" maxlength="360">{{isset($gift_page->page_desc) ? "$gift_page->page_desc" : ""}}</textarea>
                <div class="text-right" id="details-limit" @if(isset($gift_page->page_desc)) @endif>{{360 - strlen($gift_page->page_desc)}} of 360 characters remaining</div>
            </div>
            
        
            <div class="col-md-8" id="gft_col_3">
                    <div class="row">
                        <div class="col-md-4">
                         <label>Date</label><div class="text-right" id="inp_date-req">Required</div>
                                <input required id="inp_date" name="inp_date" type="date" data-date-inline-picker="false" data-date-open-on-focus="true"  @if(isset($gift_page)) value="{{$gift_page->page_date}}" style="color:#000;"@endif />
                        </div>  
                        <div class="col-md-4">
                           <label>DOB</label><div class="text-right" id="inp_age-req">Required</div> 
                           <input required id="inp_age" name="inp_age" type="date" @if(isset($gift_page->child->dob)) value="{{$gift_page->child->dob}}" style="color:#000; height:45px;"@endif>
                        </div>
                        
                        <div class="col-md-4">
                           <label>Host</label><div class="text-right" id="inp_host-req">Required</div> 
                           <input id="inp_host" name="inp_host" type="text" placeholder="Enter Host's Name"  @if(isset($gift_page)) value="{{$gift_page->page_hostname}}" style="color:#000;"@endif> 
                        </div>
                    </div>
                    
                    <div class="row" id="gift_share">
                        
                            <div class="col-md-9" style="margin-top: 20px;">
                                <label>Share Your Custom Page Link</label>
                                <div class="col-md-12 chal">
                                    <div class="input-group">
                                      <input readonly type="text" class="form-control" id="inp_link" @if($gift_page->live == 1) value="http://fynches.codeandsilver.com/gift-page/{{$gift_page->slug}}" @else placeholder="http://fynches.codeandsilver.com/gift-page/{{$gift_page->slug}} @endif">
                                      <span class="input-group-btn">
                                        <a class="btn btn-default tooltips" type="button" onclick="copyURL()" data-toggle="tooltip" data-placement="top" title="Your page must be live before you copy and share your live gift share URL">COPY</a>
                                        
                                      </span>
                                    </div>
                                 </div>
                            </div>
                            
                            <div class="col-md-3" id="face">
                                <div class="col-md-6 col-xs-6">
                                    <!--  <p>SHARE ON FACEBOOK</p> -->
                                </div>
                                <div class="col-md-6 col-xs-6">
                                    <!-- <a class="btn btn-primary" href="https://www.facebook.com/sharer/sharer.php?u=https://fynches.codeandsilver.com/gift" target="_blank">f</a>-->
                                </div>
                            </div>    
                    </div>
            </div>  
        </div>
    </div>
</section> 

</form>

<!--Layer 4-->
<section class="gift_reco">
    <div class="container-fluid cont">
        <div class="row" id="recommended">
            @if(isset($rec_gifts))
            <h5 style="margin-bottom:30px;">RECOMMENDED GIFTS FOR {{strToUpper($gift_page->child->first_name)}}</h5>
                @foreach($rec_gifts as $gift)
                    
                        <div class="col-md-3 col-sm-6 reco_col" id="{{$gift->id}}">
                            <div id="img-height" style="position: relative; background: url({{$gift->gift_image}}); width:100%; height:250px; background-size:100% 100%; ">
                                <div style="position: absolute; top: 1em; left: 1em; font-weight: bold; color: #fff;">
                                    <a href="javascript:void(0)" class="favorite-button"><i class="fas fa-heart fa-2x heart-{{$gift->id}}" @if(!in_array($gift->id,unserialize($gift_page->favorites)))  style="color:#fff;" @else style="color:red;" @endif></i></a>
                                </div>
                            </div>
                            <div class="shad-effect">
                                <label>{{$gift->title}}</label>
                                <p>{{$gift->description}}</p>
                               
                                <div class="btns-{{$gift->id}}">
                                @if(isset($added_gifts) && in_array($gift->id, $added_gifts_ids))
                                     <div class="row" id="marg">
                                        <div class="col-md-6 col-xs-6">
                                            <button class="btn btn-lg add_submit" data-id="{{$gift->id}}" name="remove">REMOVE</button>
                                        </div>
                                        <div class="col-md-6 col-xs-6 text-right">
                                            @php
                                            $gifted = $gift->purchases($gift_page->id)->sum('amount');
                                            $needed = $gift->price - $gifted;
                                            @endphp
                                            <div class="col-md-6 col-xs-6"> <p class="text-center" style="font-family:Avenir-Black;font-size:16px;color:#34344A;margin-top: 10px;line-height: 16px;">${{$gift->purchases($gift_page->id)->sum('amount')}}</p><p class="text-center" style="font-weight:100;font-size:10px;font-family:'Avenir-Book';margin-top:5px">GIFTED</p></div>
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
                                            <p style="font-size:16px;font-family:'Avenir-Black';color:#34344A;line-height:16px">${{number_format($gift->est_price, 2)}}</p>
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
    </div>
</section>    

<!--Layer 5-->
<section class="add_gifts">
    <div class="container-fluid cont">
        <div class="row">
            <h5>ADD GIFTS</h5>
            <div class="col-md-12 dash text-center">
                <img src="https://fynches.codeandsilver.com/public/front/img/custAdd.png" data-toggle="modal" data-target="#cashfund"><br><h6>ADD GIFTS</h6>
            </div>
           
        </div>
    </div>
</section>



<!--Layer 6-->
<section class="gift_reco">
    <div class="container-fluid cont">
        <div class="row" id="added">
            <h5 style="margin:20px;">GIFTS ADDED TO {{strToUpper($gift_page->child->first_name)}}'S PAGE</h5>
            <div class="added_gifts">
            <div class="col-md-3 col-sm-6 reco_col pointer" id="100">
                            <div id="hoverimg-100" class="" data-id="100" style="position: relative; background: url('http://fynches.codeandsilver.com/public/front/img/give-any.jpg'); width:100%; height:250px; background-size:100% 100%; ">
                                
                                <div id="cartimg-100" class="cart_1" data-id="100"></div>
                                
                                
                                
                                <div style="position: absolute; top: 1em; left: 1em; font-weight: bold; color: #fff;">
                                    
                                </div>
                            </div>
                            <div class="shad-effect">
                                <label>GIVE A GIFT OF ANY AMOUNT</label>
                                
                                
                                <div class="row" id="marg">
                                        <div class="col-md-6 col-xs-6">
                                            
                                        </div>
                                        <div class="col-md-6 col-xs-6 text-right">
                                            
                                        </div>
                                </div>  
                            </div>    
                    </div>    
            @if(isset($added_gifts))
                @foreach($added_gifts as $gift)
                    @if(isset($gift->custom))
                        @php
                            $gift = $gift->custom;
                            $gift->id = $gift->gift_id;
                        @endphp
                    @endif
                                            @php
                                            $gifted = $gift->purchases($gift_page->id)->sum('amount');
                                            $needed = $gift->price - $gifted;
                                            @endphp
                        <div class="col-md-3 col-sm-6 reco_col pointer" id="{{$gift->id}}">
                            <div id="hoverimg-{{$gift->id}}" class="hoverimg" data-id="{{$gift->id}}" style="position: relative; background: url({{$gift->gift_image}}); width:100%; height:250px; background-size:100% 100%; ">
                                
                                <div id="cartimg-{{$gift->id}}" class="cart_1" data-id="{{$gift->id}}"></div>
                                
                                <div class="row cancel_1"  data-id="{{$gift->id}}" id="cancel_1-{{$gift->id}}">
                                    <div class="col-md-6 col-sm-6 col-xs-6 text-left"></div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                        @if($needed <= 0)<div class="col-md-4 col-sm-4 col-xs-4"></div>@endif
                                        <div class="col-md-4 col-sm-4 col-xs-4"><img id="move-{{$gift->id}}" class="draggable" data-id="{{$gift->id}}" src="http://fynches.codeandsilver.com/public/front/img/Move_white.png" style="width:100%"></div>
                                        <div class="col-md-4 col-sm-4 col-xs-4"><img id="edit-{{$gift->id}}" class="edit-dets" data-id="{{$gift->id}}" data-toggle="modal" data-target="#gift_Add" src="http://fynches.codeandsilver.com/public/front/img/edit_white.png" style="width:100%"></div>
                                        @if($needed > 0)<div class="col-md-4 col-sm-4 col-xs-4"><img id="move-{{$gift->id}}" class="trash" data-id="{{$gift->id}}" src="http://fynches.codeandsilver.com/public/front/img/Delete_white.png" style="width:100%"></div>@endif
                                    </div>
                                </div>
                                
                                <div style="position: absolute; top: 1em; left: 1em; font-weight: bold; color: #fff;">
                                    <a href="javascript:void(0)" class="favorite-button"><i class="fas fa-heart fa-2x heart-{{$gift->id}}" @if(!in_array($gift->id,unserialize($gift_page->favorites)))  style="color:#fff;" @else style="color:red;" @endif></i></a>
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
                                            <div class="col-md-6 col-xs-6"> <p class="text-center" style="font-family:Avenir-Black;font-size:16px;color:#34344A;margin-top: 10px;line-height: 16px;">${{$gift->purchases($gift_page->id)->sum('amount')}}</p><p class="text-center" style="font-weight:100;font-size:12px;font-family:'Avenir-Book';margin-top:5px">GIFTED</p></div>
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


<!-- Layer 7-->
<section class="gift_reco">
    <div class="container-fluid cont">
        <div class="row" id="favorites">
            <h5 id="high">SAVED FAVORITES <i class="fas fa-info-circle cir tooltips" data-toggle="tooltip" data-placement="top" title="Click the heart on any gift to save here as a favorite."></i> </h5>
            
            @if(isset($favorite_gifts))
                @foreach($favorite_gifts as $gift)
                    @if(isset($gift->custom))
                        @php
                            $gift = $gift->custom;
                            $gift->id = $gift->gift_id;
                        @endphp
                    @endif
                   
                        <div class="col-md-3 col-sm-6 reco_col pointer" id="{{$gift->id}}">
                            <div id="img-height" style="position: relative; background: url({{$gift->gift_image}}); width:100%; height:250px; background-size:100% 100%; ">
                                <div style="position: absolute; top: 1em; left: 1em; font-weight: bold; color: #fff;">
                                    <a href="javascript:void(0)" class="favorited-button"  data-pnum="{{$gift->id}}"><i class="fas fa-heart fa-2x heart-{{$gift->id}}" @if(!in_array($gift->id,unserialize($gift_page->favorites)))  style="color:#fff;" @else style="color:red;" @endif></i></a>
                                </div>
                            </div>
                            <div class="shad-effect">
                                <label class="l-{{$gift->id}}">{{$gift->title}}</label>
                                <p class="d-{{$gift->id}}">{{$gift->description}}</p>
                                
                                <div class="btns-{{$gift->id}}">
                                @if(isset($added_gifts) && in_array($gift->id, $added_gifts_ids)) 
                                 <div class="row" id="marg">
                                        <div class="col-md-6 col-xs-6">
                                            <button class="btn btn-lg add_submit" name="remove" data-id="{{$gift->id}}">REMOVE</button>
                                        </div>
                                        <div class="col-md-6 col-xs-6 text-right">
                                            @php
                                            $gifted = $gift->purchases($gift_page->id)->sum('amount');
                                            $needed = $gift->price - $gifted;
                                            @endphp
                                            <div class="col-md-6 col-xs-6"> <p class="text-center" style="font-family:Avenir-Black;font-size:16px;color:#34344A;margin-top: 10px;line-height: 16px;">${{$gift->purchases($gift_page->id)->sum('amount')}}</p><p class="text-center" style="font-weight:100;font-size:12px;font-family:'Avenir-Book';margin-top:5px">GIFTED</p></div>
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
                                            <p style="font-size:16px;font-family:'Avenir-Black';color:#34344A;line-height:16px">${{number_format($gift->est_price, 2)}}</p>
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
@include('site.gift.contact-us')
@include('site.gift.cash-fund')

<!--@include('site.gift.gift-modal')-->
    <link type="text/css" rel="stylesheet" href="{{ asset('public/asset/css/lightslider.css') }}" />                  
@stop



@section('footer')
<footer class="footer">
	<div class="container-fluid cont">
		<div class="footer-top">
			<div class="row ">
				<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12 text-left" id="foot_img">
					<a href="javascript:void(0)"><img src="https://fynches.codeandsilver.com/public/front/img/f-logo.png" alt="logo" title=""></a>
				</div>
				<div class="col-sm-6 col-md-5 col-xs-12 text-center" id="f-menu">
				    <div class="col-md-2 col-xs-2 pad"><a href="/about-us">ABOUT</a></div>
				    <div class="col-md-2 col-xs-2 pad"><a target="_blank" href="https://fynches.com/blog/">BLOG</a></div>
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
					<p style="font-size:14px;font-family:'Avenir-Book',line-height:28px">© 2019 Fynches. All rights reserved</p>
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
