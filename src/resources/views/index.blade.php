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
                        <img src="{{($product->image)}}" alt="logo">
                    </div>
                    <div class="product__card-item">
                        <p> {{$product->name}}</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>

    <input type="radio" name="tab_name" id="tab2">
    <label class="tab_class" for="tab2">マイリスト</label>
    <div class="content_class">
        <div class="content_class__cards">
            @foreach ($products as $product)
            <a class="product__cards-link" href="item/{{$product->id}}">
                <div class="product__card">
                    <div class="product__card-img">
                        <img src="{{($product->image)}}" alt="logo">
                    </div>
                    <div class="product__card-item">
                        <p> {{$product->name}}</p>

                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>

</div>
@endsection