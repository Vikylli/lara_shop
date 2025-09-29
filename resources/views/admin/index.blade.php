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
                    <th>Slug</th>
                    <th>Описание</th>
                    <th>Количество</th>
                    <th>Действия</th>
                    <th>Цена</th>
                    <th>Старая цена</th>
                    <th>Изображения</th>
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
                             <form action="{{ route('admin.edit', $product->id) }}" method="GET" style="display: inline;">
                                     <button type="submit" class="btn btn-sm btn-primary d-flex align-items-center"">
                                         <i class="fas fa-edit "></i> Редактировать
                                     </button>
                            </form>
                             <form action="{{ route('admin.destroy', $product->id) }}" method="POST" style="display: inline-block;">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit" class="btn btn-sm btn-danger  " style="min-width: 128px;" onclick="return confirm('Вы уверены?')">
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