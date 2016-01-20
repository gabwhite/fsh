@foreach ($products as $p)

    <div class="col-xs-12 search-row">

        <div class="col-xs-3">

            <div class="item-thumb">
            </div>

            <div class="star-rating">
                <img src="{{url('/img/icons/star.svg')}}">
            </div>

        </div>

        <div class="col-xs-9">
            <a href="{{url('product/detail', $p->id)}}">{{$p->name}}</a>
            <span class="brand">{{$p->brand}}</span>
        </div>
    </div>

@endforeach

{!!$products->appends(['sort' => $sort])->render() !!}
