@extends('layouts.myapp')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="profile__content">
    <div class="profile-form__heading">
        <h2>プロフィール設定</h2>
    </div>
    <div class="profile-container">
        <div class="file-input-container">
            <form action="/profile" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="profileImageInput">画像を選択する</label>
                <input type="file" id="profileImageInput" name="image" accept=".jpg,.jpeg,.png" onchange="this.form.submit()">
                <!-- <button type="submit">アップロード</button> -->
            </form>
        </div>
        <img class="img-container" id="profileImagePreview"
            src="{{ session('imagePath') ? asset('storage/' . session('imagePath')) : asset('storage/images/default/154620.png') }}"
            alt="プロフィール画像">
        <!-- 画像選択 <div class="file-input-container">

                            <label for="profileImageInput">画像を選択</label>
                            <input type="file" id="profileImageInput" name="image" accept="images/*,.jpg, .jpeg, .png">

                        </div>-->
    </div>
    <form class="form" action="/" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="image"
            value="{{ session('imagePath') ? session('imagePath') : 'images/default/154620.png' }}">


        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">ユーザー名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="name" value="{{ Auth::user()->name }}" />
                </div>
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">郵便番号</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="postcode" value="{{ old('postcode') }}" />
                </div>
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="address" value="{{ old('address') }}" />
                </div>
                <div class="form__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="building" value="{{ old('building') }}" />
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">更新する</button>
        </div>
    </form>

</div>
@endsection