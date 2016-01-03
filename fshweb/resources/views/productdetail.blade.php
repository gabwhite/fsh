@extends('layouts.master')

@section('title', trans('ui.navigation_product_detail'))

@section('css')

@endsection

@section('sectionheader')
    {{trans('ui.navigation_product_detail')}}
@endsection

@section('content')


<div class="row">

    <div class="col-md-3">

        <div class="nutrition">

            <div class="nutrition-block">

                <h4>{{trans('ui.product_label_nutrition_facts')}}</h4>

                <div class="nutrition-meta serving-size">
                    <span class="nutrition-value">{{trans('ui.product_label_serving_size')}}&nbsp;{{$userproduct->serving_size}}</span>
                </div>
                <div class="nutrition-meta amount-per-serving">
                    <label>{{trans('ui.product_label_amount_per_serving')}}</label>
                </div>
                <div class="nutrition-meta calories">
                    <div class="col-lg-6 calories-left">
                        <label>{{trans('ui.product_label_calories')}}&nbsp;</label><span class="nutrition-value">{{$userproduct->calories}}</span>
                    </div>
                    <div class="col-lg-6 calories-right">
                        <span class="nutrition-value">{{trans('ui.product_label_calories_from_fat')}}&nbsp;{{$userproduct->calories_from_fat}}</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="nutrition-meta total-fat">
                    <label>{{trans('ui.product_label_total_fat')}}&nbsp;</label><span class="nutrition-value">{{$userproduct->total_fat}}</span>
                </div>
                <div class="nutrition-meta saturated-fat">
                    <span class="nutrition-value">{{trans('ui.product_label_saturated_fat')}}&nbsp;{{$userproduct->saturated_fats}}</span>
                </div>
                <div class="nutrition-meta cholesteral">
                    <label>{{trans('ui.product_label_cholesterol')}}&nbsp;</label><span class="nutrition-value"></span>
                </div>
                <div class="nutrition-meta sodium">
                    <label>{{trans('ui.product_label_sodium')}}&nbsp;</label><span class="nutrition-value">{{$userproduct->sodium}}</span>
                </div>
                <div class="nutrition-meta carbohydrates">
                    <label>{{trans('ui.product_label_total_carbs')}}&nbsp;</label><span class="nutrition-value">{{$userproduct->carbs}}</span>
                </div>
                <div class="nutrition-meta dietary-fibre">
                    <span class="nutrition-value">{{trans('ui.product_label_dietary_fibre')}}&nbsp;{{$userproduct->fibre}}</span>
                </div>
                <div class="nutrition-meta sugars">
                    <span class="nutrition-value">{{trans('ui.product_label_sugars')}}&nbsp;{{$userproduct->sugar}}</span>
                </div>
                <div class="nutrition-meta protein">
                    <label>{{trans('ui.product_label_protein')}}&nbsp;</label><span class="nutrition-value">{{$userproduct->protein}}</span>
                </div>
            </div>

            <h4>{{trans('ui.product_label_dietary_info')}}</h4>
            <div class="nutrition-meta">
                <label>{{trans('ui.product_label_halal')}}:</label>
                <span class="nutrition-value">{{($userproduct->is_halal) ? trans('ui.general_label_yes') : trans('ui.general_label_no')}}</span>
            </div>
            <div class="nutrition-meta">
                <label>{{trans('ui.product_label_organic')}}:</label>
                <span class="nutrition-value">{{($userproduct->is_organic) ? trans('ui.general_label_yes') : trans('ui.general_label_no')}}</span>
            </div>
            <div class="nutrition-meta">
                <label>{{trans('ui.product_label_kosher')}}:</label>
                <span class="nutrition-value">{{($userproduct->is_kosher) ? trans('ui.general_label_yes') : trans('ui.general_label_no')}}</span>
            </div>

            <br/>

            <h4>{{trans('ui.product_label_allergy_info')}}</h4>
            @foreach($userproduct->allergens as $a)

            @endforeach

        </div>



    </div>

    <div class="col-md-9">


        @if (Auth::check()
            && (Auth::user()->hasRole('admin') || (Auth::user()->hasRole('vendor') && isUserProductOwner($userproduct->id) )))

            <p class="bg-info">You are an administrator for this product (<a href="{{url('profile/product', $userproduct->id)}}">Edit</a>)</p>

        @endif

        <h1>{{$userproduct->name}}</h1>

        <h4>{{trans('ui.product_label_description')}}</h4>
        {{$userproduct->description}}<br/>

        <br/>

        <h4>{{trans('ui.product_label_ingredients')}}</h4>
        {{$userproduct->ingredient_deck}}<br/>

        <br/>

        <h4>{{trans('ui.product_label_features')}}</h4>
        @if($userproduct->features_benefits != '')
            {{$userproduct->features_benefits}}
        @else
            {{trans('ui.product_label_no_information')}}
        @endif
        <br/>

        <br/>

        <h4>{{trans('ui.product_label_allergen_disclaimer')}}</h4>
        @if($userproduct->allergen_disclaimer != '')
            {{$userproduct->allergen_disclaimer}}
        @else
                {{trans('ui.product_label_no_information')}}
        @endif
        <br/>

        <br/>

        <h4>{{trans('ui.product_label_preparation')}}</h4>
        {{$userproduct->preparation}}<br/>

        <br/>

        <h4>{{trans('ui.product_label_packaging_weights')}}</h4>
        {{trans('ui.product_label_pack')}}:{{$userproduct->pack}}<br/>
        {{trans('ui.product_label_size')}}:{{$userproduct->size}}<br/>
        {{trans('ui.product_label_calculation_size')}}:{{$userproduct->calc_size}}<br/>
        {{trans('ui.product_label_product_code')}}:{{$userproduct->mpc}}<br/>
        {{trans('ui.product_label_gtin')}}:{{$userproduct->gtin}}<br/>
        {{trans('ui.product_label_net_weight')}}:{{$userproduct->net_weight}}<br/>
        {{trans('ui.product_label_gross_weight')}}:{{$userproduct->gross_weight}}<br/>
        {{trans('ui.product_label_tare_weight')}}:{{$userproduct->tare_weight}}<br/>

        {{$userproduct->brand}}<br/>
        {{$userproduct->calories}}<br/>
        {{$userproduct->uom}}<br/>


    </div>

</div>


@endsection

@section('scripts')


@endsection