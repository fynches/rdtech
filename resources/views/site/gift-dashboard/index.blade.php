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
    <div class="row mt-5">
        <div class="col-2" id="dashboard-list">
            <ul class="dashboard-list">
                <h4>DASHBOARD</h4>
                <li><a href="/gift-dashboard">Gift Pages</a></li>
                <li><a href="/gifted">Gifted</a></li>
            </ul>
        </div>
        <div class="col-10 dashboard-items px-5 pb-5">
            <div class="row">
                <div class="col-8">
                    <h3>Gift Pages</h3>
                </div>
                <div class="col-4 text-right">
                    <a class = 'btn create-gift' href="/parent-child-info">
                        CREATE GIFT PAGE
                    </a>
                </div>
            </div>
            <div class="row mt-3">
                <div class = 'col-12 py-3' style = 'overflow: hidden; white-space: nowrap;'>
                    <h5>ACTIVE GIFT PAGES --------------------------------------------------------------------------------------</h5>
                </div>
            </div>

            @if($user->children && count($user->children))
                @foreach($user->children as $child)
                    @if($child->pages && count($child->pages))
                        @foreach($child->pages as $page)
                            <div id="page-{{$page->id}}">
                                <div class="row">
                                    <div class="col-2">
                                        @if($page->live)
                                            <a href="/gift-page/{{$page->slug}}"><img src="{{$page->child->image}}" alt="Image Here" style="width: 130px;"></a>
                                        @else
                                            <a href="/gift/{{$page->slug}}"><img src="{{$page->child->image}}" alt="Image Here" style="width: 100%;"></a>
                                        @endif
                                    </div>
                                    <div class="col-10">
                                        @if($page->live)
                                            <h4><a href="/gift-page/{{$page->slug}}">{{$page->title}}</a></h4>
                                        @else
                                            <h4><a href="/gift/{{$page->slug}}">{{$page->title}}</a></h4>
                                        @endif
                                        <p>{{$page->description}}</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-8 offset-2 px-3">
                                        <p>
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
                                    <div class="col-2 text-right">
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