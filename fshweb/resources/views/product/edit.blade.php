@extends('layouts.master')

@section('title', trans('ui.navigation_product_edit', ['name' => $product->name]))

@section('css')

@endsection

@section('sectionheader')

<section class='clearfix container-wrap item-header'>
    <div class='container'>
        <div class="col-xs-12">
            <div class="col-xs-12">
                <h1 class="item-title">{{trans('ui.navigation_product_edit', ['name' => $product->name])}}</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="container">
            <div class="col-xs-12">
                <div class="{{($product->published) ? 'bg-success' : 'bg-danger'}}">
                    <input type="checkbox" id="cbPublished" name="cbPublished" {!! ($product->published == 1) ? 'checked="checked"' : ''!!}/> <label for="cbPublished">{{trans('ui.product_label_published')}}</label>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')

    <div class="container">

        <form id="form1" name="form1" method="post" action="{{url('product/edit')}}" enctype="multipart/form-data">

            <div id="divCategoryDropdowns" class="col-xs-12 col-md-12">
                <div class="col-xs-12 well">
                    <h4>Category</h4>

                    <select id="ddlbCategory" name="category1" class="search-dropdown">
                        <template v-for="c in categories">
                            <option v-bind:value="c.id" v-if="c.id == selectedCategoryId" selected="selected">@{{ c.name }}</option>
                            <option v-bind:value="c.id" v-else>@{{ c.name }}</option>
                        </template>
                    </select>
                    <select id="ddlbSubCategory" name="category2" class="search-dropdown">
                        <template v-for="s in subCategories">
                            <option v-bind:value="s.id" v-if="s.id == selectedSubCategoryId" selected="selected">@{{ s.name }}</option>
                            <option v-bind:value="s.id" v-else>@{{ s.name }}</option>
                        </template>
                    </select>
                    <select id="ddlbProductType" name="category3" class="search-dropdown">

                        <template v-for="p in productTypes">
                            <option  v-bind:value="p.id" v-if="p.id == selectedProductTypeId" selected="selected">@{{ p.name }}</option>
                            <option  v-bind:value="p.id" v-else>@{{ p.name }}</option>
                        </template>
                    </select>

                </div>
            </div>


            <div class="col-xs-12 col-md-12">
                
                <div class="col-xs-12 well">
                    <h4>{{trans('ui.product_label_name')}}</h4>
                    <input type="text" name="name" class="form-control input-lg" maxlength="500" placeholder="{{trans('ui.product_label_name_placeholder')}}" value="{{$product->name}}"/>

                    <h4>{{trans('ui.product_label_description')}}</h4>
                    <textarea title="description" name="description" class="form-control" cols="80" rows="3">{{$product->description}}</textarea>
                
                </div>
            </div>

            <div class="col-xs-12 col-md-4">
                <div class="nutrition-block col-xs-12 col-md-10">
                        
                    <h4>{{trans('ui.product_label_nutrition_facts')}}</h4>

                    <div class="col-xs-12 nutrition-meta serving-size">
                        <span class="nutrition-value">{{trans('ui.product_label_serving_size')}}&nbsp;<input type="text" name="serving_size" class="form-control input-sm" maxlength="10" value="{{$product->serving_size}}"/></span>
                    </div>

                    <div class="col-xs-12 nutrition-meta amount-per-serving">
                            
                        <label>{{trans('ui.product_label_amount_per_serving')}}</label>
                        
                    </div>

                    <div class="col-xs-12 nutrition-meta calories">
                        
                        <div class="col-xs-6 calories-left">
                            <label>{{trans('ui.product_label_calories')}}&nbsp;</label><span class="nutrition-value"><input type="text" name="calories" class="form-control input-sm" maxlength="10" value="{{$product->calories}}"/></span>
                        </div>

                        <div class="col-xs-6 calories-right">
                            <label class="nutrition-value">{{trans('ui.product_label_calories_from_fat')}}&nbsp;
                            </label>
                            <input type="text" name="calories_from_fat" class="form-control input-sm" maxlength="10" value="{{$product->calories_from_fat}}"/>
                        </div>

                    </div>
                                
                    <div class="col-xs-12 nutrition-meta total-fat">  
                        <label>{{trans('ui.product_label_total_fat')}}&nbsp;</label><span class="nutrition-value"><input type="text" name="total_fat" class="form-control input-sm" maxlength="10" value="{{$product->total_fat}}"/></span>
                    </div>
                        
                    <div class="col-xs-12 nutrition-meta">
                        <label class="nutrition-value">{{trans('ui.product_label_saturated_fat')}}&nbsp;</label><input type="text" name="saturated_fats" class="form-control input-sm" maxlength="10" value="{{$product->saturated_fats}}"/>
                    </div>
                                
                    <div class="col-xs-12 nutrition-meta cholesteral">
                        <label>{{trans('ui.product_label_cholesterol')}}&nbsp;</label><input type="text" name="saturated_fats" class="form-control input-sm" maxlength="10" value="{{$product->cholesteral}}"/>
                    </div>
                            
                    <div class="col-xs-12 nutrition-meta sodium">
                        <label>{{trans('ui.product_label_sodium')}}&nbsp;</label><span class="nutrition-value"><input type="text" name="sodium" class="form-control input-sm" maxlength="10" value="{{$product->sodium}}"/></span>
                    </div>

                    <div class="col-xs-12 nutrition-meta carbohydrates">
                        <label>{{trans('ui.product_label_total_carbs')}}&nbsp;</label><span class="nutrition-value"><input type="text" name="carbs" class="form-control input-sm" maxlength="10" value="{{$product->carbs}}"/></span>
                    </div>
                    
                    <div class="col-xs-12 nutrition-meta">
                        <label class="nutrition-value">{{trans('ui.product_label_dietary_fibre')}}&nbsp;</label><input type="text" name="fibre" class="form-control input-sm" maxlength="10" value="{{$product->fibre}}"/>
                    </div>
                        
                    <div class="col-xs-12 nutrition-meta">
                        <label class="nutrition-value">{{trans('ui.product_label_sugars')}}&nbsp;</label><input type="text" name="sugar" class="form-control input-sm" maxlength="10" value="{{$product->sugar}}"/>
                    </div>
                    
                    <div class="col-xs-12 nutrition-meta protein">
                        <label>{{trans('ui.product_label_protein')}}&nbsp;</label><span class="nutrition-value"><input type="text" name="protein" class="form-control input-sm" maxlength="10" value="{{$product->protein}}"/></span>
                    </div>
                
                </div><!--  end of nutrition block -->
                               
                <!-- beginning of nutrition info -->
                <div class="row">
                    <div class="col-xs-12 col-md-10 drop-padding">
                        <h2 class="item-subhead">{{trans('ui.product_label_dietary_info')}}</h2>

                        <div class="col-xs-12 well">
                            <div class="nutrition-meta">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="is_halal" {{($product->is_halal) ? 'checked="checked"' : ''}}> Halal
                                    </label>
                                </div>
                            </div>
                                
                            <div class="nutrition-meta">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="is_organic" {{($product->is_organic) ? 'checked="checked"' : ''}}> Organic
                                    </label>
                                </div>
                            </div>
                                
                            <div class="nutrition-meta">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="is_kosher" {{($product->is_kosher) ? 'checked="checked"' : ''}}> Kosher
                                    </label>
                                </div>
                            </div>
                        </div>        
                    </div>
                </div>
                
                <!-- Allergy Info -->
                <div class="row">
                    <div class="col-xs-12 col-md-10 drop-padding">
                        <h2 class="item-subhead">{{trans('ui.product_label_allergy_info')}}</h2>
                        
                        <div class="well col-xs-12">
                            @foreach($allergens as $a)
                            <div class="checkbox">
                                <label>

                                    @foreach($product->allergens as $pa)

                                        @if($a->id == $pa->id)
                                            <input type="checkbox" name="allergens[]" value="{{$a->id}}" checked="checked">{{$a->name}}
                                        @else
                                            <input type="checkbox" name="allergens[]" value="{{$a->id}}">{{$a->name}}
                                        @endif

                                    @endforeach


                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>   
            </div>
                
            <!-- Main column Product details -->

            <div class="col-xs-12 col-md-8">
                <h2 class="item-subhead">{{trans('ui.product_label_product_details')}}</h2>

                <div class="well col-xs-12">
                  <div class="detail-row">
                      <h4>{{trans('ui.product_label_ingredients')}}</h4>
                      <textarea title="ingredient_deck" name="ingredient_deck" class="form-control" cols="80" rows="3">{{$product->ingredient_deck}}</textarea>
                  </div>

                  <div class="detail-row">
                      <h4>{{trans('ui.product_label_features')}}</h4>
                      <textarea title="features_benefits" name="features_benefits" class="form-control" cols="80" rows="3">{{$product->features_benefits}}</textarea>
                  </div>

                  <div class="detail-row">
                      <h4>{{trans('ui.product_label_allergen_disclaimer')}}</h4>
                      <textarea title="allergen_disclaimer" name="allergen_disclaimer" class="form-control" cols="80" rows="3">{{$product->allergen_disclaimer}}</textarea>
                  </div>

                  <div class="detail-row">
                      <h4>{{trans('ui.product_label_preparation')}}</h4>
                      <textarea title="preparation" name="preparation" class="form-control" cols="80" rows="3">{{$product->preparation}}</textarea><br/>
                  </div>
                </div>

                <div class="row">
                        
                    <div class="col-xs-12 drop-padding">
                          
                        <h2 class="item-subhead">{{trans('ui.product_label_packaging_weights')}}</h2>
                        
                        <div class="well col-xs-12">
                            
                            <div class="col-xs-12 col-md-6">
                                
                                {{trans('ui.product_label_pack')}}:<input type="text" name="pack" title="pack" class="form-control" maxlength="10" value="{{$product->pack}}"/>

                                {{trans('ui.product_label_size')}}:<input type="text" name="size" title="size" class="form-control" maxlength="9" value="{{$product->size}}"/>

                                {{trans('ui.product_label_calculation_size')}}:<input type="text" name="calc_size" title="calc_size" class="form-control" maxlength="10" value="{{$product->calc_size}}"/>

                                {{trans('ui.product_label_product_code')}}:<input type="text" id="mpc" name="mpc" title="mpc" class="form-control" maxlength="250" value="{{$product->mpc}}"/>
                                
                                {{trans('ui.product_label_gtin')}}:<input type="text" id="gtin" name="gtin" title="gtin" class="form-control" maxlength="250" value="{{$product->gtin}}"/>
                                
                                {{trans('ui.product_label_net_weight')}}:<input type="text" name="net_weight" title="net_weight" class="form-control" maxlength="9" value="{{$product->net_weight}}"/>
                            
                            </div>

                            <div class="col-xs-12 col-md-6">

                                {{trans('ui.product_label_gross_weight')}}:<input type="text" name="gross_weight" title="gross_weight" class="form-control" maxlength="9" value="{{$product->gross_weight}}"/>

                                {{trans('ui.product_label_tare_weight')}}:<input type="text" name="tare_weight" title="tare_weight" class="form-control" maxlength="9" value="{{$product->tare_weight}}"/>
                                
                                {{trans('ui.product_label_brand')}}: <input type="text" name="brand" title="brand" class="form-control" maxlength="250" value="{{$product->brand}}">

                                {{trans('ui.product_label_calories')}}: <input type="text" name="calories" title="calories" class="form-control" maxlength="9" value="{{$product->calories}}">
                                
                                {{trans('ui.product_label_uom')}}: <input type="text" name="uom" title="uom" class="form-control" maxlength="9" value="{{$product->uom}}">

                            </div>

                        </div>  

                      </div>

                    </div>

                </div>

                <div class="col-xs-12 col-md-8">
                    <h2 class="item-subhead">Product Image</h2>

                    <div class="well col-xs-12">
                        @if($product->product_image)
                            <img src="{{url(config('app.product_storage') . '/' . $product->product_image)}}" alt="" />
                        @else
                            <img src="{{url('/img/no-photo-avail.svg')}}" alt="item not pictured" />
                        @endif

                        <input type="file" name="product_image"/>
                    </div>
                    
                    <div class="col-xs-12 drop-padding">    
                        <div class="btn-row row pull-right">
                            <a href="{{($product->id) ? url('product/detail', $product->id) : url('profile/')}}"><button type="button" class="btn">{{trans('ui.button_cancel')}}</button></a>
                            <a id="hlDeleteProduct" href="#"><button type="button" class="btn">{{trans('ui.button_delete')}}</button></a>
                            <input type="submit" class="btn-primary" value="{{trans('ui.button_addupdate')}}"/>
                        </div>
                    </div>
                </div>


            

            <input type="hidden" name="id" value="{{$product->id}}"/>
            <input type="hidden" id="action" name="action" value=""/>
            <input type="hidden" id="published" name="published" value="{{$product->published}}"/>
            {!! csrf_field() !!}

        </form>

    </div><!-- End of main row -->


