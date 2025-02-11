@extends('layouts.myapp')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')

<body>
    <div class="purchase">
        <div class="purchase__left">
            <div class="product-content">


                <div class="content-img">
                    <img src="{{ $product->image }}" alt="">
                </div>
                <div class="content-product">
                    <h2>{{ $product->name }}</h2>
                    <p> ￥{{ number_format($product->price) }}</p>
                </div>
            </div>
            <div class="purchase__left-content">
                <div class="payment-title">
                    <h4>支払方法</h4>
                </div>
                <div class="payment-inner">
                    <form action="" method="GET">
                        <select name="payment" id="payment_method" required onchange="this.form.submit()">
                            <option value="" selected hidden>支払い方法を選択</option>
                            <option class="select-option" value="コンビニ払い" {{ request('payment') === 'コンビニ払い' ? 'selected' : '' }}>コンビニ払い</option>
                            <option class="select-option" value="カード払い" {{ request('payment') === 'カード払い' ? 'selected' : '' }}>カード払い</option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="purchase__left-content">
                <div class="address">
                    <div class="address-title">
                        <h4>郵送先</h4>

                        <a href="/purchase/address/{{$id}}">変更する</a>
                    </div>
                    <div class="address-inner">
                       
                        <p>〒 {{ $profile->postcode }}</p>
                        <p> {{ $profile->address }}</p>
                        <p> {{ $profile->building }}</p>

                    </div>
                </div>
            </div>
        </div>
        <div class="purchase__right">
            <div class="right-content">
                <table border="1">
                    <tr>
                        <td>
                            <p>商品代金　　　　　　　￥{{ number_format($product->price) }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>支払方法　　　　@if (request('payment'))
                                {{ request('payment') }}
                                @else
                                コンビニ払い
                                @endif
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="right-btn">
                <form action="/mypage/order" method="post">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="profile_id" value="{{ $profile->id }}">
                    <button type="submit">購入する</button> 
                </form>
            </div>

        </div>
    </div>
</body>
@endsection