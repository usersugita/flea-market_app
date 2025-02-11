@extends('layouts.myapp')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')

<body>
    <div class="sell">
        <h1 class="sell_image-title">商品の出品</h1>

        <h3>商品画像</h3>

        @if(session('imagePath'))
        <div class="sell_image-session">
            <form action="/sell" method="POST" enctype="multipart/form-data">
                @csrf
                <label class="image-label_session" for="profileImageInput">画像を選択する</label>
                <input class="image-input" type="file" id="profileImageInput" name="image" accept=".jpg,.jpeg,.png" onchange="this.form.submit()">

            </form>
            <img class="img-container" id="profileImagePreview"
                src="{{ session('imagePath') ? asset('storage/' . session('imagePath')) : '' }}"
                alt="">
        </div>
        @else
        <div class="sell_content-image">
            <form action="/sell" method="POST" enctype="multipart/form-data">
                @csrf
                <label class="image-label" for="profileImageInput2">画像を選択する</label>
                <input class="image-input" type="file" id="profileImageInput2" name="image" accept=".jpg,.jpeg,.png" onchange="this.form.submit()">

            </form>
        </div>
        @endif

        <form action="/listing" method="POST">
            @csrf
            <input type="hidden" name="image"
                value="{{ session('imagePath') ? session('imagePath') : 'images/default/154620.png' }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
            <h2 class="sell_category-title">商品の詳細</h2>
            <div class="sell_content">
                <h3>カテゴリ</h3>
                <!-- @foreach ($categories as $category) 
                <label>
                    <input type="checkbox" name="categories" value="{{ $category->id }}">
                    {{ $category->name }}
                </label><br>
                @endforeach-->
                @foreach ($categories as $category)
                <input type="checkbox" name="categories[]" id="check{{ $loop->index }}" value="{{ $category->id }}">
                <label for="check{{ $loop->index }}" class="custom-checkbox"> {{ $category->name }}</label>
                @endforeach
            </div>
            <div class="sell_content">
                <h3>商品の状態</h3>
                <select name="condition" required>
                    <option class="select-title" value="" selected hidden>選択してください</option>
                    <option class="select-option" value="良好">良好</option>
                    <option class="select-option" value="目立った傷や汚れなし">目立った傷や汚れなし</option>
                    <option class="select-option" value="やや傷や汚れあり">やや傷や汚れあり</option>
                    <option class="select-option" value="状態が悪い">状態が悪い</option>

                </select>

            </div>
            <h2 class="sell_category-title">商品名の詳細</h2>
            <div class="sell_content">
                <h3>商品名</h3>
                <input class="sell_name" type="text" name="name">
            </div>
            <div class="sell_content">
                <h3>商品の説明</h3>
                <textarea class="sell_description" name="description"></textarea>
            </div>
            <div class="sell_content">
                <h3>販売価格</h3>
                <div class="yen-wrapper">
                    <input type="text" class="yen-input" name="price">
                </div>
            </div>
            <button type="submit">出品する</button>
    </div>

    </form>
</body>
@endsection