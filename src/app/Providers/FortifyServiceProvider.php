<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::registerView(function () {
            return view('auth.register');
        });

        Fortify::loginView(function () {
            return view('auth.login');
        });
       
       

        // 「ユーザー名またはメールアドレス」でログインを可能にする認証ロジック
        Fortify::authenticateUsing(function (\Illuminate\Http\Request $request) {
            
            $request->validate([
                'login' => 'required|string|max:255',
                'password' => 'required|string',
            ]);
            $login = $request->input('login'); // フォームから入力された「ユーザー名またはメールアドレス」
            $password = $request->input('password');

            // ユーザー名またはメールアドレスでユーザーを検索
            $user = \App\Models\User::where('email', $login)
                ->orWhere('name', $login)
                ->first();

            // パスワードを検証
            if ($user && Hash::check($password, $user->password)) {
                return $user;
            }

            return null; // 認証失敗時
        });

        
        RateLimiter::for('login', function (\Illuminate\Http\Request $request) {
            $login = (string) $request->input('login');
            return Limit::perMinute(10)->by($login . $request->ip());
        });
        
       // RateLimiter::for('login', function (Request $request) {
       //     $email = (string) $request->email;
       //    return Limit::perMinute(10)->by($email . $request->ip());
        
      //  });
        

    }
}
