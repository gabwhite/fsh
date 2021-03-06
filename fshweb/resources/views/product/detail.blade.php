@extends('layouts.master')

@section('title', trans('ui.navigation_product_detail', ['name' => $product->name]))

@section('css')

@endsection

@section('sectionheader')
<section class='clearfix container-wrap item-header'>
    <div class='container'>
        <div class="col-xs-12">
            <div class="col-xs-12 title-wrap">
                <h1 class="item-title">
                    {{$product->name}}
                    ({{trans('ui.product_label_pack')}}: {{$product->pack}} {{trans('ui.product_label_size')}}: {{$product->size}} {{$product->uom}} )
                </h1>
                <div class="star-detail">
                    <img src="{{url('/img/icons/star.svg')}}" alt="star-rating">
                </div>
            </div>
            <div class="col-xs-12 btn-row">
                @if (Auth::check())
                <button id="btnAddToFavs" class="btn-primary">{{trans('ui.product_label_add_to_my_products')}}</button>
                @endif

                <a href="{{url('vendor/detail', $product->vendor_id)}}"><button class="btn-primary">{{trans('ui.product_label_goto_vendor_profile')}}</button></a>
           
                <button data-target="#request-sample" data-toggle="modal" class="btn">{{trans('ui.product_label_request_sample')}}</button>
            </div>
        </div>

        <div class="container auth-check ">
            @if ($canEdit)
                <div class="col-xs-12">
                    
                    <div class="bg-info clearfix">
                        <p class="pull-left">{{trans('messages.product_administrator_notice')}}</p>
                        
                        <a href="{{url('product/edit', $product->id)}}"><button class="btn-sm pull-right">{{trans('ui.product_label_edit_product')}}</button></a>
                    </div>

                </div>

            @endif
        </div>

    </div>
</section>
@endsection

@section('content')
    <div class="container">
        <div class="col-xs-12"> 
        
            <div class="col-xs-12 well">  
                <div class="col-xs-12 col-md-4 text-center ">

                    @if($product->product_image)
                        @if(strpos($product->product_image, 'http') !== false)
                           <div class="product-img" style="background: url({{$product->product_image}}) no-repeat; background-size: contain; background-position: center;"></div> 
                        @else
                            <div class="product-img" style="background: url('{{url(config('app.product_storage') . '/' . $product->product_image)}}') no-repeat; background-size: contain; background-position: center;"></div>
                            
                        @endif
                    @else
                        <div class="product-img" style="background: url({{url('/img/no-photo-avail.svg')}}) no-repeat; background-size: contain; background-position: center;"></div>
                    @endif
                    
                    @if(isset($brandHack))
                        <div class="detail-brand" style="background:url({{url(config('app.vendor_storage'), $brandHack)}}) no-repeat; background-position: center; background-size: contain;"></div>
                    @endif
                </div>

                <div class="col-xs-12 col-md-8">
                    <h3>{{$product->description}}</h3>

                    <button data-target="#rate-product" data-toggle="modal" class="btn">{{trans('ui.product_label_rate_product')}}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        
        <div class="col-xs-12 col-md-4 drop-padding">
            <div class="row">
                <div class="col-xs-12 col-md-10">
                    <div class="nutrition">

                        <div class="col-xs-12 nutrition-block">

                            <h4>{{trans('ui.product_label_nutrition_facts')}}</h4>

                            <div class="nutrition-meta serving-size">
                                <span class="nutrition-value">{{trans('ui.product_label_serving_size')}}&nbsp;{{$product->calc_size}}</span>
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
                        <div class="table-row clearfix">
                            <p>{{trans('ui.product_label_halal')}}:</p>
                            <p>{{($product->is_halal) ? trans('ui.general_label_yes') : trans('ui.general_label_no')}}</p>
                        </div>

                        <div class="table-row clearfix">
                            <p>{{trans('ui.product_label_organic')}}:</p>
                            <p>{{($product->is_organic) ? trans('ui.general_label_yes') : trans('ui.general_label_no')}}</p>
                        </div>

                        <div class="table-row clearfix">
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
                            <div class="table-row clearfix">
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

        <div class="col-xs-12 col-md-8">
            <h2 class="item-subhead">{{trans('ui.product_label_product_details')}}</h2>
            
            <div class="well col-xs-12">

                <div class="detail-row">  
                    <h4>{{trans('ui.product_label_ingredients')}}</h4>
                    @if($product->ingredient_deck != '')
                        <p>{{$product->ingredient_deck}}</p>
                    @else
                        <p>{{trans('ui.product_label_no_information')}}</p>
                    @endif
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
                    @if($product->preparation != '')
                        <p> {{$product->preparation}}</p>
                    @else
                        <p>{{trans('ui.product_label_no_information')}}</p>
                    @endif
                </div>

            </div>
            
            <div class="row">
                <div class="col-xs-12 drop-padding">
                    
                    <h2 class="item-subhead">{{trans('ui.product_label_packaging_weights')}}</h2>
                
                    <div class="well col-xs-12">
                        <div class="col-xs-12 col-sm-6 drop-padding">

                            <div class="table-row clearfix">
                                <p>{{trans('ui.product_label_product_code')}}:</p>
                                <p>{{$product->mpc}}</p>
                            </div>

                            <div class="table-row clearfix">
                                <p>{{trans('ui.product_label_gtin')}}:</p>
                                <p>{{$product->gtin}}</p>
                            </div>

                        </div>
                        
                        <div class="col-xs-12 col-sm-6 drop-padding">

                            <div class="table-row clearfix">
                                <p>{{trans('ui.product_label_net_weight')}}:</p>
                                <p>{{$product->net_weight}}</p>
                            </div>

                            <div class="table-row clearfix">
                                <p>{{trans('ui.product_label_gross_weight')}}:</p>
                                <p>{{$product->gross_weight}}</p>
                            </div>

                            <div class="table-row clearfix">
                                <p>{{trans('ui.product_label_tare_weight')}}:</p>
                                <p>{{$product->tare_weight}}</p>
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

    <!-- ADD TO PRODUCTS MODAL -->

    <div class="modal fade centered" id="add-product" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content col-xs-12">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <div class="modal-header">
                <img src="{{url('/img/icons/check.svg')}}" alt="" class="center-block check">
                <h4 class="modal-title">Added to My Products</h4>
              </div>
          
              <div class="modal-body text-center col-xs-12">
                <p>This item will be saved to your profile.</p>
              </div>
          
              <div class="modal-footer col-xs-12">
                <a href="#" id="hlSaveHeader"><button type="button" data-dismiss="modal" class="btn-primary">Done</button></a>
              </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection

@section('scripts')

    <script type="text/javascript" src="{{url('js/fsh.common.js')}}"></script>
    <script type="text/javascript">

        $(document).ready(function()
        {
            $("#btnAddToFavs").on("click", function(e)
            {
                e.preventDefault();
                fsh.common.doAjax("{{url('ajax/addproductfav')}}", {productId: "{{$product->id}}"}, "POST", true, { "X-CSRF-TOKEN": "{{ csrf_token() }}" }, function(result)
                {
                    $("#add-product").modal("show");
                    //console.log(result);
                },
                function()
                {
                    alert("There was an error, please try again");
                });
            });
        });
    </script>

@endsection