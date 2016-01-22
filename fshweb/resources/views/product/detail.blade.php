@extends('layouts.master')

@section('title', trans('ui.navigation_product_detail'))

@section('css')

@endsection

@section('sectionheader')
<section class='clearfix container-wrap item-header'>
    <div class='container'>
        <div class="col-xs-12">
            <div class="title-wrap">
                <h1 class="item-title">{{$product->name}}</h1>
                <div class="star-detail">
                    <img src="../../img/icons/star.svg" alt="star-rating">
                </div>
            </div>
            <div class="btn-row">
                <a href="javascript:alert('Coming Soon');"><button class="btn-primary">{{trans('ui.product_label_add_to_my_products')}}</button></a>
           
                <a href="{{url('vendor/detail', $product->vendor_id)}}"><button class="btn-primary">{{trans('ui.product_label_goto_vendor_profile')}}</button></a>
           
                <button data-target="#request-sample" data-toggle="modal" class="btn">{{trans('ui.product_label_request_sample')}}</button>
            </div>
        </div>

        <div class="col-xs-12 auth-check">
            @if ($canEdit)

                <div class="bg-info clearfix">
                    <p class="pull-left">{{trans('messages.product_administrator_notice')}}</p>
                    
                    <a href="{{url('product/edit', $product->id)}}"><button class="btn-sm pull-right">{{trans('ui.product_label_edit_product')}}</button></a>
                    
                </div>

            @endif
        </div>

    </div>
</section>
@endsection

