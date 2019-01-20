@extends('site.info.layout')

@section('header')
    <header style="min-height: 100px;">
        <div class="container-fluid" style="padding: 0px 50px;">
            <div class="row">
                <div class="fheader col-md-8 col-sm-7">
                   <a class="navbar-brand" href="https://fynches.codeandsilver.com">
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
    <form id="congrats" method="POST" action="create-page">
        {{csrf_field()}}
        <div id="host-child">
            @include('site.info.host-child')
        </div>
        <div id="date-location">
            @include('site.info.date-location')
        </div>
        <div id="page-link">
            @include('site.info.page-link')
        </div>
    </form>
    <div id="page-link">
        @include('site.info.congratulations')
    </div>
@stop



