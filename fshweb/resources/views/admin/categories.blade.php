@extends('layouts.admin')

@section('title', 'Categories')


@section('content')

        <ul>
        @foreach($categories as $c)

            <li><a href="{{url('/admin/category/edit', $c->id)}}">{{$c->name}}</a></li>

            <ul>
            @foreach($c->children as $c2)

                <li><a href="{{url('/admin/category/edit', $c2->id)}}">{{$c2->name}}</a></li>
                <ul>
                @foreach($c2->children as $c3)

                    <li><a href="{{url('/admin/category/edit', $c3->id)}}">{{$c3->name}}</a></li>

                @endforeach
                </ul>
            @endforeach
            </ul>

        @endforeach
        </ul>

@endsection


@section('scripts')

    <script type="text/javascript">

        $(document).ready(function()
        {
        });

    </script>

@endsection