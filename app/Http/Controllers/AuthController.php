<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|unique:users,username|min:3|max:255',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'username.required' => 'Логин обязателен',
            'username.unique' => 'Этот логин уже существует',
            'username.min' => 'Логин должен быть не менее 3 символов',
            'password.required' => 'Пароль обязателен',
            'password.min' => 'Пароль должен быть не менее 6 символов',
            'password.confirmed' => 'Пароли не совпадают',
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role_id' => 2,
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Регистрация успешна!');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Логин обязателен',
            'password.required' => 'Пароль обязателен',
        ]);

        $user = User::where('username', $validated['username'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return back()->withErrors([
                'username' => 'Логин или пароль неверны',
            ])->onlyInput('username');
        }

        Auth::login($user);

        return redirect('/')->with('success', 'Вы успешно вошли!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Вы успешно вышли!');
    }
}
