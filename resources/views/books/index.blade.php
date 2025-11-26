@extends('layouts.app')

@section('title', 'Books Management')

@section('content')
<div class="space-y-4 sm:space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 sm:gap-0">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Books Management</h1>
        <a href="{{ route('books.create') }}" class="w-full sm:w-auto bg-indigo-600 text-white px-3 sm:px-4 py-2 rounded-lg hover:bg-indigo-700 transition font-medium text-center text-sm sm:text-base">
            + Add New Book
        </a>
    </div>

    <!-- Category Filter -->
    <div class="bg-white rounded-lg shadow p-4 sm:p-6">
        <form method="GET" action="{{ route('books.index') }}" class="flex flex-col sm:flex-row gap-3 sm:gap-4 items-start sm:items-end">
            <div class="flex-1 w-full sm:w-auto">
                <label class="block text-sm font-semibold text-gray-900 mb-3">📚 Filter by Category</label>
                <select name="category" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm font-medium bg-white text-gray-900 appearance-none cursor-pointer hover:border-gray-400 transition" onchange="this.form.submit()">
                    <option value="" class="text-gray-900">All Categories</option>
                    @foreach($categories ?? [] as $category)
                        <option value="{{ $category->id }}" class="text-gray-900" @if(request('category') == $category->id) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @if(request('category'))
                <a href="{{ route('books.index') }}" class="w-full sm:w-auto bg-indigo-600 text-white px-4 py-3 rounded-lg hover:bg-indigo-700 transition font-semibold text-center text-sm">
                    ✕ Clear Filter
                </a>
            @endif
        </form>
    </div>

    <!-- Books Table - Responsive -->
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        @if($books && $books->count() > 0)
            <!-- Desktop View -->
            <table class="hidden md:table w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Title</th>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Author</th>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Category</th>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Price</th>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Stock</th>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($books as $book)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                <span class="text-xs sm:text-sm font-medium text-gray-900">{{ $book->title }}</span>
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                <span class="text-xs sm:text-sm text-gray-600">{{ $book->author }}</span>
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                <span class="text-xs sm:text-sm text-gray-600">{{ $book->category->name ?? 'N/A' }}</span>
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                <span class="text-xs sm:text-sm font-medium text-gray-900">Rs.{{ number_format($book->price, 2) }}</span>
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                @if($book->stock == 0)
                                    <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Out of Stock
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        {{ $book->stock }} Available
                                    </span>
                                @endif
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm font-medium space-x-2">
                                <a href="{{ route('books.edit', $book->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                                @if($book->stock > 0)
                                    <a href="{{ route('borrow.issue') }}?book_id={{ $book->id }}" class="text-green-600 hover:text-green-900">Issue</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Mobile Card View -->
            <div class="md:hidden space-y-3 p-3 sm:p-4">
                @foreach($books as $book)
                    <div class="border border-gray-200 rounded-lg p-4 space-y-3">
                        <div class="flex justify-between items-start gap-2">
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900 text-sm">{{ $book->title }}</h3>
                                <p class="text-xs text-gray-600">by {{ $book->author }}</p>
                            </div>
                            @if($book->stock == 0)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 shrink-0">
                                    Out
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 shrink-0">
                                    {{ $book->stock }}
                                </span>
                            @endif
                        </div>
                        <div class="flex justify-between text-xs text-gray-600">
                            <span>Category: {{ $book->category->name ?? 'N/A' }}</span>
                            <span class="font-medium text-gray-900">Rs.{{ number_format($book->price, 2) }}</span>
                        </div>
                        <div class="flex gap-2 flex-wrap pt-2 border-t border-gray-200">
                            <a href="{{ route('books.edit', $book->id) }}" class="text-xs bg-blue-50 text-blue-600 px-3 py-1 rounded hover:bg-blue-100">Edit</a>
                            @if($book->stock > 0)
                                <a href="{{ route('borrow.issue') }}?book_id={{ $book->id }}" class="text-xs bg-green-50 text-green-600 px-3 py-1 rounded hover:bg-green-100">Issue</a>
                            @endif
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
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
                <p class="text-gray-500 text-sm sm:text-lg">No books found. <a href="{{ route('books.create') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">Create one now</a></p>
            </div>
        @endif
    </div>
</div>
@endsection
