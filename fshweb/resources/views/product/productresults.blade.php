@foreach ($products as $p)
    <div class="col-xs-12 search-row">

        <div class="col-xs-3 col-md-2 drop-padding">

            <div class="item-thumb" style="background: url('{{url('img/no-photo-avail.svg')}}') no-repeat; background-size: cover; background-position: center center;">
            </div>

            <div class="star-rating">
                <img src="{{url('/img/icons/star.svg')}}">
            </div>

        </div>

        <div class="col-xs-9 col-md-10">
            <a href="{{url('product/detail', $p->id)}}">{{$p->name}}</a>
            <p class="brand">{{$p->brand}}</p>
        </div>
        
        <div class="col-xs-12 col-md-10 drop-padding">
            
            <p>{{$p->description}}</p>
            
            <div class="col-xs-12 search-details">
                <p>Pack: {{$p->pack}}</p>

                <p>Size: {{$p->calc_size}}</p>

                <p>Unit of Measure: {{$p->uom}}</p>

                <p>Product Code: {{$p->mpc}}</p>
            </div>

            <a class="goto-item" href="{{url('product/detail', $p->id)}}">View Product Details</a>
        </div>
    </div>
@endforeach

{!!$products->appends(['sort' => $sort, 'type' => $type, 'pageSize' => $pageSize])->render() !!}