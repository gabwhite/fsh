@extends('layouts.admin')

@section('title', 'Edit Category')


@section('content')

    <form id="form1" name="form1" method="post" action="{{url('/admin/category/edit', $category->id)}}">

        <div class="row">
            <input type="text" id="name" name="name" class="form-control" value="{{$category->name}}"/>
        </div>

        <!--
        <div class="row">
            <select id="parent_id" name="parent_id">
                @foreach($categories as $c)
                    @if($c->id == $category->parent_id)
                        <option value="{{$c->id}}" selected="selected">{{$c->name}}</option>
                    @else
                        <option value="{{$c->id}}">{{$c->name}}</option>
                    @endif

                @endforeach
            </select>
        </div>
        -->

        <div class="row">
            <a href="{{url('admin/categories')}}" class="btn btn-default">Back</a>
            <input type="submit" name="save" class="btn btn-primary" value="Update"/>
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