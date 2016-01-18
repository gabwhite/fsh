@extends('layouts.master')

@section('title', 'Page Title')

@section('css')

@endsection

@section('sectionheader')
    <section class='clearfix container-wrap profile-head'>
        <div class="container">
            <h1 class="item-title">My Products</h1>
                
        </div>
    </section>
@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="col-xs-12 well">

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
    </div>

@endsection

