@extends('layouts.master')

@section('title', 'Information for Vendors')

@section('css')

@endsection

@section('sectionheader')

<section class='clearfix container-wrap main-title vendor-reg-header'>
    <div class='container text-center'>
    	<h1 class="page-title">Connect with your prospects through your products.</h1>

		<video width= "600" poster="/img/video-poster.png" src="/img/FSH-VendorVideo.mp4" controls>
		</video>
		<button class="btn center-block play-vid">Play</button>

		<h2 class="page-subhead">Every day Chefs are looking to learn more about products and what is available on the market. Let them see everything you have to offer.</h2>
		<a href="/auth/register"><button class="btn-primary">Sign Up</button></a>
    </div>
</section>

<section class="clearfix container-wrap cta">
	<h2 class="page-subhead text-center">Sign up today for a Free 1 Year Premium Subscription, with no set up costs.</h2>
</section>
@endsection

@section('content')

<div class="row">

    <div class="col-xs-12 text-center">
		<h2>A sourcing library for Chefs –  A lead generation system for you!</h2>
		<h3>Show your products and grow your brand.</h3>
		
		<div class="well col-xs-12 col-sm-4">
			<div class="col-xs-12 table-header">
				<h3>Starter</h3>
				<p>Free</p>
			</div>

			<div class="col-xs-12 table-body">
				<p>150 Products</p>
				<p>Vendor Profile Page</p>
				<p>Item Description</p>
				<p>Product Specs</p>
				<p>Ingredient Deck</p>
				<p>Benefit Statement</p>
				<p>Preparation Instructions</p>

				<a href="/auth/register"><button class="btn-primary">Sign Up</button></a>
			</div>
		</div>
		<div class="well col-xs-12 col-sm-4">
			<div class="col-xs-12 table-header">
				<h3>Premium</h3>
				<p>$39 / Month</p>
			</div>

			<div class="col-xs-12 table-body">
				<p>150 Products</p>
				<p>Vendor Profile Page</p>
				<p>Item Description</p>
				<p>Product Specs</p>
				<p>Ingredient Deck</p>
				<p>Benefit Statement</p>
				<p>Preparation Instructions</p>
				<p>Nutrionals</p>
				<p>Allergens</p>
				<p>Samples Request Button</p>
				<p>Monthly Portfolio Activity Reports</p>

				<a href="/auth/register"><button class="btn-primary">Sign Up</button></a>
			</div>
		</div>
		<div class="well col-xs-12 col-sm-4">
			<div class="col-xs-12 table-header">
				<h3>Enterprise</h3>
				<p>$199 / Month</p>
			</div>

			<div class="col-xs-12 table-body">
				<p>150 Products</p>
				<p>Vendor Profile Page</p>
				<p>Item Description</p>
				<p>Product Specs</p>
				<p>Ingredient Deck</p>
				<p>Benefit Statement</p>
				<p>Preparation Instructions</p>
				<p>Nutrionals</p>
				<p>Allergens</p>
				<p>Samples Request Button</p>
				<p>Monthly Portfolio Activity Reports</p>
				<p>Priority Placement</p>
				<p>Featured Products on Landing Page</p>
				<p>Member Newsletter Marketing</p>
				<p>Vendor Blog / Article Publishing</p>

				<a href="/auth/register"><button class="btn-primary">Sign Up</button></a>
			</div>
		</div>
    </div>

</div>

@endsection

@section('scripts')
	<script>
		$(document).ready(function(){
           $(".play-vid").on("click", function(){
           		$("video")[0].play();
           });
        });
	</script>

@endsection