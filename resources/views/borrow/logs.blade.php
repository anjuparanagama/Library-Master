@extends('layouts.app')

@section('title', 'Borrow/Return Logs')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Book Issue & Return Logs</h1>
        <div class="flex gap-2">
            <a href="{{ route('borrow.issue') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition font-medium">
                + Issue Book
            </a>
            <a href="{{ route('borrow.return') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-medium">
                + Return Book
            </a>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-lg shadow p-4">
        <form method="GET" action="{{ route('borrow.logs') }}" class="flex gap-4 items-end flex-wrap">
            <!-- Filter by User -->
            <div class="flex-1 min-w-48">
                <label class="block text-sm font-medium text-gray-700 mb-2">Filter by User</label>
                <select name="user_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" onchange="this.form.submit()">
                    <option value="">All Users</option>
                    @foreach($users ?? [] as $user)
                        <option value="{{ $user->id }}" @if(request('user_id') == $user->id) selected @endif>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filter by Action -->
            <div class="flex-1 min-w-48">
                <label class="block text-sm font-medium text-gray-700 mb-2">Filter by Action</label>
                <select name="action" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" onchange="this.form.submit()">
                    <option value="">All Actions</option>
                    <option value="issued" @if(request('action') == 'issued') selected @endif>Issued</option>
                    <option value="returned" @if(request('action') == 'returned') selected @endif>Returned</option>
                </select>
            </div>

            @if(request('user_id') || request('action'))
                <a href="{{ route('borrow.logs') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition font-medium">
                    Clear Filters
                </a>
            @endif
        </form>
    </div>

    <!-- Logs Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($borrows && $borrows->count() > 0)
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Book</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Author</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Issue Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Return Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($borrows as $borrow)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-900">{{ $borrow->user->name }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-600">{{ $borrow->book->title }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-600">{{ $borrow->book->author }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-600">{{ $borrow->issue_date->format('M d, Y') }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($borrow->return_date)
                                    <span class="text-sm text-gray-600">{{ $borrow->return_date->format('M d, Y') }}</span>
                                @else
                                    <span class="text-sm text-yellow-600">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($borrow->return_date)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Returned
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Issued
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="p-8 text-center">
                <p class="text-gray-500 text-lg">No borrow records found.</p>
            </div>
        @endif
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-gray-600 text-sm font-medium">Total Issues</p>
            <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $totalIssues ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-gray-600 text-sm font-medium">Total Returns</p>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ $totalReturns ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-gray-600 text-sm font-medium">Books Currently Issued</p>
            <p class="text-3xl font-bold text-red-600 mt-2">{{ $booksInCirculation ?? 0 }}</p>
        </div>
    </div>
</div>
@endsection
