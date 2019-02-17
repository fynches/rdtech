@extends('layouts.standard.layout')
@section('header')
    @include('layouts.standard.partials.header_clean')
@stop
@section('css')
    <link href="{{ asset('asset/css/parent-child-info.css') }}" rel="stylesheet">
@stop
@section('js')
    <script src="{{asset('js/info.js')}}"></script>
    <script src="{{asset('js/crop.js')}}"> </script>
    <script src="{{asset('js/croppie.js')}}"> </script>
    <script src="{{asset('js/croppie.min.js')}}"> </script>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-1 offset-1">
                <a href="#" id = 'back' class="btn btn-outline-success go-back">GO BACK</a>
            </div>
            <div class="col-sm-9 text-center">
                <h2>LET'S GET STARTED SETTING UP YOUR GIFT PAGE</h2>
            </div>
        </div>
        <div class="row">
            <div class = 'col-sm-10 offset-1'>
                <hr class = 'border-bottom'/>
            </div>
        </div>
    </div>
    @if(session('error'))
        <div class = 'row'>
            <div class = 'col-sm-8 offset-2 alert alert-danger text-center mt-3'>
                {{ session('error') }}
            </div>
        </div>
    @endif
    <form id = 'parent-child-info' method="POST" action="create-page" class = 'container-fluid'>
        {{csrf_field()}}
        <div class="row mt-4">
            <div class="col-sm-4 offset-1">
                <h5>Host Info</h5>
            </div>
            <div class="col-sm-4 offset-2">
                <h5>Child Info
                    <span data-toggle="tooltip" title="First name of the child for gift page" style="color:black;margin-top: 11px;cursor: pointer;">
                        &nbsp&nbsp<i class="fas fa-info-circle"></i>
                    </span>
                </h5>
            </div>
        </div>
        <div class = 'row mt-4'>
            <div class="col-sm-4 offset-1">
                <label for="hostFirstName" class="required">FIRST NAME</label>
                <input required type="text" class="form-control" name="hostFirstName" value="{{ old('hostFirstName') }}" />
            </div>
            <div class="col-sm-4 offset-2">
                <label for="childName" class="required">CHILD NAME</label>
                <input type="text" class="form-control" name="childName" value="{{ old('childName') }}" style="width: 100%;" required />
            </div>
        </div>
        <div class = 'row mt-4'>
            <div class="col-sm-4 offset-1">
                <label for="hostLastName" class="required">LAST NAME</label>
                <input required type="text" class="form-control" name="hostLastName" value="{{ old('hostLastName') }}" />
            </div>
            <div class="col-sm-4 offset-2">
                <label for="dob" class="required">DOB</label>
                <input required id="dob" placeholder="Please Select Date" class="date-input form-control" name="dob" value="{{ old('dob') }}" type="date" data-date-inline-picker="false" data-date-open-on-focus="true"/>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-4 offset-1">
                <label>DATE OF PARTY</label>
                <input name="eventDate" value="{{ old('eventDate') }}" type="date" data-date-inline-picker="false" class="form-control" data-date-open-on-focus="true"/>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="not-decided" name = 'not-decided' value="1">
                    <label class="form-check-label" for="not-decided">We Are Still Deciding On The Date</label>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-10 offset-1">
                <h5>What Would You Like The Link to Your Gift Page To Be?</h5>
                <div class="guest">This link is how your guests will find your gift page. Make it simple and easy to remember.</div>
            </div>
        </div>
        <div class = 'row mt-2'>
            <div class="col-sm-4 offset-1 text-right pr-0">
                <div class = 'url-column'>
                    /gift-page/
                </div>
            </div>
            <div class="col-sm-6 text-left no-padding" >
                <input required id="slug" name="slug" class = 'form-control url-input' type="text" value="{{ old('slug') }}" pattern="[A-Za-z0-9]*">
                <p>Please use only letters or numbers</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-12 text-center">
                <input id="page-link" type="submit" class="yellow-submit pointer" value="FINISH">
            </div>
        </div>
    </form>
    <div id="page-link">
        <div id="creating" class="container" style="display:none;">
            <div class="row" style="padding:60px 0px 120px;">
                <div class="col-sm-12 text-center">
                    <img src="/front/img/Congrats.png" alt="bird" title="" class="img-fluid" width="450px">
                </div>
            </div>
        </div>
    </div>
    @include('modal.gift-crop')
@stop



