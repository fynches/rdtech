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
                <div class="col-md-8 col-sm-8 col-xs-5" style="padding:0px">
                    <h3>Gift Pages</h3>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-7">
                    <a href="/parent-child-info" style="color:#fff;margin-left:auto" class="pointer"><button class="create-gift" style="margin-left:auto">CREATE GIFT PAGE</button></a>
                </div>
            </div>
            <div class="row" style="margin-top:30px;">
                <h5 style="height:50px; overflow: hidden;"><strong>ACTIVE GIFT PAGES</strong>    ----------</h5>
            </div>

            @if($user->children && count($user->children))
                @foreach($user->children as $child)
                    @if($child->pages && count($child->pages))
                        @foreach($child->pages as $page)
                            <div id="page-{{$page->id}}" class="marg-dash">
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-4">
                                        @if($page->live)
                                            <a href="/gift-page/{{$page->slug}}"><img src="{{$page->child->image}}" alt="Image Here" style="width: 130px;"></a>
                                        @else
                                            <a href="/gift/{{$page->slug}}"><img src="{{$page->child->image}}" alt="Image Here" style="width: 100%;"></a>
                                        @endif
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-8">
                                        @if($page->live)
                                            <h4><a href="/gift-page/{{$page->slug}}">{{$page->title}}</a></h4>
                                        @else
                                            <h4><a href="/gift/{{$page->slug}}">{{$page->title}}</a></h4>
                                        @endif
                                        <p>{{$page->description}}</p>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:20px;">
                                    <div class="col-md-2 col-sm-2"></div>
                                    <div class="col-md-7 col-sm-7" style="padding: 0 15px;">
                                        <p style="font-size:14px;line-height:14px;color:#34344A;margin-top:10px">
                                            Gift Page Status:
                                            @if($page->live)
                                                Published
                                                <a href="" data-id="{{$page->id}}" style="text-decoration: underline;font-size:14px;line-height:14px" id="private_dash">Make Page Private</a>
                                            @else
                                                Unpublished
                                                <a href="" data-id="{{$page->id}}" style="text-decoration: underline;" id="live_dash">Make Page Live</a>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-3 col-sm-3" style="margin-left:auto;float:right">
                                        <a href="/redeem-gifts"><img src="/front/img/redeem.png" alt="Fynches" title="" style="margin: 0 5px;"></a>
                                        {{--<a href="/gift-report/{{$page->slug}}"><img src="/front/img/fund.png" alt="Fynches" title="" style="margin: 0 5px;" /></a>--}}
                                        <a href="/gift/{{$page->slug}}"><img src="/front/img/edit.png" alt="Fynches" title="" style="margin: 0 5px;"></a>
                                        {{--<a class="delete-gift" href=""data-id="{{$page->id}}"><img src="/front/img/del.png" alt="Fynches" title="" style="margin: 0 5px;"></a>--}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</div>
<script src="{{ asset('js/dashboard.js') }}"></script>
@endsection