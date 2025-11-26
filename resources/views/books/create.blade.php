@extends('layouts.app')

@section('title', 'Add New Book')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow p-4 sm:p-8">
        <h1 class="text-xl sm:text-2xl font-bold text-gray-900 mb-6">Add New Book</h1>

        <form action="{{ route('books.store') }}" method="POST" class="space-y-4 sm:space-y-6">
            @csrf

            <!-- Title Field -->
            <div>
                <label for="title" class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">Title <span class="text-red-500">*</span></label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    value="{{ old('title') }}"
                    class="w-full px-3 sm:px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm @error('title') border-red-500 @enderror"
                    placeholder="Enter book title"
                    required
                >
                @error('title')
                    <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Author Field -->
            <div>
                <label for="author" class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">Author <span class="text-red-500">*</span></label>
                <input 
                    type="text" 
                    id="author" 
                    name="author" 
                    value="{{ old('author') }}"
                    class="w-full px-3 sm:px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm @error('author') border-red-500 @enderror"
                    placeholder="Enter author name"
                    required
                >
                @error('author')
                    <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category Field -->
            <div>
                <label for="category_id" class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">Category <span class="text-red-500">*</span></label>
                <select 
                    id="category_id" 
                    name="category_id"
                    class="w-full px-3 sm:px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm @error('category_id') border-red-500 @enderror"
                    required
                >
                    <option value="">Select a category</option>
                    @foreach($categories ?? [] as $category)
                        <option value="{{ $category->id }}" @if(old('category_id') == $category->id) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Price Field -->
            <div>
                <label for="price" class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">Price <span class="text-red-500">*</span></label>
                <input 
                    type="number" 
                    id="price" 
                    name="price" 
                    value="{{ old('price') }}"
                    step="0.01"
                    min="0"
                    class="w-full px-3 sm:px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm @error('price') border-red-500 @enderror"
                    placeholder="0.00"
                    required
                >
                @error('price')
                    <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Stock Field -->
            <div>
                <label for="stock" class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">Stock <span class="text-red-500">*</span></label>
                <input 
                    type="number" 
                    id="stock" 
                    name="stock" 
                    value="{{ old('stock') }}"
                    min="0"
                    class="w-full px-3 sm:px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm @error('stock') border-red-500 @enderror"
                    placeholder="0"
                    required
                >
                @error('stock')
                    <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex flex-col sm:flex-row gap-3 pt-4">
                <button 
                    type="submit" 
                    class="w-full sm:flex-1 bg-indigo-600 text-white px-4 sm:px-6 py-2 rounded-lg hover:bg-indigo-700 transition font-medium text-sm"
                >
                    Add Book
                </button>
                <a 
                    href="{{ route('books.index') }}" 
                    class="w-full sm:flex-1 bg-gray-300 text-gray-700 px-4 sm:px-6 py-2 rounded-lg hover:bg-gray-400 transition font-medium text-center text-sm"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
