<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Management</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">

                <div class="header-utilities__img">
                    <a href="/">
                        <img src="{{ asset('/storage/images/default/logo (2).svg') }}" alt=""></a>
                </div>
                <div class="header-utilities__nav">
                    <div class="header-utilities__input">
                        <form action="/search" method="get">
                            @csrf
                            <input type="text" name="keyword" placeholder="何をお探しですか？" value="{{ request('keyword') }}">

                        </form>

                    </div>
                    <div class="header-utilities__logout">
                        @if (Auth::check())
                        <form action="/logout" method="post">
                            @csrf
                            <button class="header-nav__button">ログアウト</button>

                        </form>
                        @else
                        <a class="header-nav__button" href="/login">ログイン</a>
                        @endif

                    </div>
                    <div class="header-utilities__mypage">
                        <a class="header-nav__mypage" href="/mypage">マイページ</a>
                    </div>
                    <div class="header-utilities__link">
                        <a class="header-nav__link" href="/sell">出品</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>