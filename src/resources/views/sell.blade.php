@extends('layouts.myapp')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')

<body>
    <div class="sell">
        <h2>商品の出品</h2>
        <form action="" method="POST">
            @csrf
            <div class="sell_content">
                <label for="image">商品画像</label>
                <input type="text" id="image" name="image" required>
            </div>
            <h3>商品の詳細</h3>
            <div class="sell_content">
                <label>カテゴリ</label>
                @foreach ($categories as $category)
                <label>
                    <input type="checkbox" name="categories[]" value="{{ $category->id }}">
                    {{ $category->name }}
                </label><br>
                @endforeach
            </div>
            <div class="sell_content">
                <label for="condition">商品の状態</label>
                <input type="text" id="condition" name="condition" required>

            </div>
            <div class="sell_content">
                <label for="name">商品名</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="sell_content">
                <label for="description">商品の説明</label>
                <input type="text" id="description" name="description" required>
            </div>
            <div class="sell_content">
                <label for="price">販売価格</label>
                <input type="text" id="price" name="price" required>
            </div>
    </div>
    <button type="submit">出品する</button>
    </form>
</body>
@endsection