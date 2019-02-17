@extends('layouts.app_front')

@section('header')
	@include('site.inner_header')
@stop

@section('pagetitle', 'Terms & Condition')
@section('content')

<!-- Breadcrumb Sec-->
<section class="main-beadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
				  <li class="breadcrumb-item"><a href="{{ '/' }}">Home</a></li>
				  <li class="breadcrumb-item active"> Terms & Condition</li>
				</ol>
			</div>
		</div>
	</div>
</section>
<!-- End -->

@if(isset($terms_and_condition))
	{!!html_entity_decode($terms_and_condition->description)!!}
@else
	<section class="banner-sec">
	<div class="container">
		<div class="content sign-up-sec">
			<div class="row">
				<div class="col-sm-12">
					Please read these terms of service ("terms", "terms of service") carefully before using [website] website (the "service") operated by [name] ("us", 'we", "our").

Conditions of Use

We will provide their services to you, which are subject to the conditions stated below in this document. Every time you visit this website, use its services or make a purchase, you accept the following conditions. This is why we urge you to read them carefully.

Privacy Policy

Before you continue using our website we advise you to read our privacy policy [link to privacy policy] regarding our user data collection. It will help you better understand our practices.

Copyright

Content published on this website (digital downloads, images, texts, graphics, logos) is the property of [name] and/or its content creators and protected by international copyright laws. The entire compilation of the content found on this website is the exclusive property of [name], with copyright authorship for this compilation by [name].

Communications

The entire communication with us is electronic. Every time you send us an email or visit our website, you are going to be communicating with us. You hereby consent to receive communications from us. If you subscribe to the news on our website, you are going to receive regular emails from us. We will continue to communicate with you by posting news and notices on our website and by sending you emails. You also agree that all notices, disclosures, agreements and other communications we provide to you electronically meet the legal requirements that such communications be in writing.

Applicable Law

By visiting this website, you agree that the laws of the [your location], without regard to principles of conflict laws, will govern these terms of service, or any dispute of any sort that might come between [name] and you, or its business partners and associates.

Disputes

Any dispute related in any way to your visit to this website or to products you purchase from us shall be arbitrated by state or federal court [your location] and you consent to exclusive jurisdiction and venue of such courts.

Comments, Reviews, and Emails

Visitors may post content as long as it is not obscene, illegal, defamatory, threatening, infringing of intellectual property rights, invasive of privacy or injurious in any other way to third parties. Content has to be free of software viruses, political campaign, and commercial solicitation.

We reserve all rights (but not the obligation) to remove and/or edit such content. When you post your content, you grant [name] non-exclusive, royalty-free and irrevocable right to use, reproduce, publish, modify such content throughout the world in any media.

License and Site Access

We grant you a limited license to access and make personal use of this website. You are not allowed to download or modify it. This may be done only with written consent from us.

User Account

If you are an owner of an account on this website, you are solely responsible for maintaining the confidentiality of your private user details (username and password). You are responsible for all activities that occur under your account or password.

We reserve all rights to terminate accounts, edit or remove content and cancel orders in their sole discretion.
				</div>
			</div>
		</div>
	</div>
</section>	
@endif	
<!-- End -->
@endsection