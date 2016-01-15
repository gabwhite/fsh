@extends('layouts.master')

@section('title', trans('ui.navigation_product_detail'))

@section('css')

@endsection

@section('sectionheader')
<section class='clearfix container-wrap item-header'>
    <div class='container'>
        <div class="col-xs-12">
            <h1 class="item-title">{{$product->name}}</h1>
            <div class="btn-row">
                <a href="javascript:alert('Coming Soon');"><button class="btn-primary">{{trans('ui.product_label_add_to_my_products')}}</button></a>
            </div>

            <div class="btn-row">
                <a href="{{url('vendor/detail', $product->vendor_id)}}"><button class="btn-primary">{{trans('ui.product_label_goto_vendor_profile')}}</button></a>
            </div>

            <div class="btn-row">
                <a href="javascript:alert('Coming Soon');"><button class="btn">{{trans('ui.product_label_request_sample')}}</button></a>
            </div>
        </div>

        <div class="col-xs-12 auth-check">
            @if ($canEdit)

                <div class="bg-info clearfix">
                    <p class="pull-left">{{trans('messages.product_administrator_notice')}}</p>
                    <button class="btn-sm pull-right">
                        <a href="{{url('product/edit', $product->id)}}">{{trans('ui.product_label_edit_product')}}</a>
                    </button>
                </div>

            @endif
        </div>

    </div>
</section>
@endsection

