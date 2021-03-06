@extends('layouts.master')


@section('title', (isset($profile) ? $profile->company_name : ''))

@section('css')

@endsection


@section('sectionheader')
<section class='clearfix container-wrap main-title'>
    <div class="container">
        <div class="col-xs-12 vendor-profile" style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('{{ ($profile->background_image_path) ? url(config('app.vendor_storage') . '/' . $profile->background_image_path) : '' }}') no-repeat; background-size: cover; background-position: center center;">
            @if($profile->logo_image_path)
                <div class="vendor-profile-img" id="imgCurrentAvatar" style="background: url({{url(config('app.vendor_storage') . '/' . $profile->logo_image_path)}}) #fff no-repeat; background-size: 80%; background-position: center center;">
                    
                </div>
                
            @else
                <div class="vendor-profile-img"id="imgCurrentAvatar" style="background: url({{url(config('app.avatar_none'))}}) #fff no-repeat; background-size: cover; background-position: center center;" ></div>
                
            @endif
            <h1 class="page-title">{{isset($profile) ? $profile->company_name : ''}}</h1>
        </div>
    </div>
</section>
@endsection


@section('content')

    <div class="row">

        <div class="col-xs-12 col-md-4 drop-padding">

            <div class="col-xs-12 col-md-11">
                <h2 class="item-subhead">Contact</h2>

                <div class="col-xs-12 well">
                    
                    <label for="company name">{{isset($profile) ? $profile->company_name : ''}}</label>

                    @if($profile->address1)
                    <p>{{$profile->address1}}</p>
                    @endif

                    @if($profile->address2)
                    <p>{{$profile->address2}}</p>
                    @endif

                    @if($profile->city)
                    <p>{{$profile->city}}</p>
                    @endif

                    @if($profile->state_province_id)
                    <p>{{$profile->stateProvince->name}}</p>
                    @endif

                    @if($profile->country_id)
                    <p>{{$profile->country->name}}</p>
                    @endif

                    @if($profile->zip_postal)
                    <p>{{$profile->zip_postal}}</p>
                    @endif

                    @if($profile->contact_name)
                    <label for="contact">{{trans('ui.vendor_label_contact_header')}}</label>
                    <p>{{$profile->contact_name}}</p>
                    @endif

                    @if($profile->contact_title)
                    <p>{{$profile->contact_title}}</p>
                    @endif

                    @if($profile->contact_phone)
                        <p> {{$profile->contact_phone}}</p>
                    @endif

                    @if($profile->contact_email)
                        <p><a href="mailto:{{$profile->contact_email}}">{{$profile->contact_email}}</a></p>
                    @endif

                    @if($profile->contact_url)
                    <p><a href="{{$profile->contact_url}}" target="_blank">{{isset($profile) ? $profile->contact_url : ''}}</a></p>
                    @endif
                </div>
                
            </div>

        </div> <!-- end of sidebar -->

        <div class="col-xs-12 col-md-8 drop-padding">
            <div class="col-xs-12">
                <h2 class="item-subhead">{{trans('ui.vendor_label_about_text')}}</h2>
                @if($canEdit)
                    <a href="{{url('vendor/edit')}}" class="edit"><button class="btn-primary ">{{trans('ui.button_edit')}}</button></a>
                @endif
                <div class="col-xs-12 well">
                    <h3>{{isset($profile) ? $profile->intro_text : ''}}</h3>

                    <p>{!! isset($profile) ? nl2br(e($profile->about_text)) : '' !!}</p>

                    @if(!$profile->about_text && !$profile->intro_text)
                        <p>{{trans('messages.vendor_no_about_text')}}</p>
                    @endif

                </div>

                @if($profile->brands && count($profile->brands) > 0)
                <div class="row">
                    <div class="col-xs-12 drop-padding">
                        
                        <h2 class="item-subhead">Our Brands</h2>

                        <div class="col-xs-12 well">
                            <div class="flexslider">
                              <ul class="slides">
                              @foreach($profile->brands as $b)
                                  <li style="background: url('{{url(config('app.vendor_storage'))}}/{{$b->logo_image_path}}'); background-repeat: no-repeat; background-position: center center; background-size: 70%;">
                                  </li>
                              @endforeach
                                <!-- items mirrored twice, total of 12 -->
                              </ul>
                            </div>

                            <div class="custom-navigation">
                              <a href="#" class="flex-prev"></a>
                              <div class="custom-controls-container"></div>
                              <a href="#" class="flex-next"></a>
                            </div>
                               
                        </div>
                    </div>
                </div>
                @endif
            </div>

            
        </div>

    </div>


@endsection


@section('scripts')

<script>
    $(document).ready(function(){
        $('.flexslider').flexslider({
            animation: "slide",
            animationLoop: false,
            controlNav: false,
            itemWidth: 222,
            itemMargin: 10,
            customDirectionNav: $(".custom-navigation a")
        });
    });
</script>

@endsection