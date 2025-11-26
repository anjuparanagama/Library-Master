@extends('layouts.app')

@section('title', 'Edit Book')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Book</h1>

        <form action="{{ route('books.update', $book->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Title Field -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title <span class="text-red-500">*</span></label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    value="{{ old('title', $book->title) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('title') border-red-500 @enderror"
                    placeholder="Enter book title"
                    required
                >
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Author Field -->
            <div>
                <label for="author" class="block text-sm font-medium text-gray-700 mb-2">Author <span class="text-red-500">*</span></label>
                <input 
                    type="text" 
                    id="author" 
                    name="author" 
                    value="{{ old('author', $book->author) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('author') border-red-500 @enderror"
                    placeholder="Enter author name"
                    required
                >
                @error('author')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category Field -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category <span class="text-red-500">*</span></label>
                <select 
                    id="category_id" 
                    name="category_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('category_id') border-red-500 @enderror"
                    required
                >
                    <option value="">Select a category</option>
                    @foreach($categories ?? [] as $category)
                        <option value="{{ $category->id }}" @if(old('category_id', $book->category_id) == $category->id) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Price Field -->
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price <span class="text-red-500">*</span></label>
                <input 
                    type="number" 
                    id="price" 
                    name="price" 
                    value="{{ old('price', $book->price) }}"
                    step="0.01"
                    min="0"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('price') border-red-500 @enderror"
                    placeholder="0.00"
                    required
                >
                @error('price')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Stock Field -->
            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">Stock <span class="text-red-500">*</span></label>
                <input 
                    type="number" 
                    id="stock" 
                    name="stock" 
                    value="{{ old('stock', $book->stock) }}"
                    min="0"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('stock') border-red-500 @enderror"
                    placeholder="0"
                    required
                >
                @error('stock')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex gap-3 pt-4">
                <button 
                    type="submit" 
                    class="flex-1 bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition font-medium"
                >
                    Update Book
                </button>
                <a 
                    href="{{ route('books.index') }}" 
                    class="flex-1 bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition font-medium text-center"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