@section('content')
    <div class="container">
        <div class="col-xs-12 well">  
            <div class="col-xs-12 col-md-4">
                <img src="http://placehold.it/200x300" alt="">
            </div>

            <div class="col-xs-12 col-md-8">
                <h3>{{trans('ui.product_label_description')}}</h3>
                <h3>{{$product->description}}</h3>

                <button class="btn">{{trans('ui.product_label_rate_product')}}</button>
            </div>
        </div>
    </div>

    <div class="container">
        
        <div class="col-xs-12 col-md-4 reset-padding">
            <div class="row">
                <div class="col-xs-12 col-md-10">
                    <div class="nutrition">

                        <div class="nutrition-block">

                            <h4>{{trans('ui.product_label_nutrition_facts')}}</h4>

                            <div class="nutrition-meta serving-size">
                                <span class="nutrition-value">{{trans('ui.product_label_serving_size')}}&nbsp;{{$product->serving_size}}</span>
                            </div>

                            <div class="nutrition-meta amount-per-serving">
                                <label>{{trans('ui.product_label_amount_per_serving')}}</label>
                            </div>

                            <div class="nutrition-meta calories">
                                <div class="col-lg-6 calories-left">
                                    <label>{{trans('ui.product_label_calories')}}&nbsp;</label><span class="nutrition-value">{{$product->calories}}</span>
                                </div>

                                <div class="col-lg-6 calories-right">
                                    <span class="nutrition-value">{{trans('ui.product_label_calories_from_fat')}}&nbsp;{{$product->calories_from_fat}}</span>
                                </div>

                                <div class="clearfix"></div>

                            </div>

                            <div class="nutrition-meta total-fat">
                                <label>{{trans('ui.product_label_total_fat')}}&nbsp;</label><span class="nutrition-value">{{$product->total_fat}}</span>
                            </div>

                            <div class="nutrition-meta saturated-fat">
                                <span class="nutrition-value">{{trans('ui.product_label_saturated_fat')}}&nbsp;{{$product->saturated_fats}}</span>
                            </div>

                            <div class="nutrition-meta cholesteral">
                                <label>{{trans('ui.product_label_cholesterol')}}&nbsp;</label><span class="nutrition-value"></span>
                            </div>

                            <div class="nutrition-meta sodium">
                                <label>{{trans('ui.product_label_sodium')}}&nbsp;</label><span class="nutrition-value">{{$product->sodium}}</span>
                            </div>

                            <div class="nutrition-meta carbohydrates">
                                <label>{{trans('ui.product_label_total_carbs')}}&nbsp;</label><span class="nutrition-value">{{$product->carbs}}</span>
                            </div>

                            <div class="nutrition-meta dietary-fibre">
                                <span class="nutrition-value">{{trans('ui.product_label_dietary_fibre')}}&nbsp;{{$product->fibre}}</span>
                            </div>

                            <div class="nutrition-meta sugars">
                                <span class="nutrition-value">{{trans('ui.product_label_sugars')}}&nbsp;{{$product->sugar}}</span>
                            </div>

                            <div class="nutrition-meta protein">
                                <label>{{trans('ui.product_label_protein')}}&nbsp;</label><span class="nutrition-value">{{$product->protein}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-md-10">
                
                    <h2 class="item-subhead">{{trans('ui.product_label_dietary_info')}}</h2>
                    
                    <div class="col-xs-12 well"> 
                        <div class="table-row">
                            <p>{{trans('ui.product_label_halal')}}:</p>
                            <p>{{($product->is_halal) ? trans('ui.general_label_yes') : trans('ui.general_label_no')}}</p>
                        </div>

                        <div class="table-row">
                            <p>{{trans('ui.product_label_organic')}}:</p>
                            <p>{{($product->is_organic) ? trans('ui.general_label_yes') : trans('ui.general_label_no')}}</p>
                        </div>

                        <div class="table-row">
                            <p>{{trans('ui.product_label_kosher')}}:</p>
                            <p>{{($product->is_kosher) ? trans('ui.general_label_yes') : trans('ui.general_label_no')}}</p>
                        </div>
                    </div>
                </div>
             </div>
                
            <div class="row">
                <div class="col-xs-12 col-md-10">

                    <h2 class="item-subhead">{{trans('ui.product_label_allergy_info')}}</h2>
                    
                    <div class="col-xs-12 well">

                        @forelse($product->allergens as $a)
                            <div class="table-row">
                                <p>{{$a->name}}</p>
                                <p>&nbsp;</p>
                            </div>
                        @empty
                            <p>{{trans('ui.product_label_no_information')}}</p>
                        @endforelse

                    </div>
                 </div>   
            </div>

        </div>

        <div class="col-xs-12 col-md-8 reset-padding">
            <h2 class="item-subhead">{{trans('ui.navigation_product_detail')}}</h2>
            
            <div class="well col-xs-12">

                <div class="detail-row">  
                    <h4>{{trans('ui.product_label_ingredients')}}</h4>
                    <p>{{$product->ingredient_deck}}</p>
                </div>

                <div class="detail-row">
                    <h4>{{trans('ui.product_label_features')}}</h4>
                    @if($product->features_benefits != '')
                        <p>{{$product->features_benefits}}</p>
                    @else
                        <p>{{trans('ui.product_label_no_information')}}</p>
                    @endif
                </div>

                <div class="detail-row">
                    <h4>{{trans('ui.product_label_allergen_disclaimer')}}</h4>
                    @if($product->allergen_disclaimer != '')
                       <p> {{$product->allergen_disclaimer}}</p>
                    @else
                        <p>{{trans('ui.product_label_no_information')}}</p>
                    @endif
                </div>
                
                <div class="detail-row">
                    <h4>{{trans('ui.product_label_preparation')}}</h4>
                    <p>{{$product->preparation}}</p>
                </div>

            </div>
            
            <div class="row">
                <div class="col-xs-12">
                    
                    <h2 class="item-subhead">{{trans('ui.product_label_packaging_weights')}}</h2>
                
                    <div class="well col-xs-12">
                        <div class="col-xs-12 col-sm-6">
                            
                            <div class="table-row">
                                <p>{{trans('ui.product_label_pack')}}:</p>
                                <p>{{$product->pack}}</p>
                            </div>
                            
                            <div class="table-row">
                                <p>{{trans('ui.product_label_size')}}:</p>
                                <p>{{$product->size}}</p>
                            </div>

                            <div class="table-row">
                                <p>{{trans('ui.product_label_calculation_size')}}:</p>
                                <p>{{$product->calc_size}}</p>
                            </div>

                            <div class="table-row">
                                <p>{{trans('ui.product_label_product_code')}}:</p>
                                <p>{{$product->mpc}}</p>
                            </div>

                            <div class="table-row">
                                <p>{{trans('ui.product_label_gtin')}}:</p>
                                <p>{{$product->gtin}}</p>
                            </div>
                            
                            <div class="table-row">
                                <p>{{trans('ui.product_label_net_weight')}}:</p>
                                <p>{{$product->net_weight}}</p>
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-6">
                            
                            <div class="table-row">
                                <p>{{trans('ui.product_label_gross_weight')}}:</p>
                                <p>{{$product->gross_weight}}</p>
                            </div>

                            <div class="table-row">
                                <p>{{trans('ui.product_label_tare_weight')}}:</p>
                                <p>{{$product->tare_weight}}</p>
                            </div>
                            
                            <div class="table-row">    
                                <p>Brand:</p>
                                <p>{{$product->brand}}</p>
                            </div>
                            
                            <div class="table-row">    
                                <p>Calories:</p>
                                <p>{{$product->calories}}</p>
                            </div>
                            
                            <div class="table-row">   
                                <p>Unit of Measure:</p>
                                <p>{{$product->uom}}</p>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
        
    </div><!-- end of container -->


@endsection

@section('scripts')


@endsection