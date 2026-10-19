<?php

namespace App\Actions;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();

        // 管理者なら管理者勤怠一覧へ
        if ($user->role === 'admin') {
            return redirect()->route('admin-attendance-list');
        }

        // スタッフならスタッフ勤怠登録へ
        return redirect()->route('user.attendance-register');
    }
}
