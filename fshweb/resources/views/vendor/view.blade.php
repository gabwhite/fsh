@extends('layouts.master')


@section('title', (isset($profile) ? $profile->company_name : ''))

@section('css')

@endsection


@section('sectionheader')
    {{isset($profile) ? $profile->company_name : ''}}
@endsection


@section('content')

    <div class="row">

        <div class="col-md-12">

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.vendor_label_company')}}
                </div>
                <div class="col-md-9">
                    {{isset($profile) ? $profile->company_name : ''}}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.vendor_label_country')}}
                </div>
                <div class="col-md-9">
                *TODO*
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.vendor_label_state_province')}}
                </div>
                <div class="col-md-9">
                    *TODO*
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.vendor_label_address1')}}
                </div>
                <div class="col-md-9">
                    {{isset($profile) ? $profile->address1 : ''}}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.vendor_label_address2')}}
                </div>
                <div class="col-md-9">
                    {{isset($profile) ? $profile->address2 : ''}}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.vendor_label_city')}}
                </div>
                <div class="col-md-9">
                    {{isset($profile) ? $profile->city : ''}}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.vendor_label_zip_postal')}}
                </div>
                <div class="col-md-9">
                    {{isset($profile) ? $profile->zip_postal : ''}}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.vendor_label_contact_name')}}
                </div>
                <div class="col-md-9">
                    {{isset($profile) ? $profile->contact_name : ''}}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.vendor_label_contact_title')}}
                </div>
                <div class="col-md-9">
                    {{isset($profile) ? $profile->contact_title : ''}}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.vendor_label_contact_phone')}}
                </div>
                <div class="col-md-9">
                    {{isset($profile) ? $profile->contact_phone : ''}}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.vendor_label_contact_url')}}
                </div>
                <div class="col-md-9">
                    <a href="{{isset($profile) ? $profile->contact_url : ''}}" target="_blank">{{isset($profile) ? $profile->contact_url : ''}}</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.vendor_label_intro_text')}}
                </div>
                <div class="col-md-9">
                    {{isset($profile) ? $profile->intro_text : ''}}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{trans('ui.vendor_label_about_text')}}
                </div>
                <div class="col-md-9">
                    {{isset($profile) ? $profile->about_text : ''}}
                </div>
            </div>


        </div>


    </div>


@endsection


@section('scripts')



@endsection