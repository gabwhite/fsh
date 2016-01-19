@extends('layouts.master')


@section('title', trans('ui.navigation_contactus'))

@section('css')

@endsection

@section('sectionheader')
<section class='clearfix container-wrap main-title contact-header'>
    <div class='container'>
        <h1 class="page-title">{{trans('ui.navigation_contactus')}}</h1>
    </div>
</section>

@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12 col-md-6 col-md-offset-3">
            <div class="row well">


                <h2 class="subhead">{{$successMessage or ''}}</h2>

                <div class="col-xs-12 col-md-8 col-md-offset-2">   
                    <form id="form1" name="contactus" method="post" action="{{url('contact')}}">

                        <div>
                            <label for="contact name">{{trans('ui.contact_label_name')}}</label>
                            <input type="text" name="contact_name" maxlength="100" value="{{ old('contact_name') }}" class="form-control">
                        </div>


                        <div>
                            <label for="contact email">
                            {{trans('ui.contact_label_email')}}</label>
                            <input type="email" name="contact_email" maxlength="100" value="{{ old('contact_email') }}" class="form-control">
                        </div>

                        <div>
                            <label for="message">{{trans('ui.contact_label_message')}}</label>
                            <textarea class="form-control" name="contact_message" rows="4"></textarea>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn-primary">{{trans('ui.button_submit')}}</button>
                        </div>


                        {!! csrf_field() !!}

                    </form>
                </div>    
            </div><!--  end row/well -->

        </div>

    </div>

@endsection

@section('scripts')

    <script src="{{url('js/vendor/validation/jquery.validate.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function()
        {
            $("#form1").validate({
                errorClass: "validationError",
                rules:
                {
                    contact_name: { required: true, maxlength: 100 },
                    contact_email: { required: true, email: true, maxlength: 100 },
                    contact_message: { required: true, maxlength: 500 }
                }
            });
        });
    </script>

@endsection