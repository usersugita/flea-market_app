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
                    <img src="{{ asset('/storage/images/logo%20(1).svg') }}" alt="">
                </div>
                <div class="header-utilities__nav">
                    <div class="header-utilities__input">
                        <form action="" method="GET">
                            @csrf
                            <input type="text" name="query" placeholder="何をお探しですか？" value="">
                            <button type="submit">検索</button>
                        </form>
                        
                    </div>
                    <div class="header-utilities__mypage">
                        <a class="header-nav__mypage" href="/mypage">マイページ</a>
                    </div>
                    <div class="header-utilities__logout">
                        <form action="/logout" method="post">
                            @csrf
                            <button class="header-nav__button">ログアウト</button>

                        </form>
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