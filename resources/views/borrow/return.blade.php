@extends('layouts.app')

@section('title', 'Return Book')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Return Book from User</h1>

        <!-- User Selection Form (GET) -->
        <form method="GET" action="{{ route('borrow.return') }}" class="space-y-4 mb-6">
            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">Select User <span class="text-red-500">*</span></label>
                <div class="flex gap-2">
                    <select 
                        id="user_id" 
                        name="user_id"
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        required
                    >
                        <option value="">-- Select a user --</option>
                        @foreach($users ?? [] as $user)
                            <option value="{{ $user->id }}" @if(request('user_id') == $user->id) selected @endif>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium">
                        Load Books
                    </button>
                </div>
            </div>
        </form>

        <!-- Return Book Form (POST) - Only show when user is selected -->
        @if(request('user_id') && !empty($issuedBooks) && count($issuedBooks) > 0)
            <form action="{{ route('borrow.store-return') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="user_id" value="{{ request('user_id') }}">

                <div>
                    <label for="borrow_id" class="block text-sm font-medium text-gray-700 mb-2">Select Book to Return <span class="text-red-500">*</span></label>
                    <select 
                        id="borrow_id"
                        name="borrow_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        required
                    >
                        <option value="">-- Select a book to return --</option>
                        @foreach($issuedBooks as $borrow)
                            <option value="{{ $borrow->id }}">
                                {{ $borrow->book->title }} by {{ $borrow->book->author }} 
                                (Issued: {{ $borrow->issue_date->format('M d, Y') }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Form Actions -->
                <div class="flex gap-3 pt-4">
                    <button 
                        type="submit" 
                        class="flex-1 bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition font-medium"
                    >
                        Return Book
                    </button>
                    <a 
                        href="{{ route('books.index') }}" 
                        class="flex-1 bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition font-medium text-center"
                    >
                        Cancel
                    </a>
                </div>
            </form>
        @elseif(request('user_id'))
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-center">
                <p class="text-sm text-yellow-800">ℹ️ This user has no books currently issued.</p>
            </div>
        @endif
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-2 gap-4 mt-8">
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-gray-600 text-sm font-medium">Total Users</p>
            <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $users->count() ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-gray-600 text-sm font-medium">Books Issued</p>
            <p class="text-3xl font-bold text-orange-600 mt-2">{{ $totalIssued ?? 0 }}</p>
        </div>
    </div>
</div>
@endsection
