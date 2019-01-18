@extends('site.shop.shop-layout')

@section('header')
    <header id="shop_head">
        <div class="container-fluid cont">
            <div class="row">
                <div class="fheader col-md-8">
                    <a class="navbar-brand" href="https://fynches.codeandsilver.com">
        	         <img src="https://fynches.codeandsilver.com/public/front/img/BirdLogo.png" alt="Fynches" title="" id="fyn_logo_1">
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


</div>
    </ul>
</div>
                </div>
            </div>
        </div>    
    </header>
    
@stop 

@section('shop_content')
<!-- Layer1 -->
<section class="shop_btns">
    <div class="container-fluid cont">
        <div class="row">
            <div class="col-md-12 text-right">
				<a href="/gift-page/{{$gift_page->slug}}"><button class="btn common btn-border" id="btn_blk">PREVIEW GIFT PAGE</button><a/>
				<a href="/gift/{{$gift_page->slug}}"><button class="btn common btn-border" id="btn_blk">MANAGE GIFT PAGE</button><a/>
            </div>
        </div>
    </div>
</section>

<!-- Layer2 -->


<!-- Layer3 -->
<section class="shop_sort">
    <div class="container-fluid cont">
        <div class="row">
            <div class="col-md-12 text-right">
                <div class="dropdown">
                    <a href="#" class="btn btn-default dropdown-toggle" id="shop-sort" data-toggle="dropdown" onclick="return false;">SORT BY :
                    <span class="caret"></span></a>
                        <ul class="dropdown-menu" id="shop_drop">
                          <li><a data-id="1" href="#" onclick="event.preventDefault();">FEATURED</a></li>
                          <li><a data-id="2" href="#" onclick="event.preventDefault();">PRICE: LOW TO HIGH</a></li>
                          <li><a data-id="3" href="#" onclick="event.preventDefault();">PRICE: HIGH TO LOW</a></li>
                        </ul>
                </div>
            </div>
        </div>    
    </div>
</section>

