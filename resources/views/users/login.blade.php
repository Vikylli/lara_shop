@extends('layouts.auth')
<div class="container">
    <h1>Авторизация</h1>
    @error('login')
    {{ $message }}
    @enderror
    <form action="{{ route('login') }}" method="POST">
        @csrf
       <div class="mb-3">
                <label class="form-label">Электронная почта</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Пароль</label>
                <input type="password" name="password" class="form-control" required>
            </div>
        <button type="submit" class="btn btn-primary">Войти</button>
    </form>
</div>