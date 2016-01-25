@extends('layouts.master')

@section('title', 'Page Title')

@section('css')

@endsection

@section('sectionheader')
    <section class='clearfix container-wrap profile-head'>
        <div class="container">
            <h1 class="item-title">{{trans('ui.vendor_label_my_products')}}</h1>
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
                            <th>{{trans('ui.vendor_label_name')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($products as $p)
                        <tr>
                            <td>
                                <a href="{{url('/product/detail', $p->id)}}">{{$p->name}}</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>
                                {{trans('ui.vendor_label_no_products')}}. <a href="{{url('product/edit')}}">{{trans('ui.button_add')}}</a>
                            </td>
                        </tr>
                    @endforelse
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