<!-- Layer4 -->
<section id="shop_cat">
    <div class="container-fluid cont">
        <div class="row">
            <div class="col-md-2">
                <h5>CATEGORY</h5>
                <ul>
                    <li><div class="pretty p-icon p-curve p-fill p-has-indeterminate">
                        <input type="checkbox" class="checkbox cat" data-id="category" id="all"/>
                        <div class="state">
                            <i class="icon mdi mdi-check"></i>
                            <label>All Gifts</label>
                        </div>
                        <div class="state p-is-indeterminate">
                            <i class="icon mdi mdi-minus"></i>
                            <label>Indeterminate</label>
                        </div>
                    </div>
                    </li>
                    <li><div class="pretty p-icon p-curve p-fill p-has-indeterminate">
                        <input type="checkbox" class="checkbox cat" data-id="category" id="arts-and-crafts"/>
                        <div class="state">
                            <i class="icon mdi mdi-check"></i>
                            <label>Arts + Craft</label>
                        </div>
                        <div class="state p-is-indeterminate">
                            <i class="icon mdi mdi-minus"></i>
                            <label>Indeterminate</label>
                        </div>
                    </div>
                    </li>
                    <li><div class="pretty p-icon p-curve p-fill p-has-indeterminate">
                        <input type="checkbox" class="checkbox cat" data-id="category" id="dance"/>
                        <div class="state">
                            <i class="icon mdi mdi-check"></i>
                            <label>Dance</label>
                        </div>
                        <div class="state p-is-indeterminate">
                            <i class="icon mdi mdi-minus"></i>
                            <label>Indeterminate</label>
                        </div>
                    </div>
                    </li>
                    
                    <li>
                    <div class="pretty p-icon p-curve p-fill p-has-indeterminate">
                        <input type="checkbox" class="checkbox cat" data-id="category" id="outdoors"/>
                        <div class="state">
                            <i class="icon mdi mdi-check"></i>
                            <label>Outdoors</label>
                        </div>
                        <div class="state p-is-indeterminate">
                            <i class="icon mdi mdi-minus"></i>
                            <label>Indeterminate</label>
                        </div>
                    </div>
                    </li>
                    
                    <li>
                    <div class="pretty p-icon p-curve p-fill p-has-indeterminate">
                        <input type="checkbox" class="checkbox cat" data-id="category" id="learning"/>
                        <div class="state">
                            <i class="icon mdi mdi-check"></i>
                            <label>Learning</label>
                        </div>
                        <div class="state p-is-indeterminate">
                            <i class="icon mdi mdi-minus"></i>
                            <label>Indeterminate</label>
                        </div>
                    </div>
                    </li>
                    
                    <li>
                    <div class="pretty p-icon p-curve p-fill p-has-indeterminate">
                        <input type="checkbox" class="checkbox cat" data-id="category" id="sports"/>
                        <div class="state">
                            <i class="icon mdi mdi-check"></i>
                            <label>Sports</label>
                        </div>
                        <div class="state p-is-indeterminate">
                            <i class="icon mdi mdi-minus"></i>
                            <label>Indeterminate</label>
                        </div>
                    </div>
                    </li>
                    
                    <li>
                    <div class="pretty p-icon p-curve p-fill p-has-indeterminate">
                        <input type="checkbox" class="checkbox cat" data-id="category" id="amusement"/>
                        <div class="state">
                            <i class="icon mdi mdi-check"></i>
                            <label>Amusement</label>
                        </div>
                        <div class="state p-is-indeterminate">
                            <i class="icon mdi mdi-minus"></i>
                            <label>Indeterminate</label>
                        </div>
                    </div>
                    </li>
                    
                    <li>
                    <div class="pretty p-icon p-curve p-fill p-has-indeterminate">
                        <input type="checkbox" class="checkbox cat" data-id="category" id="cooking"/>
                        <div class="state">
                            <i class="icon mdi mdi-check"></i>
                            <label>Cooking</label>
                        </div>
                        <div class="state p-is-indeterminate">
                            <i class="icon mdi mdi-minus"></i>
                            <label>Indeterminate</label>
                        </div>
                    </div>
                    </li>
                    
                    <li>
                    <div class="pretty p-icon p-curve p-fill p-has-indeterminate">
                        <input type="checkbox" class="checkbox cat" data-id="category" id="subscription"/>
                        <div class="state">
                            <i class="icon mdi mdi-check"></i>
                            <label>Subscription</label>
                        </div>
                        <div class="state p-is-indeterminate">
                            <i class="icon mdi mdi-minus"></i>
                            <label>Indeterminate</label>
                        </div>
                    </div>
                    </li>
                    
                    
                </ul>
                
                <h5>AGES</h5>
                <ul>
                    <li>
                        <div class="pretty p-icon p-curve p-fill p-has-indeterminate">
                            @php 
                            $then = $gift_page->child->dob;
                            function getAge($then) {
                                $then_ts = strtotime($then);
                                $then_year = date('Y', $then_ts);
                                $age = date('Y') - $then_year;
                                if(strtotime('+' . $age . ' years', $then_ts) > time()) $age--;
                                return $age;
                                }
                            $years = getAge($then);
                            @endphp
                            <input type="hidden" id="child-ages" value="{{$years}}"/>
                            <input type="checkbox" class="checkbox" data-id="age" id="1"/>
                            <div class="state">
                                <i class="icon mdi mdi-check"></i>
                                <label>0 - 2 YRS</label>
                            </div>
                            <div class="state p-is-indeterminate">
                                <i class="icon mdi mdi-minus"></i>
                                <label>Indeterminate</label>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="pretty p-icon p-curve p-fill p-has-indeterminate">
                            <input type="checkbox" class="checkbox" data-id="age" id="2"/>
                            <div class="state">
                                <i class="icon mdi mdi-check"></i>
                                <label>2 - 5 YRS</label>
                            </div>
                            <div class="state p-is-indeterminate">
                                <i class="icon mdi mdi-minus"></i>
                                <label>Indeterminate</label>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="pretty p-icon p-curve p-fill p-has-indeterminate">
                            <input type="checkbox" class="checkbox" data-id="age" id="3"/>
                            <div class="state">
                                <i class="icon mdi mdi-check"></i>
                                <label>5 - 8 YRS</label>
                            </div>
                            <div class="state p-is-indeterminate">
                                <i class="icon mdi mdi-minus"></i>
                                <label>Indeterminate</label>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="pretty p-icon p-curve p-fill p-has-indeterminate">
                            <input type="checkbox" class="checkbox" data-id="age" id="4"/>
                            <div class="state">
                                <i class="icon mdi mdi-check"></i>
                                <label>8 - 13 YRS</label>
                            </div>
                            <div class="state p-is-indeterminate">
                                <i class="icon mdi mdi-minus"></i>
                                <label>Indeterminate</label>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="pretty p-icon p-curve p-fill p-has-indeterminate">
                            <input type="checkbox" class="checkbox" data-id="age" id="5"/>
                            <div class="state">
                                <i class="icon mdi mdi-check"></i>
                                <label>13+ YRS</label>
                            </div>
                            <div class="state p-is-indeterminate">
                                <i class="icon mdi mdi-minus"></i>
                                <label>Indeterminate</label>
                            </div>
                        </div>
                    </li>
                </ul>
                
            </div>
            
            
            <div class="col-md-10">
                <div class="row" id="shop-items">
                    <div class="col-md-4 text-center">
                        <div id="crecust">
                        <img src="http://fynches.codeandsilver.com/public/front/img/custAdd.png" data-toggle="modal" data-target="#gift_Add"><br><br>
                        <p class="text-center" style="font-size:18px" >CREATE <br>CUSTOM GIFT</p>
                        </div>
                    </div>
                    
                @if(isset($gifts))
                    @foreach($gifts as $gift)
                        @if($gift->custom)
                            @php
                                $gift = $gift->custom;
                                $gift->id = $gift->gift_id;
                            @endphp
                        @endif
                        <div class="col-md-4 reco_col" id="{{$gift->id}}" data-featured="{{$gift->featured ? '1' : '0'}}" data-price="{{$gift->price ? $gift->price : $gift->est_price}}" style="margin-bottom:20px">
                            <div id="img-height" style="position: relative; background: url({{$gift->gift_image}}); height:250px;background-size:100% 100%; ">
                                <div style="position: absolute; top: 1em; left: 1em; font-weight: bold; color: #fff;">
                                    <a href="javascript:void(0)" class="favorite-button"@if(!in_array($gift->id,unserialize($gift_page->favorites)))  style="color:#fff;" @else style="color:red;" @endif class="unfavorite-button"><i class="fas fa-heart fa-2x"></i></a>
                                </div>
                            </div>
                        <div class="shad-effect">
                            <label>{{$gift->title}}</label>
                            <p>{{$gift->name}}</p>
                            
                                <div class="btns-{{$gift->id}}">
                                @if(isset($added_gifts) && in_array($gift->id, $added_gifts_ids))
                                 <div class="row adddiff">
                                        <div class="col-md-6 col-xs-6">
                                            <button class="btn btn-lg add_submit" name="remove" data-id="{{$gift->id}}">REMOVE</button>
                                        </div>
                                        <div class="col-md-6 col-xs-6 text-right" id="gift_price">
                                            <p id="new-{{$gift->id}}" style="font-size: 16px;font-family: 'Avenir-Black';line-height: 16px;">${{$gift->price ? number_format($gift->price, 2) : number_format($gift->est_price, 2)}}</p>
                                            <p>Est. Price <i class="fas fa-info-circle tooltips" data-toggle="tooltip" data-placement="top" title="Estimated gift cost."></i></p>
                                        </div>
                                    </div>  
                                @else
                                <div class="btns-{{$gift->id}}">
                                    <div class="row" id="marg">
                                        <div class="col-md-6 col-xs-6">
                                            <button class="btn btn-primary btn-lg btn_purp gift-dets" id="giftdets-{{$gift->id}}" data-id="{{$gift->id}}" data-toggle="modal" data-target="#myModal">GIFT DETAILS</button>
                                        </div>
                                        <div class="col-md-6 col-xs-6" id="gift_para">
                                        </div>
                                    </div>   
                                    
                                    <div class="row">
                                        <div class="col-md-6 col-xs-6">
                                            <button class="btn btn-primary btn-lg yellow_submit" name="add" data-id="{{$gift->id}}">ADD GIFT</button>
                                        </div>
                                        <div class="col-md-6 col-xs-6 text-right" id="gift_price">
                                            <p id="new-{{$gift->id}}" style="font-size: 16px;font-family: 'Avenir-Black';line-height: 16px;">${{$gift->price ? number_format($gift->price, 2) : number_format($gift->est_price, 2)}}</p>
                                            <p>Est. Price <i class="fas fa-info-circle  tooltips" data-toggle="tooltip" data-placement="top" title="Estimated gift cost."></i></p>
                                        </div>
                                    </div>  
                                </div>
                                @endif    
                                </div>
                                
                            </div>    
                        </div>
                    @endforeach
                @endif
                @if(isset($custom_gifts))
                    @foreach($custom_gifts as $gift)
                        @if(!$gift->gift)
                        <div class="col-md-4 reco_col" id="{{$gift->id}}" data-featured="{{$gift->featured ? '1' : '0'}}" data-price="{{$gift->price}}" style="margin-bottom:20px">
                            <div id="img-height" style="position: relative; background: url({{$gift->gift_image}}); height:250px;background-size:100% 100%; ">
                                <div style="position: absolute; top: 1em; left: 1em; font-weight: bold; color: #fff;">
                                    <a href="javascript:void(0)" class="favorite-button"@if(!in_array($gift->id,unserialize($gift_page->favorites)))  style="color:#fff;" @else style="color:red;" @endif class="unfavorite-button"><i class="fas fa-heart fa-2x"></i></a>
                                </div>
                            </div>
                        <div class="shad-effect">
                            <label>{{$gift->title}}</label>
                            <p>{{$gift->name}}</p>
                            
                                <div class="btns-{{$gift->id}}">
                                @if(isset($added_gifts) && in_array($gift->id, $added_gifts_ids))
                                 <div class="row adddiff">
                                        <div class="col-md-6 col-xs-6">
                                            <button class="btn btn-lg add_submit" name="remove" data-id="{{$gift->id}}">REMOVE</button>
                                        </div>
                                        <div class="col-md-6 col-xs-6 text-right" id="gift_price">
                                            <p id="new-{{$gift->id}}" style="font-size: 16px;font-family:Avenir-Black;line-height: 16px;">${{$gift->price ? number_format($gift->price, 2) : number_format($gift->est_price, 2)}}</p>
                                            <p>Est. Price <i class="fas fa-info-circle  tooltips" data-toggle="tooltip" data-placement="top" title="Estimated gift cost."></i></p>
                                        </div>
                                    </div>  
                                @else
                                <div class="btns-{{$gift->id}}">
                                    <div class="row" id="marg">
                                        <div class="col-md-6 col-xs-6">
                                            <button class="btn btn-primary btn-lg btn_purp gift-dets" id="giftdets-{{$gift->id}}" data-id="{{$gift->id}}" data-toggle="modal" data-target="#myModal">GIFT DETAILS</button>
                                        </div>
                                        <div class="col-md-6 col-xs-6" id="gift_para">
                                        </div>
                                    </div>   
                                    
                                    <div class="row">
                                        <div class="col-md-6 col-xs-6">
                                            <button class="btn btn-primary btn-lg yellow_submit" name="add" data-id="{{$gift->id}}">ADD GIFT</button>
                                        </div>
                                        <div class="col-md-6 col-xs-6 text-right" id="gift_price">
                                            <p id="new-{{$gift->id}}" style="font-size: 16px;font-family:Avenir-Black;line-height: 16px;">${{$gift->price ? number_format($gift->price, 2) : number_format($gift->est_price, 2)}}</p>
                                            <p>Est. Price <i class="fas fa-info-circle  tooltips" data-toggle="tooltip" data-placement="top" title="Estimated gift cost."></i></p>
                                        </div>
                                    </div>  
                                </div>
                                @endif    
                                </div>
                                
                            </div>    
                        </div>
                        @endif
                    @endforeach
                @endif
                
                </div>
            </div>
        </div>
    </div>
</section>
<!--@include('site.gift.gift-modal')-->
@include('site.gift.gift_Add')
@include('site.gift.gift_crop')
@stop

@section('footer')
<footer class="footer">
	<div class="container-fluid cont">
		<div class="footer-top">
			<div class="row ">
				<div class="col-sm-4 col-md-4 col-lg-4 col-xs-12 text-left">
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


