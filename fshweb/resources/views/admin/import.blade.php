@extends('layouts.admin')

@section('title', 'Import User Products')

@section('sidebar')
    @parent

    <p>This is appended to the admin master sidebar.</p>
@endsection

@section('content')
    <p>This is my admin body content.</p>

    <form id="form1" name="form1" method="post" action="{{url('admin/import')}}" enctype="multipart/form-data">
        {!! csrf_field() !!}

        <input type="file" name="importfile"/>
        <br/>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="includesheaders" id="includesheaders" checked="checked"/>First row is header row
            </label>
        </div>

        <br/>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="addasactive" id="addasactive"/>Add new entries as active
            </label>
        </div>

        <br/>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="ignoreexisting" id="ignoreexisting"/>Ignore existing entries
            </label>
        </div>

        <br/>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="simulate" id="simulate"/>Simulate import
            </label>
        </div>

        <br/>


        Associate products to
        <select name="vendor">
            <option value=""></option>
        @foreach($vendors as $v)
            <option value="{{$v->id}}">{{$v->name}}</option>
        @endforeach
        </select>

        <br/>
        <hr/>

        <input type="submit" name="submit" value="Upload" class="btn btn-primary"/>

        <input type="button" name="btnPreview" value="Preview Rows" class="btn"/>

    </form>


@endsection


@section('scripts')

    <script type="text/javascript" src="{{url('js/vendor/validation/jquery.validate.min.js')}}"></script>
    <script type="text/javascript">

        $(document).ready(function()
        {

            $("#btnPreview").on("click", function(e)
            {
                e.preventDefault();
            });

            $("#form1").validate({
                errorClass: "validationError",
                rules:
                {
                    vendor: { required: true }
                }
            });

        });



    </script>

@endsection