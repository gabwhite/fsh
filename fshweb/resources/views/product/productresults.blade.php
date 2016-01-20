@foreach ($products as $p)

    <div class="col-xs-12 search-row">

        <div class="col-xs-3 col-lg-2">

            <div class="item-thumb">
            </div>

            <div class="star-rating">
                <img src="{{url('/img/icons/star.svg')}}">
            </div>

        </div>

        <div class="col-xs-9 col-lg-10">
            <a href="{{url('product/detail', $p->id)}}">{{$p->name}}</a>
            <span class="brand">{{$p->brand}}</span>

            <p>{{$p->description}}</p>
            
            <div class="col-xs-12 search-details">
                <p>Pack:</p>

                <p>Size:</p>

                <p>Unit of Measure:</p>

                <p>Product Code:</p>
            </div>

            <a class="goto-item" href="{{url('product/detail', $p->id)}}">View Product Details</a>
        </div>
    </div>

@endforeach

{!!$products->appends(['sort' => $sort])->render() !!}

