@extends('layouts.myapp')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="area">
    <input type="radio" name="tab_name" id="tab1" checked>
    <label class="tab_class" for="tab1">おすすめ</label>
    <div class="content_class">
        <div class="content_class__cards">
            @foreach ($products as $product)
            <a class="product__cards-link" href="item/{{$product->id}}">
                <div class="product__card">
                    <div class="product__card-img">
                        <img src="{{ filter_var($product->image, FILTER_VALIDATE_URL) ? $product->image : asset('storage/' . $product->image) }}" alt="logo">


                    </div>
                    <div class="product__card-item">
                        <div class="product__card-name">
                            {{$product->name}}
                        </div>
                        @if ($orders->contains('product_id', $product->id))
                        <div class="product__card-order">
                            sold
                        </div>
                        @endif
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>

    <input type="radio" name="tab_name" id="tab2">
    <label class="tab_class" for="tab2">マイリスト</label>
    <div class="content_class">
        @if ($likes->isEmpty())
        <p>マイリストがありません</p>
        @else
        <div class="content_class__cards">
            @foreach ($likes as $like)
            <a class="product__cards-link" href="item/{{$like->product->id}}">
                <div class="product__card">
                    <div class="product__card-img">
                        <img src="{{ $like->product->image }}" alt="logo">
                    </div>
                    <div class="product__card-item">
                        <div class="product__card-name">
                            <p> {{$like->product->name}}</p>
                        </div>
                        @if ($orders->contains('product_id', $like->product->id))
                        <div class="product__card-order">
                            <p><strong>sold</strong></p>
                        </div>
                        @endif
                    </div>
                </div>
            </a>
            @endforeach

        </div>
        @endif
    </div>

</div>
@endsection