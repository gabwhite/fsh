@extends('layouts.master')

@section('title', trans('ui.navigation_forgotpassword'))

@section('sectionheader')
<section class='clearfix container-wrap main-title register-header'>
    <div class='container'>
        <h1 class="page-title"> {{trans('ui.navigation_forgotpassword')}}</h1>
    </div>
</section>
   
@endsection

@section('content')

    <div class="row">

        <div class="col-xs-12 col-md-6 col-md-offset-3">
            <div class="col-xs-12 well">
                <div class="col-xs-12 col-md-10 col-md-offset-1">
                    <h2 class="subhead">Reset Your Password</h2>

                    <form id="form1" method="POST" action="{{url('/password/email')}}">

                        {!! csrf_field() !!}

                        @if (count($errors) > 0)
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <div>
                            <label for="Email">Email</label>
                            <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn-primary">
                                Send Password Reset Link
                            </button>
                        </div>
                    </form>
                </div>
            </div> <!-- end of well -->
        </div>
    </div> <!-- end of row -->

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
                    email: { required: true, email: true, maxlength: 100 }
                }
            });

        });
    </script>
@endsection