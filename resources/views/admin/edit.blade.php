@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>Редактировать товар</h1>

        <form action="{{ route('admin.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
           <div class="mb-3">
                <label for="title" class="form-label">Наименование</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $product->title ?? '') }}"required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Описание</label>
                <textarea class="form-control" id="content" name="content" >{{ old('content', $product->content ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Категория</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="status_id" class="form-label">Статус</label>
                <select class="form-control" id="status_id" name="status_id" required>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}">{{ $status->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="img" class="form-label">Изображение</label>
                <input type="file" class="form-control" id="img" name="img">
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Цена</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ old('price', $product->price ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label for="old_price" class="form-label">Старая цена</label>
                <input type="number" class="form-control" id="old_price" name="old_price" value="{{ old('old_price', $product->old_price ?? '') }}" step="0.01">
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endsection