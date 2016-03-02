@extends('layouts.admin')

@section('title', 'Edit Category')


@section('content')

    <form id="form1" name="form1" method="post" action="{{url('/admin/category/add')}}">

        <div class="row">
            <input type="text" id="name" name="name" class="form-control" value=""/>
        </div>

        <div class="row">
            <select id="categories" name="categories">
                @foreach($categories as $c)
                    <option value="{{$c->level1}}-{{$c->level2}}">{{$c->hierarchy}}</option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <a href="{{url('admin/categories')}}" class="btn btn-default">Back</a>
            <input type="submit" name="save" class="btn btn-primary" value="Add"/>
        </div>

        {!! csrf_field() !!}
    </form>

@endsection


@section('scripts')

    <script type="text/javascript">

        $(document).ready(function()
        {
        });

    </script>

@endsection