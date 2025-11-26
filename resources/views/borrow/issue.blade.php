@extends('layouts.app')

@section('title', 'Issue Book')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Issue Book to User</h1>

        <form action="{{ route('borrow.store-issue') }}" method="POST" class="space-y-6">
            @csrf

            <!-- User Dropdown -->
            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">Select User <span class="text-red-500">*</span></label>
                <select 
                    id="user_id" 
                    name="user_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('user_id') border-red-500 @enderror"
                    required
                    onchange="document.getElementById('bookSelect').focus()"
                >
                    <option value="">-- Select a user --</option>
                    @foreach($users ?? [] as $user)
                        <option value="{{ $user->id }}" @if(old('user_id') == $user->id) selected @endif>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Book Dropdown -->
            <div>
                <label for="book_id" class="block text-sm font-medium text-gray-700 mb-2">Select Book <span class="text-red-500">*</span></label>
                <select 
                    id="bookSelect"
                    name="book_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('book_id') border-red-500 @enderror"
                    required
                >
                    <option value="">-- Select a book --</option>
                    @foreach($books ?? [] as $book)
                        @if($book->stock > 0)
                            <option value="{{ $book->id }}" @if(old('book_id', request('book_id')) == $book->id) selected @endif>
                                {{ $book->title }} by {{ $book->author }} (Stock: {{ $book->stock }})
                            </option>
                        @endif
                    @endforeach
                </select>
                @if($books && $books->where('stock', '>', 0)->count() == 0)
                    <p class="mt-2 text-sm text-yellow-600">⚠️ All books are currently out of stock.</p>
                @endif
                @error('book_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex gap-3 pt-4">
                <button 
                    type="submit" 
                    class="flex-1 bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition font-medium"
                >
                    Issue Book
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

    <!-- Quick Stats -->
    <div class="grid grid-cols-2 gap-4 mt-8">
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-gray-600 text-sm font-medium">Total Users</p>
            <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $users->count() ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-gray-600 text-sm font-medium">Books in Stock</p>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ $books->where('stock', '>', 0)->count() ?? 0 }}</p>
        </div>
    </div>
</div>
@endsection
