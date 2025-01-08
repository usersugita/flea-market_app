@extends('layouts.myapp')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="mypage">
    <div class="mypage_header">
        <h1>{{ $profile->user->name }}</h1>
        <img src="{{ asset('storage/' . $profile->image) }}" alt="プロフィール画像" style="max-width: 150px;">
    </div>
    <div class="area">
        <input type="radio" name="tab_name" id="tab1" checked>
        <label class="tab_class" for="tab1">出品した商品</label>
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
        <label class="tab_class" for="tab2">購入した商品</label>
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
</div>

@endsection