@endsection

@section('scripts')

    <script src="{{url('js/vendor/vuejs/vue.min.js')}}"></script>
    <script src="{{url('js/vendor/validation/jquery.validate.min.js')}}"></script>
    <script src="{{url('js/vendor/validation/additional-methods.min.js')}}"></script>
    <script src="{{url('js/fsh.product.edit.js')}}"></script>
    <script type="text/javascript">

        var productCategories = [];
        @foreach ($product->categories as $c)
            productCategories.push({id: {{$c->id}}, parent_id: {{$c->parent_id or 'null'}}});
        @endforeach

        $(document).ready(function()
        {

            fsh.productedit.init("{{url('ajax/getfoodcategories/')}}",
                    productCategories
            );

            var theForm = $("#form1");

            theForm.validate({
                errorClass: "validationError",
                rules:
                {
                    name: { required: true, maxlength: 200 },
                    description: { required: true },
                    serving_size: { digits: true },
                    calories: { digits: true },
                    calories_from_fat: { digits: true },
                    total_fat: { digits: true },
                    saturated_fats: { digits: true },
                    sodium: { digits: true },
                    carbs: { digits: true },
                    fibre: { digits: true },
                    sugar: { digits: true },
                    protein: { digits: true },
                    pack: { digits: true },
                    size: { number: true },
                    calc_size: { digits: true },
                    mpc: { required: "#gtin:blank", maxlength: 250 },
                    gtin: { required: "#mpc:blank", maxlength: 250 },
                    net_weight: { number: true },
                    gross_weight: { number: true },
                    tare_weight: { number: true },
                    brand: { maxlength: 250 },
                    uom: { maxlength: 250 },
                    category1: { required: true },
                    category2: { required: true },
                    category3: { required: true }
                }
            });

            $("#hlDeleteProduct").on("click", function(e)
            {
                e.preventDefault();
                if(confirm("{{trans('messages.product_delete_confirm')}}"))
                {
                    theForm.validate().cancelSubmit = true;
                    $("#action").val("DELETE");
                    theForm.submit();
                }
            });

            $("#cbPublished").on("click", function(e)
            {
                console.log("here");
                (this.checked) ? $("#published").val("1") : $("#published").val("0");
            });

        });
    </script>

@endsection