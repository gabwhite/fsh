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
    <form id="form1" name="form1" method="post" action="{{url('/product/vendor')}}">
    <div class="row">
        <div class="col-xs-12">
            <div class="col-xs-12 well">

                <table class="table" id="tblProducts">
                    @if(isset($products) && count($products) > 0)
                    <thead>
                        <tr>
                            <th width="5%"><input id="cbToggleAll" type="checkbox"/></th>
                            <th>{{trans('ui.vendor_label_name')}}</th>
                        </tr>
                    </thead>
                    @endif
                    <tbody>
                    @forelse($products as $p)
                        <tr>
                            <td width="5%">
                                <input type="checkbox" name="products[]" value="{{$p->id}}"/>
                            </td>
                            <td>
                                <a href="{{url('/product/detail', $p->id)}}">{{$p->name}}</a>
                                @if($p->published)
                                    <span class="badge">Published</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">
                                {{trans('ui.vendor_label_no_products')}}. <a href="{{url('product/edit')}}">{{trans('ui.button_add')}}</a>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">
                                {!! $products->render() !!}
                            </td>
                        </tr>
                    </tfoot>
                </table>

                @if(isset($products) && count($products) > 0)
                    With selected:
                    <a href="#" id="btnDelete" class="">{{trans('ui.button_delete')}}</a>
                    |
                    <a href="#" id="btnPublish" class="">{{trans('ui.product_label_publish')}}</a>
                    |
                    <a href="#" id="btnUnpublish" class="">{{trans('ui.product_label_unpublish')}}</a>
                @endif
            </div>
        </div>
    </div>
    <input type="hidden" id="action" name="action" value=""/>
    {!! csrf_field() !!}
    </form>
@endsection

@section('scripts')

    <script type="text/javascript">

        $(document).ready(function()
        {
            var tbl = $("#tblProducts");

            $("#cbToggleAll").on("click", function(e)
            {
                if($(this).is(":checked"))
                {
                    tbl.find("tbody tr td input:checkbox").prop("checked", true);
                }
                else
                {
                    tbl.find("tbody tr td input:checkbox").prop("checked", false);
                }
            });

            $("#btnDelete,#btnPublish,#btnUnpublish").on("click", function(e)
            {
                e.preventDefault();

                var msg = "", action = "";
                switch(e.target.id)
                {
                    case "btnDelete":
                        msg = "{{trans('messages.product_delete_multiple_confirm')}}}";
                        action = "DELETE";
                        break;

                    case "btnPublish":
                        msg = "{{trans('messages.product_publish_multiple_confirm')}}}";
                        action = "PUBLISH";
                        break;

                    case "btnUnpublish":
                        msg = "{{trans('messages.product_unpublish_multiple_confirm')}}}";
                        action = "UNPUBLISH";
                        break;
                }

                if(confirm(msg))
                {
                    $("#action").val(action);
                    $("#form1").submit();
                }
            });
        });

    </script>

@endsection
