@extends('layouts.layout') 

@section('content')
    <div class="container">
        <h1>Панель администратора </h1>
        <a href="{{ route('admin.create') }}" class="btn btn-success mb-3">Добавить</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Картинка</th>
                    <th>Наименование</th>
                    <th>Цена</th>
                    <th>Старая цена</th>
                    <th>Количество</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                         <td>{{ $product->id }}</td>
                         <td>
                             @if ($product->img)
                                 <img src="{{ $product->getImage() }}" alt="{{ $product->title }}" style="width: 50px;">
                             @else
                                 <span>Нет изображения</span>
                             @endif
                         </td>
                         <td>{{ $product->title }}</td>
                         <td>{{ $product->slug}}</td>
                         <td>{{ $product->content }}</td>
                         <td>{{ $product->category_id}}</td>
                         <td>{{ $product->status_id}}</td>
                         <td>{{ $product->price }} руб.</td>
                         <td>{{ $product->old_price ?? '-' }} руб.</td>
                         <td>{{ $product->img}}</td>
                         <td>
                             <a href="{{ route('admin.edit', $product->id) }}" class="btn btn-sm btn-primary">
                                 <i class="fas fa-edit"></i> Редактировать
                             </a>
                             <form action="{{ route('admin.destroy', $product->id) }}" method="POST" style="display: inline-block;">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены?')">
                                     <i class="fas fa-trash"></i> Удалить
                                 </button>
                             </form>
                         </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection