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
            <form
                action="/mypage/profile"
                method="POST"
                enctype="multipart/form-data">
                @csrf
                <label for="profileImageInput">画像を選択する</label>
                <input type="file" id="profileImageInput" name="image" accept=".jpg,.jpeg,.png" onchange="this.form.submit()">
                <!-- <button type="submit">アップロード</button> -->
            </form>
        </div>
        <img class="img-container" src="{{ asset('storage/' . (session('imagePath') ?? $profile->image)) }}" alt="">
        <!-- <img class="img-container" id="profileImagePreview" 
            src="{{ isset($profile->image) && $profile->image ? asset('storage/' . $profile->image) : asset('storage/images/default/154620.png') }}"
            alt="プロフィール画像">-->
        <!-- <img class="img-container" id="profileImagePreview" 
            src="{{ session('imagePath') ? asset('storage/' . session('imagePath')) : asset('storage/images/default/154620.png') }}"
            alt="プロフィール画像">-->

        <div class="form__error">
            @error('image')
            {{ $message }}
            @enderror
        </div>
    </div>
    <form class="form" action="/mypage/profile/updateprofile" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="image" value="{{ session('imagePath') ?? $profile->image }}">

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
                    <input type="text" name="postcode" value="{{ old('postcode', $profile->postcode ?? '') }}" />
                </div>
                <div class="form__error">
                    @error('postcode')
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
                    <input type="text" name="address" value="{{ old('address', $profile->address ?? '') }}" />
                </div>
                <div class="form__error">
                    @error('address')
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
                    <input type="text" name="building" value="{{ old('building', $profile->building ?? '') }}" />
                </div>
                <div class="form__error">
                    @error('building')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">更新する</button>
        </div>
    </form>
</div>
@endsection