@extends('layouts.master')

@section('title', 'Page Title')

@section('css')

@endsection

@section('sectionheader')
    MY PRODUCTS
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">

            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($products as $p)
                    <tr>
                        <td>
                            <a href="{{url('/product/detail', $p->id)}}">{{$p->name}}</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td>
                            {!! $products->render() !!}
                        </td>
                    </tr>
                </tfoot>
            </table>

        </div>

    </div>

@endsection

