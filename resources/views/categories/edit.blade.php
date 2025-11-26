@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Category</h1>

        <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Category Name Field -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Category Name <span class="text-red-500">*</span></label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', $category->name) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('name') border-red-500 @enderror"
                    placeholder="Enter category name"
                    required
                >
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex gap-3 pt-4">
                <button 
                    type="submit" 
                    class="flex-1 bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition font-medium"
                >
                    Update Category
                </button>
                <a 
                    href="{{ route('categories.index') }}" 
                    class="flex-1 bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition font-medium text-center"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
