@extends('layouts.master')


@section('title', 'Contact Us')

@section('css')

@endsection

@section('sidebar')
    @parent

@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">

            <p>
                {{$successMessage or ''}}
            </p>

            <form id="form1" name="contactus" method="post" action="{{url('contact')}}">

                <div>
                    Name
                    <input type="text" name="contact_name" maxlength="100" value="{{ old('contact_name') }}" class="form-control">
                </div>


                <div>
                    Email
                    <input type="email" name="contact_email" maxlength="100" value="{{ old('contact_email') }}" class="form-control">
                </div>

                <div>
                    Message
                    <textarea name="contact_message"></textarea>
                </div>


                <div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>


                {!! csrf_field() !!}

            </form>

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