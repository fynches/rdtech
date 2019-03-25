@extends('layouts.app_front')

@section('pagetitle', 'Home')

@section('content')

	<div class = 'section' style = 'min-height: 600px; padding: 25px;'>
		<div class = 'row' style = 'margin-bottom: 25px;'>
			<div class = 'col-sm-12'>
				<h1>{{ $staticPage->title }}</h1>
			</div>
		</div>
		<div class = 'row'>
			<div class = 'col-sm-12'>
				{!! $staticPage->content !!}
			</div>
		</div>
	</div>

@include('modal.signin')
@include('modal.signup')
@include('modal.password')
@include('modal.contact')

@endsection

@section('jsscript')
<script type="text/javascript" src="{{ asset('front/common/signup/signup.js')}}"></script>
@endsection