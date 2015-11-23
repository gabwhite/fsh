@extends('layouts.master')

@section('title', 'Page Title')

@section('css')

@endsection

@section('sectionheader')
    PRODUCT DETAIL
@endsection

@section('content')



<div class="row">
    <div class="col-md-12">
        <p class="bg-info">You own this product (<a href="#">Edit</a>)</p>
    </div>
</div>


<div class="row">

    <div class="col-md-3">

        <div class="nutrition">

            <div class="nutrition-block">

                <h4>Nutrition Facts</h4>

                <div class="nutrition-meta serving-size">
                    <span class="nutrition-value">Serving Size&nbsp;{{$userproduct->serving_size}}</span>
                </div>
                <div class="nutrition-meta amount-per-serving">
                    <label>Amount Per Serving</label>
                </div>
                <div class="nutrition-meta calories">
                    <div class="col-lg-6 calories-left">
                        <label>Calories&nbsp;</label><span class="nutrition-value">{{$userproduct->calories}}</span>
                    </div>
                    <div class="col-lg-6 calories-right">
                        <span class="nutrition-value">Calories from Fat&nbsp;{{$userproduct->calories_from_fat}}</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="nutrition-meta total-fat">
                    <label>Total Fat&nbsp;</label><span class="nutrition-value">{{$userproduct->total_fat}}</span>
                </div>
                <div class="nutrition-meta saturated-fat">
                    <span class="nutrition-value">Saturated Fat&nbsp;{{$userproduct->saturated_fats}}</span>
                </div>
                <div class="nutrition-meta cholesteral">
                    <label>Cholesteral&nbsp;</label><span class="nutrition-value"></span>
                </div>
                <div class="nutrition-meta sodium">
                    <label>Sodium&nbsp;</label><span class="nutrition-value">{{$userproduct->sodium}}</span>
                </div>
                <div class="nutrition-meta carbohydrates">
                    <label>Total Carbohydrates&nbsp;</label><span class="nutrition-value">{{$userproduct->carbs}}</span>
                </div>
                <div class="nutrition-meta dietary-fibre">
                    <span class="nutrition-value">Dietary Fibre&nbsp;{{$userproduct->fibre}}</span>
                </div>
                <div class="nutrition-meta sugars">
                    <span class="nutrition-value">Sugars&nbsp;{{$userproduct->sugar}}</span>
                </div>
                <div class="nutrition-meta protein">
                    <label>Protein&nbsp;</label><span class="nutrition-value">{{$userproduct->protein}}</span>
                </div>
            </div>

            <h4>Dietary Information</h4>
            <div class="nutrition-meta">
                <label>Halal:</label>
                <span class="nutrition-value">{{($userproduct->is_halal) ? 'Yes' : 'No'}}</span>
            </div>
            <div class="nutrition-meta">
                <label>Organic:</label>
                <span class="nutrition-value">{{($userproduct->is_organic) ? 'Yes' : 'No'}}</span>
            </div>
            <div class="nutrition-meta">
                <label>Kosher:</label>
                <span class="nutrition-value">{{($userproduct->is_kosher) ? 'Yes' : 'No'}}</span>
            </div>

            <br/>

            <h4>Allergy Information</h4>
            @foreach($userproduct->allergens as $a)

            @endforeach

        </div>



    </div>

    <div class="col-md-9">

        <h1>
            {{$userproduct->name}}
            @if (Auth::check()
                && (Auth::user()->hasRole('admin') || (Auth::user()->hasRole('vendor'))))
            (<a href="{{url('profile/product', $userproduct->id)}}">edit</a>)
            @endif
        </h1>

        <h4>Description</h4>
        {{$userproduct->description}}<br/>

        <br/>

        <h4>Ingredients</h4>
        {{$userproduct->ingredient_deck}}<br/>

        <br/>

        <h4>Features, Advantages and Benefits</h4>
        @if($userproduct->features_benefits != '')
            {{$userproduct->features_benefits}}
        @else
            No information provided
        @endif
        <br/>

        <br/>

        <h4>Allergen Disclaimer</h4>
        @if($userproduct->allergen_disclaimer != '')
            {{$userproduct->allergen_disclaimer}}
        @else
            No information provided
        @endif
        <br/>

        <br/>

        <h4>Preparation &amp; Cooking Suggestions</h4>
        {{$userproduct->preparation}}<br/>

        <br/>

        <h4>Packaging &amp; Weights</h4>
        Pack:{{$userproduct->pack}}<br/>
        Size:{{$userproduct->size}}<br/>
        Calculation Size:{{$userproduct->calc_size}}<br/>
        Product Code:{{$userproduct->mpc}}<br/>
        GTIN:{{$userproduct->gtin}}<br/>
        Net Weight:{{$userproduct->net_weight}}<br/>
        Gross Weight:{{$userproduct->gross_weight}}<br/>
        Tare Weight:{{$userproduct->tare_weight}}<br/>

        {{$userproduct->brand}}<br/>
        {{$userproduct->calories}}<br/>
        {{$userproduct->uom}}<br/>


    </div>

</div>


@endsection

@section('scripts')


@endsection