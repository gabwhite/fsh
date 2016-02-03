@extends('layouts.master')

@section('title', trans('ui.user_label_product_favs'))

@section('css')

@endsection

@section('sectionheader')
    <section class='clearfix container-wrap profile-head'>
        <div class="container">
            <h1 class="item-title">{{trans('ui.user_label_product_favs')}}</h1>
        </div>
    </section>
@endsection

@section('content')
    <form id="form1" name="form1" method="post" action="{{url('/profile/favorites')}}">
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
                                    <p style="font-size: smaller;">
                                        {{($p->pack) ? 'Pack: ' . $p->pack : ''}};
                                        {{($p->size) ? 'Size: ' . $p->size : ''}};
                                        {{($p->gtin) ? 'GTIN: ' . $p->gtin : ''}};
                                        {{($p->mpc) ? 'MPC: ' . $p->mpc : ''}}
                                    </p>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">
                                    {{trans('ui.user_label_no_product_favs')}}
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2">

                            </td>
                        </tr>
                        </tfoot>
                    </table>

                    @if(isset($products) && count($products) > 0)
                        {{trans('ui.general_label_with_selected')}}
                        <a href="#" id="btnDelete" class="">{{trans('ui.button_delete')}}</a>
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

            $("#btnDelete").on("click", function(e)
            {
                e.preventDefault();

                var msg = "{{trans('messages.profile_product_favs_delete_multiple_confirm')}}";
                if(confirm(msg))
                {
                    $("#form1").submit();
                }
            });
        });

    </script>

@endsection
