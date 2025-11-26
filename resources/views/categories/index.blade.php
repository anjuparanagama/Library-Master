@extends('layouts.app')

@section('title', 'Categories Management')

@section('content')
<div class="space-y-4 sm:space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 sm:gap-0">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Categories Management</h1>
        <a href="{{ route('categories.create') }}" class="w-full sm:w-auto bg-indigo-600 text-white px-3 sm:px-4 py-2 rounded-lg hover:bg-indigo-700 transition font-medium text-center text-sm sm:text-base">
            + Add Category
        </a>
    </div>

    <!-- Categories Table -->
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        @if($categories && $categories->count() > 0)
            <!-- Desktop View -->
            <table class="hidden md:table w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Category Name</th>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Books Count</th>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($categories as $category)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                <span class="text-xs sm:text-sm font-medium text-gray-900">{{ $category->name }}</span>
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $category->books_count ?? 0 }}
                                </span>
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm font-medium space-x-2">
                                <a href="{{ route('categories.edit', $category->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure? This will not delete books in this category.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Mobile Card View -->
            <div class="md:hidden space-y-3 p-3 sm:p-4">
                @foreach($categories as $category)
                    <div class="border border-gray-200 rounded-lg p-4 space-y-3">
                        <div class="flex justify-between items-center">
                            <h3 class="font-semibold text-gray-900 text-sm">{{ $category->name }}</h3>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $category->books_count ?? 0 }}
                            </span>
                        </div>
                        <div class="flex gap-2 pt-2 border-t border-gray-200">
                            <a href="{{ route('categories.edit', $category->id) }}" class="text-xs bg-blue-50 text-blue-600 px-3 py-1 rounded hover:bg-blue-100">Edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs bg-red-50 text-red-600 px-3 py-1 rounded hover:bg-red-100">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="p-6 sm:p-8 text-center">
                <p class="text-gray-500 text-sm sm:text-lg">No categories found. <a href="{{ route('categories.create') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">Create one now</a></p>
            </div>
        @endif
    </div>
</div>
@endsection
