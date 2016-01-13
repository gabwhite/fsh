@extends('layouts.master')


@section('title', (isset($profile) ? $profile->company_name : ''))

@section('css')

@endsection


@section('sectionheader')
<section class='clearfix container-wrap main-title'>
    <div class="container ">
        <div class="col-xs-12 vendor-profile">
            @if(isset($avatarFilename))
                <img id="imgCurrentAvatar" src="{{url(config('app.avatar_storage') . '/' . $avatarFilename)}}" title="{{trans('ui.user_label_currentavatar')}}" width="200" height="200"/>
            @else
                <img id="imgCurrentAvatar" src="{{url(config('app.avatar_none'))}}" title="{{trans('ui.user_label_noavatar')}}" width="200" height="200"/>
            @endif
            <h1 class="page-title">{{isset($profile) ? $profile->company_name : ''}}</h1>
        </div>
    </div>
</section>
@endsection


@section('content')

    <div class="row">

        <div class="col-xs-12 col-md-4">

            <div class="col-xs-12 col-md-11">
                <h2 class="item-subhead">Contact</h2>

                <div class="col-xs-12 well">
                    
                    <label for="company name">{{trans('ui.vendor_label_company')}}</label>

                    <p>{{isset($profile) ? $profile->company_name : ''}}</p>
                    
                    <label for="vendor address">{{trans('ui.vendor_label_address1')}}</label>
                    
                    <p>{{isset($profile) ? $profile->address1 : ''}}</p>
                    
                    
                    <label for="state/province">{{trans('ui.vendor_label_state_province')}}</label>
                    
                    <p>{{trans('ui.vendor_label_country')}}</p>
        
                    <label for="address two">{{trans('ui.vendor_label_address2')}}</label>
                    
                    <p>{{isset($profile) ? $profile->address2 : ''}}</p>


                    <label for="city">
                        {{trans('ui.vendor_label_city')}}
                    </label>
                    <p>{{isset($profile) ? $profile->city : ''}}</p>

                    <label for="postal-code">{{trans('ui.vendor_label_zip_postal')}}</label>
                    <p>{{isset($profile) ? $profile->zip_postal : ''}}</p>


                    <label for="contact">{{trans('ui.vendor_label_contact_name')}}</label>
                    <p>{{isset($profile) ? $profile->contact_name : ''}}</p>
                    
                    <label for="contact-title">{{trans('ui.vendor_label_contact_title')}}</label>

                    <p>{{isset($profile) ? $profile->contact_title : ''}}</p>
                    
                    <label for="Phone">{{trans('ui.vendor_label_contact_phone')}}</label>
                    <p> {{isset($profile) ? $profile->contact_phone : ''}}</p>

                    <label for="website">{{trans('ui.vendor_label_contact_url')}}</label>

                    <p><a href="{{isset($profile) ? $profile->contact_url : ''}}" target="_blank">{{isset($profile) ? $profile->contact_url : ''}}</a></p>
                </div>
                
            </div>




        </div> <!-- end of sidebar -->

        <div class="col-xs-12 col-md-8">
            <h2 class="item-subhead">{{trans('ui.vendor_label_about_text')}}</h2>

            <div class="col-xs-12 well">
                <h3>{{isset($profile) ? $profile->intro_text : ''}}</h3>

                <p>{{isset($profile) ? $profile->about_text : ''}}</p>
                
            </div>
            
        </div>

    </div>


@endsection


@section('scripts')



@endsection