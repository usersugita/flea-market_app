@extends('layouts.myapp')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="mypage">
    <div class="mypage_header">
        <div class="header__profile">
            <div class="header__profile-img">
                <img src="{{ asset('storage/' . $profile->image) }}" alt="プロフィール画像" style="max-width: 150px;">
            </div>
            <div class="header__profile-name">
                <h1>{{ $profile->user->name }}</h1>
            </div>
        </div>
        <div class="header-link">
            <a href="mypage/profile">プロフィールを編集</a>
        </div>
    </div>
    <div class="area">
        <input type="radio" name="tab_name" id="tab1" checked>
        <label class="tab_class" for="tab1">出品した商品</label>
        <div class="content_class">
            <div class="content_class__cards">
                @foreach ($products as $product)
                @if (Auth::id() == $product->user_id)
                <a class="product__cards-link" href="item/{{$product->id}}">
                    <div class="product__card">
                        <div class="product__card-img">
                            <img src="{{ filter_var($product->image, FILTER_VALIDATE_URL) ? $product->image : asset('storage/' . $product->image) }}" alt="logo">
                        </div>
                        <div class="product__card-item">
                            <p> {{$product->name}}</p>
                        </div>
                    </div>
                </a>
                @endif
                @endforeach
            </div>
        </div>

        <input type="radio" name="tab_name" id="tab2">
        <label class="tab_class" for="tab2">購入した商品</label>
        <div class="content_class">
            @if ($orders->isEmpty())
            <p>購入履歴がありません。</p>
            @else
            <div class="content_class__cards">
                @foreach ($orders as $order)
                <a class="product__cards-link" href="item/{{$order->product->id}}">
                    <div class="product__card">
                        <div class="product__card-img">
                            <img src="{{ $order->product->image }}" alt="logo">
                        </div>
                        <div class="product__card-item">
                            <p> {{ $order->product->name }}</p>

                        </div>
                    </div>
                </a>
                @endforeach

            </div>
            @endif
        </div>

    </div>
</div>

@endsection