@extends('layouts.myapp')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')

<body>
    <div class="item">
        <div class="item__image">
            <img src="{{($products->image)}}" alt="">
        </div>
        <div class="item__content">
            <div class="item__content-name">
                <h1>{{($products->name)}}</h1>
                ￥<span>{{($products->price)}}</span>(税込み)
            </div>
            <div class="item__content-like">
                <div class="like-item">
                    <div class="like">
                        <form method="POST" action="/item/{id}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $products->id }}">
                            <button type="submit" class="like-button {{ $isLiked ? 'liked' : '' }}">
                                {{ $isLiked ? '☆' : '☆' }}
                            </button>

                        </form>
                    </div>
                    <div class="like-count">
                        {{$products->likes->count() }}
                    </div>
                </div>
                <div class="like-item">
                    <div class="like">
                        💬
                    </div>
                    <div class="like-count">
                        {{$products->comments->count() }}
                    </div>
                </div>
            </div>
            <div class="item__content-buy">
                <a href="http://">購入手続きへ</a>
            </div>
            <div class="item__content-description">
                <h2>商品説明</h2>
                <p>{{($products->description)}}</p>
            </div>
            <div class="item__content-condition">
                <h2>商品の情報</h2>
                <div class="condition-category">
                    <strong>カテゴリー</strong>
                    <div class="condition-item">
                        @foreach ($products->categories as $category)
                        <div class="condition-item_category">
                            {{ $category->name }}
                        </div>
                        @endforeach
                    </div>

                </div>
                <div class="condition-inner">
                    <strong>商品の状態</strong>
                    <div class="condition-item">
                        <div class="condition-item_information">
                            {{($products->condition)}}
                        </div>

                    </div>

                </div>

            </div>
            <div class="item__content-comment">
                <div class="comment-log">

                    <h3 class="comment-log_title">コメント（ {{$products->comments->count() }}）</h3>
                </div>

                @foreach ($products->comments as $comment)
                <div>
                    <strong>{{ $comment->user->name }}</strong>:
                    <p>{{ $comment->comment }}</p>
                </div>
                @endforeach
                <form action="{{ route('item.comment', ['id' => $products->id]) }}" method="post">
                    @csrf

                    <p>商品へのコメント</p>
                    <input type="hidden" name="product_id" value="{{ $products->id }}">
                    <textarea rows="6" name="comment" id=""></textarea>


                    @if (Auth::check())
                    <button type="submit">コメントを送信する</button>
                    @else
                    <p>ログインしていません。コメント機能を利用するにはログインしてください。</p>
                    @endif
                </form>


            </div>
        </div>
    </div>
</body>
@endsection