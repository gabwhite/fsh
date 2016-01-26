@extends('layouts.admin')

@section('title', 'Import User Products')

@section('sidebar')
    @parent

    <p>This is appended to the admin master sidebar.</p>
@endsection

@section('content')


    <form id="form1" name="form1" method="post" action="{{url('admin/import')}}" enctype="multipart/form-data">
        {!! csrf_field() !!}

        <input type="file" name="importfile"/>
        <br/>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="includesheaders" id="includesheaders" checked="checked"/>First row is header row
            </label>
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="addasactive" id="addasactive"/>Add new entries as active
            </label>
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="ignoreexisting" id="ignoreexisting"/>Ignore existing entries (updates will not execute)
            </label>
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="downloadimages" id="downloadimages"/>Download Images
            </label>
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="resizeimages" id="resizeimages"/>Resize Images
            </label>

            <input type="text" name="imagewidth" id="imagewidth" size="5" placeholder="Width"/>
            X
            <input type="text" name="imageheight" id="imageheight" size="5" placeholder="Height"/>
        </div>

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
            <option value="{{$v->id}}">{{$v->company_name}}</option>
        @endforeach
        </select>

        <br/>
        <hr/>

        <input type="submit" name="submit" value="Upload" class="btn btn-primary"/>

        <input type="submit" id="btnPreview" name="btnPreview" class="btn" value="Preview Rows"/>

        <input type="hidden" id="action" name="action" value="PROCESS"/>

    </form>


@endsection


@section('scripts')

    <script type="text/javascript" src="{{url('js/vendor/validation/jquery.validate.min.js')}}"></script>
    <script type="text/javascript">

        $(document).ready(function()
        {

            $("#btnPreview").on("click", function(e)
            {


                $("#action").val("PREVIEW");
                $("#form1").submit();

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