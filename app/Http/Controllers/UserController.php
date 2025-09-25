<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        $title = 'Регистрация';
        return view('users.register', compact('title'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed',
        ]);

        $user= User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

         session()->flash('Регистрация пройдена');
        Auth::login($user);
        return redirect()->route('products.index');
    }

    public function loginForm()
    {
        return view('users.login');
    }

        public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if(Auth()->attempt($request->only('email', 'password'))){
            $user = Auth::user();
             
            if ($user->role === 'admin') {
            return redirect()->route('admin.index')->with('success', 'Добро пожаловать, админ!');
        }
            return redirect()->route('products.index')->with('success', 'Вы вошли в аккаунт');
        }
        return back()->withErrors(['login'=>'Неверный логин или пароль']);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Вы вышли из системы');
    }
    public function profile()
{
    $user = Auth::user(); // получаем текущего авторизованного пользователя
    return view('users.profile', compact('user'));
}
}
