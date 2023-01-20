<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class LoginController extends Controller {
    public function create() {
        return view('login_view');
    }

    public function signup_create() {
        return view('signup');
    }

    public function signup(): RedirectResponse{
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => request()->name,
            'email' => request()->email,
            'password' => Hash::make(request()->password), // 비밀번호는 해시해야함
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect('/');
    }

    public function authenticate() {
        $credentials = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)) {
            // 인증 성공 시 세션 고정 공격을 방지하기 위해 사용자의 세션을 다시 생성
            request()->session()->regenerate();
            return redirect('/');
        }
        
        return back()->with('error', '아이디 또는 비밀번호 오류');
    }

    public function logout() {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerate();

        return redirect('/');
    }
}