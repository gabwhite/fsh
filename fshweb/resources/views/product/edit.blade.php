@extends('layouts.master')

@section('title', 'Page Title')

@section('css')

@endsection

@section('sectionheader')
<section class='clearfix container-wrap item-header'>
    <div class='container'>
        <div class="col-xs-12">
            <h1 class="item-title">{{$product->name}}</h1>
        </div>
        <div class="col-xs-12 reset-right">
            <div class="{{($product->published) ? 'bg-success' : 'bg-danger'}}">
                <input type="checkbox" id="published" name="published" {{($product->published) ? 'checked="checked"' : ''}}/> <label for="published">Published</label>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')

    <div class="container">
        
        <form id="form1" name="form1" method="post" action="{{url('product/edit')}}">

            <div class="col-xs-12 well">
                <h4>Product Title</h4>
                <input type="text" name="name" class="form-control input-lg" maxlength="500" placeholder="Enter Product Name" value="{{$product->name}}"/>

                <h4>Description</h4>
                <textarea title="description" name="description" class="form-control" cols="80" rows="3">{{$product->description}}</textarea>
            
            </div>

            <div class="row">

                <div class="col-xs-12 col-md-4">
                    <div class="nutrition-block col-xs-12 col-md-10">
                        
                        <h4>Nutrition Facts</h4>

                        <div class="nutrition-meta serving-size">
                            <span class="nutrition-value">Serving Size&nbsp;<input type="text" name="serving_size" class="form-control input-sm" maxlength="10" value="{{$product->serving_size}}"/></span>
                        </div>

                        <div class="nutrition-meta amount-per-serving">
                            
                            <label>Amount Per Serving</label>
                        
                        </div>

                        <div class="nutrition-meta calories">
                            
                            <div class="col-xs-6 calories-left">
                                <label>Calories&nbsp;</label><span class="nutrition-value"><input type="text" name="calories" class="form-control input-sm" maxlength="10" value="{{$product->calories}}"/></span>
                            </div>

                            <div class="col-xs-6 calories-right">
                                <label class="nutrition-value">Calories from Fat&nbsp;
                                </label>
                                <input type="text" name="calories_from_fat" class="form-control input-sm" maxlength="10" value="{{$product->calories_from_fat}}"/>
                            </div>
                            
                            <div class="clearfix"></div>

                        </div>
                                
                        <div class="nutrition-meta total-fat">  
                            <label>Total Fat&nbsp;</label><span class="nutrition-value"><input type="text" name="total_fat" class="form-control input-sm" maxlength="10" value="{{$product->total_fat}}"/></span>
                        </div>
                        
                        <div class="nutrition-meta">
                            <label class="nutrition-value">Saturated Fat&nbsp;</label><input type="text" name="saturated_fats" class="form-control input-sm" maxlength="10" value="{{$product->saturated_fats}}"/>
                        </div>
                                
                        <div class="nutrition-meta cholesteral">
                            <label>Cholesteral&nbsp;</label><input type="text" name="saturated_fats" class="form-control input-sm" maxlength="10" value="{{$product->cholesteral}}"/>
                        </div>
                                
                        <div class="nutrition-meta sodium">
                            <label>Sodium&nbsp;</label><span class="nutrition-value"><input type="text" name="sodium" class="form-control input-sm" maxlength="10" value="{{$product->sodium}}"/></span>
                        </div>

                        <div class="nutrition-meta carbohydrates">
                            <label>Total Carbohydrates&nbsp;</label><span class="nutrition-value"><input type="text" name="carbs" class="form-control input-sm" maxlength="10" value="{{$product->carbs}}"/></span>
                        </div>
                        
                        <div class="nutrition-meta">
                            <label class="nutrition-value">Dietary Fibre&nbsp;</label><input type="text" name="fibre" class="form-control input-sm" maxlength="10" value="{{$product->fibre}}"/>
                        </div>
                        
                        <div class="nutrition-meta">
                            <label class="nutrition-value">Sugars&nbsp;</label><input type="text" name="sugar" class="form-control input-sm" maxlength="10" value="{{$product->sugar}}"/>
                        </div>
                        
                        <div class="nutrition-meta protein">
                            <label>Protein&nbsp;</label><span class="nutrition-value"><input type="text" name="protein" class="form-control input-sm" maxlength="10" value="{{$product->protein}}"/></span>
                        </div>
                    
                    </div><!--  end of nutrition block -->
                               

                    <div class="row">
                        <div class="col-xs-12 col-md-10">
                            <h2 class="item-subhead">Dietary Information</h2>

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
                            
                    <div class="row">
                        <div class="col-xs-12 col-md-10">
                            <h2 class="item-subhead">Allergy Information</h2>
                            
                            <div class="well col-xs-12">
                                @foreach($allergens as $a)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="allergens[]" value="{{$a->id}}">{{$a->name}}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>   
                </div>

                <div class="col-xs-12 col-md-8">
                    <h2 class="item-subhead">Product Details</h2>

                    <div class="well col-xs-12">
                      <div class="detail-row">
                          <h4>Ingredients</h4>
                          <textarea title="ingredient_deck" name="ingredient_deck" class="form-control" cols="80" rows="3">{{$product->ingredient_deck}}</textarea>
                      </div>

                      <div class="detail-row">
                          <h4>Features, Advantages and Benefits</h4>
                          <textarea title="features_benefits" name="features_benefits" class="form-control" cols="80" rows="3">{{$product->features_benefits}}</textarea>
                      </div>

                      <div class="detail-row">
                          <h4>Allergen Disclaimer</h4>
                          <textarea title="allergen_disclaimer" name="allergen_disclaimer" class="form-control" cols="80" rows="3">{{$product->allergen_disclaimer}}</textarea>
                      </div>

                      <div class="detail-row">
                          <h4>Preparation &amp; Cooking Suggestions</h4>
                          <textarea title="preparation" name="preparation" class="form-control" cols="80" rows="3">{{$product->preparation}}</textarea><br/>
                      </div>
                    </div>

                    <div class="row">
                        
                      <div class="col-xs-12">
                          
                        <h2 class="item-subhead">Packaging &amp; Weights</h2>
                        
                        <div class="well col-xs-12">
                            <div class="col-xs-12 col-md-6">
                                
                                Pack:<input type="text" name="pack" title="pack" class="form-control" maxlength="10" value="{{$product->pack}}"/>

                                Size:<input type="text" name="size" title="size" class="form-control" maxlength="9" value="{{$product->size}}"/>

                                Calculation Size:<input type="text" name="calc_size" title="calc_size" class="form-control" maxlength="10" value="{{$product->calc_size}}"/>

                                Product Code:<input type="text" name="mpc" title="mpc" class="form-control" maxlength="250" value="{{$product->mpc}}"/>

                            </div>

                            <div class="col-xs-12 col-md-6">
                                
                                GTIN:<input type="text" name="gtin" title="gtin" class="form-control" maxlength="250" value="{{$product->gtin}}"/>

                                Net Weight:<input type="text" name="net_weight" title="net_weight" class="form-control" maxlength="9" value="{{$product->net_weight}}"/>

                                Gross Weight:<input type="text" name="gross_weight" title="gross_weight" class="form-control" maxlength="9" value="{{$product->gross_weight}}"/>

                                Tare Weight:<input type="text" name="tare_weight" title="tare_weight" class="form-control" maxlength="9" value="{{$product->tare_weight}}"/>
                            </div>

                            {{$product->brand}}<br/>
                            {{$product->calories}}<br/>
                            {{$product->uom}}<br/>


                        </div>  

                      </div>

                    </div>  
                   

                    <input type="submit" class="btn btn-primary btn-lg" value="Add / Update"/>
                    <a href="{{url('productdetail', $product->id)}}" class="btn btn-lg">Cancel</a>

                </div>
            </div> <!-- end of container -->
        </div><!-- End of main row -->
    <input type="hidden" name="id" value="{{$product->id}}"/>

    {!! csrf_field() !!}

    </form>

</div>

@endsection

@section('scripts')

    <script src="{{url('js/vendor/validation/jquery.validate.min.js')}}"></script>
    <script src="{{url('js/vendor/validation/additional-methods.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function()
        {
            $("#form1").validate({
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
                    mpc: { required: true },
                    gtin: { required: true },
                    net_weight: { number: true },
                    gross_weight: { number: true },
                    tare_weight: { number: true }
                }
            });

        });
    </script>

@endsection