@section('content')
    <div class="container">
        <div class="col-xs-12 well">  
            <div class="col-xs-12 col-md-4 text-center reset-left">
                <img src="../../img/no-photo-avail.svg" alt="item not pictured">
                
                <div class="detail-brand">
                    <img src="../../img/slider/ROLAND-LOGO-BANNER-SIZE.png" alt="brand-logo">
                </div>
            </div>

            <div class="col-xs-12 col-md-8">
                <h3>{{$product->description}}</h3>

                <button data-target="#rate-product" data-toggle="modal" class="btn">{{trans('ui.product_label_rate_product')}}</button>
            </div>
        </div>
    </div>

    <div class="container">
        
        <div class="col-xs-12 col-md-4 reset-padding">
            <div class="row">
                <div class="col-xs-12 col-md-10">
                    <div class="nutrition">

                        <div class="col-xs-12 nutrition-block">

                            <h4>{{trans('ui.product_label_nutrition_facts')}}</h4>

                            <div class="nutrition-meta serving-size">
                                <span class="nutrition-value">{{trans('ui.product_label_serving_size')}}&nbsp;{{$product->serving_size}}</span>
                            </div>

                            <div class="col-xs-12 nutrition-meta amount-per-serving">
                                <label>{{trans('ui.product_label_amount_per_serving')}}</label>
                            </div>

                            <div class="col-xs-12 nutrition-meta calories">
                                <div class="col-xs-6 calories-left">
                                    <label>{{trans('ui.product_label_calories')}}
                                    <span class="nutrition-value">{{$product->calories}}</span></label>
                                </div>

                                <div class="col-xs-6 calories-right">
                                    <label for="calories_from_fat"><span class="nutrition-value"> {{trans('ui.product_label_calories_from_fat')}} {{$product->calories_from_fat}}</span></label>
                                </div>

                            </div>

                            <div class="col-xs-12 nutrition-meta total-fat">
                                <label>{{trans('ui.product_label_total_fat')}}<span class="nutrition-value"> {{$product->total_fat}}</span></label>
                            </div>

                            <div class="col-xs-12 nutrition-meta saturated-fat">
                                <span class="nutrition-value">{{trans('ui.product_label_saturated_fat')}}&nbsp;{{$product->saturated_fats}}</span>
                            </div>

                            <div class="col-xs-12 nutrition-meta cholesteral">
                                <label>{{trans('ui.product_label_cholesterol')}}&nbsp;<span class="nutrition-value">{{$product->cholesterol}}</span></label>
                            </div>

                            <div class="col-xs-12 nutrition-meta sodium">
                                <label>{{trans('ui.product_label_sodium')}}&nbsp;<span class="nutrition-value">{{$product->sodium}}</span></label>
                            </div>

                            <div class="col-xs-12 nutrition-meta carbohydrates">
                                <label>{{trans('ui.product_label_total_carbs')}}&nbsp;<span class="nutrition-value">{{$product->carbs}}</span></label>
                            </div>

                            <div class="col-xs-12 nutrition-meta dietary-fibre">
                               <span class="nutrition-value">{{trans('ui.product_label_dietary_fibre')}}&nbsp;{{$product->fibre}}</span>
                            </div>

                            <div class="col-xs-12 nutrition-meta sugars">
                                <span class="nutrition-value">{{trans('ui.product_label_sugars')}}&nbsp;{{$product->sugar}}</span>
                            </div>

                            <div class="col-xs-12 nutrition-meta protein">
                                <label>{{trans('ui.product_label_protein')}}
                                <span class="nutrition-value">{{$product->protein}}</span></label>
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
                        <div class="col-xs-12 col-sm-6 drop-padding">
                            
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
                        
                        <div class="col-xs-12 col-sm-6 drop-padding">
                            
                            <div class="table-row">
                                <p>{{trans('ui.product_label_gross_weight')}}:</p>
                                <p>{{$product->gross_weight}}</p>
                            </div>

                            <div class="table-row">
                                <p>{{trans('ui.product_label_tare_weight')}}:</p>
                                <p>{{$product->tare_weight}}</p>
                            </div>
                            
                            <div class="table-row">    
                                <p>{{trans('ui.product_label_brand')}}:</p>
                                <p>{{$product->brand}}</p>
                            </div>
                            
                            <div class="table-row">    
                                <p>{{trans('ui.product_label_calories')}}:</p>
                                <p>{{$product->calories}}</p>
                            </div>
                            
                            <div class="table-row">   
                                <p>{{trans('ui.product_label_uom')}}:</p>
                                <p>{{$product->uom}}</p>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
        
    </div><!-- end of container -->
    
    <!-- RATING MODAL -->

    <div class="modal fade centered" id="rate-product" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content col-xs-12">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <div class="modal-header">
                <h4 class="modal-title">Rate this Product</h4>
              </div>
          
              <div class="modal-body text-center col-xs-12">
                <p>Select a star rating to add your rating to the product average.</p>

                <div class="rate-this col-xs-12">
                    <div class="each-star"></div>
                    <div class="each-star"></div>
                    <div class="each-star"></div>
                    <div class="each-star"></div>
                    <div class="each-star"></div>
                    
                </div>
              </div>
          
              <div class="modal-footer col-xs-12">
                <a href="#" id="hlSaveHeader"><button type="button" class="btn-primary">{{trans('ui.button_submit_rating')}}</button></a>
              </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



    <!-- Request a Sample Modal -->
    <div class="modal fade centered" id="request-sample" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content col-xs-12">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <div class="modal-header">
                <h4 class="modal-title">Request a Sample</h4>
              </div>
          
              <div class="modal-body col-xs-12">
                <p class="text-center">Contact the product vendor to request a sample.</p>

                <div class="col-xs-12">
                    <div class="col-xs-12 col-md-6 detail-row">
                        <label for="firstname">{{trans('ui.user_label_firstname')}}</label>
                        
                        <input type="text" name="firstname" placeholder="" class="form-control" maxlength="100" value="{{isset($profile) ? $profile->firstname : ''}}"/>
                    </div>

                    <div class="col-xs-12 col-md-6 detail-row">
                        <label for="lastname">{{trans('ui.user_label_lastname')}}</label>
                    
                        <input type="text" name="lastname" placeholder="" class="form-control" maxlength="100" value="{{isset($profile) ? $profile->lastname : ''}}"/>
                    </div>

                    <div class="col-xs-12 col-md-12 detail-row">
                        <label for="email">{{trans('ui.user_label_email')}}</label>
                        <input type="text" name="email" placeholder="" class="form-control" value="{{(Auth::check()) ? Auth::user()->email : ''}}" maxlength="100"/>
                    </div>
                    
                    <div class="col-xs-12 col-md-12 detail-row">
                        <label for="address">{{trans('ui.vendor_label_address1')}}</label>
                        <input type="text" name="address1" placeholder="" maxlength="200" class="form-control" value=""/>
                    </div>
                    
                    <div class="col-xs-12 col-md-12 detail-row">
                        <label for="city">{{trans('ui.vendor_label_city')}}</label>
                        <input type="text" name="city" placeholder="" maxlength="200" class="form-control" value=""/>
                    </div>
                    
                    <div class="col-xs-12 col-md-12 detail-row">
                        <label for="country_id">{{trans('ui.vendor_label_country')}}</label>
                         <select id="country_id" name="country_id" class="form-control"></select>
                    </div>
                    
                    <div class="col-xs-12 col-md-6 detail-row">
                        <label for="state_province_id">{{trans('ui.vendor_label_state_province')}}</label>
                        <select id="state_province_id" name="state_province_id" class="form-control">
                            <option value=""></option>
                            <option value="">{{trans('ui.vendor_label_choose_country')}}</option>
                        </select>
                    </div>
                    
                    <div class="col-xs-12 col-md-6 detail-row">
                        <label for="zip_postal">{{trans('ui.vendor_label_zip_postal')}}</label>

                        <input type="text" name="zip_postal" placeholder="" maxlength="50" class="form-control" value=""/>
                    </div>
                    
                </div>
              </div>
          
              <div class="modal-footer col-xs-12">
                <a href="#" id="hlSaveHeader"><button type="button" class="btn-primary">{{trans('ui.button_submit')}}</button></a>
              </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection

@section('scripts')


@endsection