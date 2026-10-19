<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Fortify;

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
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        // ログイン画面の切り替え
        Fortify::loginView(function (Request $request) {
            if ($request->routeIs('admin.admin-login')) {
                return view('admin.admin-login'); // 管理者ログイン画面
            }

            return view('user.user-login'); // デフォルトはスタッフ
        });

        Fortify::registerView(function (Request $request) {
            return view('user.register');
        });

        // LoginResposeで管理者ログイン画面の遷移　
        $this->app->singleton(
            \Laravel\Fortify\Contracts\LoginResponse::class,
            \App\Actions\LoginResponse::class
        );

        // ログインできるかどうか判定する(ログインする直前で確認)
        Fortify::authenticateUsing(function (Request $request) {

            // メールアドレスでユーザーを取得
            $user = User::where('email', $request->email)->first();
            // ユーザーが存在しない場合は null を返す
            if (! $user) {
                return null;
            }

            // 管理者ログイン画面から来た場合admin 以外は弾く
            if ($request->routeIs('admin.admin-login') && $user->role !== 'admin') {
                return null;
            }

            // スタッフログイン画面から来た場合staff 以外は弾く
            if ($request->routeIs('staff.login') && $user->role !== 'staff') {
                return null;
            }

            // ここまで来たら role が一致しているのでOK
            return $user;
        });

    }
}
