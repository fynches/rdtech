@extends('site.info.layout')

@section('header')
    <header style="min-height: 100px;">
        <div class="container-fluid" style="padding: 0px 50px;">
            <div class="row">
                <div class="fheader col-md-8 col-sm-7">
                   <a class="navbar-brand" href="/">
        	         <img src="/front/img/BirdLogo.png" alt="Fynches" title="" id="fyn_logo_1">
        	        </a>
                </div>
            </div>
        </div>    
    </header>
    <div class="container-fluid">
        <div class="row" id="hc">
            <div class="col-md-2">
                <a hfref="/" id="back" class="btn btn-outline-success go-back">GO BACK</a>
            </div>
            <div class="col-md-8" id="hostChild" style="text-align: center;">
                <h2 id="info-header" style="font-family:'Poppins',sans-serif;font-weight: 700;">LET'S GET STARTED SETTING UP YOUR GIFT PAGE</h2>
            </div>
        </div>

        <div class="row border-bottom" style="margin:0 50px"></div>
    </div>
    @if(session('error'))
        <div class = 'row'>
            <div class = 'col-sm-8 col-sm-offset-2 alert alert-danger' style = ' margin-top: 25px; text-align : center'>
                {{ session('error') }}
            </div>
        </div>
    @endif
    <form id="congrats" method="POST" action="create-page">
        {{csrf_field()}}
        <div id="host-child">
            <div class="container">
                <div class="form-row" id ="rw">
                    <div class="form-group col-md-5">
                        <h5 style="font-family: 'Poppins',sans-serif;font-weight:700; font-size:16px;line-height:25px;letter-spacing:1px;color:#34344A;">Host Info</h5>
                        <label for="hostFirstName" class="required">FIRST NAME</label>
                        <input required type="text" class="form-control" name="hostFirstName" value="{{ old('hostFirstName') }}" style="width: 100%;" />
                        <div class = 'form-row'>
                            <label for="hostLastName" class="required">LAST NAME</label>
                            <input required type="text" class="form-control" name="hostLastName" value="{{ old('hostLastName') }}" style="width: 100%;" />
                        </div>
                    </div>
                    <div class="form-group col-md-5 col-md-offset-2">
                        <h5 class="tt-header" style="font-family: 'Poppins',sans-serif;font-size:16px;line-height:25px;letter-spacing:1px;font-weight:700;color:#34344A;">Child Info</h5>
                        <div  href="#" data-toggle="tooltip" title="First name of the child for gift page" style="color:black;margin-top: 11px;cursor: pointer;">&nbsp&nbsp<i class="fas fa-info-circle"></i></div>
                        <label for="childName" class="required" style="width: 100%;margin-top: 7px;">CHILD NAME</label>
                        <input type="text" class="form-control" name="childName" value="{{ old('childName') }}" style="width: 100%;" required />
                        <div class="form-row">
                            <label for="dob" class="required">DOB</label>
                            <input required id="dob" placeholder="Please Select Date" class="date-input form-control" name="dob" value="{{ old('dob') }}" type="date" data-date-inline-picker="false" data-date-open-on-focus="true" style="width: 100%;"/>
                        </div>
                    </div>
                </div>
            </div>
            @include('site.gift.gift_crop')
        </div>
        <div id="date-location">
            <div class="container">
                <div class="row"  id="rw1">
                    <div class="col-md-5">
                        <h5>Date of Party</h5>
                        <div class="form-row show-inputbtns">
                            <input required id="party-time" name="eventDate" value="{{ old('eventDate') }}" type="date" data-date-inline-picker="false" class="form-control" data-date-open-on-focus="true" style="width:100%" />
                        </div>
                        <div class="pretty p-icon p-curve p-has-indeterminate">
                            <input type="checkbox" id="not-decided" value="1" />
                            <div class="state" style="margin-top: -2px;">
                                <i class="icon mdi mdi-check"></i>
                                <label style="font-size:13px;letter-spacing:0.4px;line-height:18px">We Are Still Deciding On The Date</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="page-link">
            <div class="container">
                <div class="row" id="rw1">
                    <div class="col-md-12">
                        <h5 style="margin-bottom:20px;">What Would You Like The Link to Your Gift Page To Be?</h5>
                        <div class="guest">This link is how your guests will find your gift page. Make it simple and easy to remember.</div>
                    </div>
                    <div class="col-md-12">
                        <div class="row" id="lk">
                            <div class="col-md-4 col-xs-6 text-right">
                                <p id="gp">https://www.fynches.com/gift-page/</p>
                            </div>
                            <div class="col-md-7 col-xs-8 text-left no-padding" >
                                <input required id="slug" name="slug" type="text" placeholder="" style="width: 100%;border-radius: 0 5px 5px 0;" value="{{ old('slug') }}" pattern="[A-Za-z0-9]*">
                                <p style="margin-top:5px;">Please use only letters or numbers only</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <input id="page-link" type="submit" class="yellow-submit pointer" value="FINISH">
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div id="page-link">
        <div id="creating" class="container" style="display:none;">
            <div class="row" style="padding:60px 0px 120px;">
                <div class="col-md-12 text-center">
                    <img src="/front/img/Congrats.png" alt="bird" title="" class="img-fluid" width="450px">
                </div>
            </div>
        </div>
    </div>
@stop



