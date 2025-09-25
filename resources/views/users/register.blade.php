@extends('layouts.auth')
<div class="container">

    <h1>Регистрация</h1>
    @error('login')
    {{ $message }}
    @enderror
    <form action="{{ route('register.index') }}" method="POST">
          @csrf

            <div class="mb-3">
                <label class="form-label">Имя</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Электронная почта</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                 <label class="form-label">Номер телефона</label>
                 <input type="tel" name="phone" class="form-control" value="{{ old('phone') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Пароль</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Повторите пароль</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>

        <p class="text-center mt-3">
            Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a>
        </p>
    </form>
</div>
