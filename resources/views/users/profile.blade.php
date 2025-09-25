@extends('layouts.layout')

@section('title', 'Личный кабинет')

@section('content')
<div class="container mt-5">
    <div class="card shadow p-4" style="max-width: 500px; margin: auto;">
        <h2 class="text-center mb-4">Личный кабинет</h2>

        <p><strong>Имя:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Phone:</strong> {{ $user->phone }}</p>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Каталог</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger">Выйти</button>
            </form>
        </div>
    </div>
</div>
@endsection