@extends('layouts.master')

@section('title', 'Page Title')

@section('css')

@endsection

@section('sidebar')
    @parent


@endsection

@section('content')
Product Details
<hr/>

{{$userproduct->name}}<br/>
{{$userproduct->brand}}<br/>
{{$userproduct->description}}<br/>
{{$userproduct->pack}}<br/>
{{$userproduct->mpc}}<br/>
{{$userproduct->gtin}}<br/>
{{$userproduct->calc_size}}<br/>
{{$userproduct->calories}}<br/>
{{$userproduct->allergen_disclaimer}}<br/>
{{$userproduct->features_benefits}}<br/>
{{$userproduct->ingredient_deck}}<br/>
{{$userproduct->uom}}<br/>
{{$userproduct->preparation}}<br/>
@endsection

@section('scripts')


@endsection