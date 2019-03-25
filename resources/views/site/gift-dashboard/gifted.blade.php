@extends('layouts.standard.layout')
@section('header')
    @include('layouts.standard.partials.header')
@stop
@section('js')
    <script src="{{ asset('js/dashboard.js') }}"></script>
@stop

@section('css')
    <link href="{{ asset('asset/css/gift-dashboard.css') }}" rel="stylesheet">
@stop
@section('content')
<div class="container-fluid gift-dashboard">
    <div class="row" style="margin-top:50px;">
        <div class="col-md-2" id="dashboard-list">
            <ul class="dashboard-list">
                <h4>DASHBOARD</h4>
                <li><a href="/gift-dashboard">Gift Pages</a></li>
                <li><a href="/gifted">Gifted</a></li>
            </ul>
        </div>
        <div class="col-md-9 dashboard-items">
            <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-4" style="padding:0px">
                    <h3>Gifted</h3>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-8 text-center">
                    <a href="/parent-child-info" style="color:#fff;margin-left:auto" class="pointer"><button class="create-gift" style="margin-left:auto;">CREATE GIFT PAGE</button></a>
                </div>
            </div>
            @foreach($user->completedPurchases() as $purchase)
                <div class="marg-dash">
                    <div class="row" style="margin-top:20px;">
                        <div class="col-md-2 col-sm-2 col-xs-4">
                            <img src="{{ $purchase->page->child->image }}" width="100" />
                        </div>
                        <div class="col-md-10 col-sm-10 col-xs-8">
                            <h4>{{$purchase->gift->title}}</h4>
                            <p>{{$purchase->gift->description}}</p>
                        </div>
                    </div>
                    <div class="row" style="margin-top:30px;">
                        <div class="col-md-2 "></div>
                        <div class="col-md-3 col-xs-4">
                            <p class="gifted_right" style="font-size:14px;line-height:14px;color:#34344A">Gifted To: {{$purchase->page->child->first_name}}</p>
                        </div>
                        <div class="col-md-4 col-xs-4">
                            <p style="font-size:14px;line-height:14px;color:#34344A">Gifted ${{$purchase->amount}} of ${{$purchase->gift->price}} Requested</p>
                        </div>
                        <div class="col-md-3 col-xs-4">
                            <p class="gifted_too_left" style="font-size:14px;line-height:14px;color:#34344A">Gifted On: {{ date('m/d/Y', strtotime($purchase->created_at)) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
