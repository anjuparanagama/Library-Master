@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <!-- Admin Header -->
    <div class="mb-8">
        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900">Admin Dashboard</h1>
        <p class="text-gray-600 mt-2">Welcome, {{ Auth::user()->name }}! 👋</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Users</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalUsers }}</p>
                </div>
                <div class="text-blue-500 text-4xl">👥</div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Books</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalBooks }}</p>
                </div>
                <div class="text-green-500 text-4xl">📚</div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Categories</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalCategories }}</p>
                </div>
                <div class="text-purple-500 text-4xl">📂</div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-red-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Active Issues</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $activeIssues }}</p>
                </div>
                <div class="text-red-500 text-4xl">⏳</div>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="bg-white rounded-lg shadow overflow-hidden mt-8">
        <div class="px-6 py-4 bg-gray-50 border-b">
            <h2 class="text-lg font-semibold text-gray-900">Recent Activities</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">User</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Book</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Action</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Date</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($allBorrows as $borrow)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $borrow->user->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $borrow->book->title }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs font-semibold">
                                    {{ $borrow->return_date ? 'Returned' : 'Issued' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $borrow->issue_date->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                @if($borrow->return_date)
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-semibold">
                                        ✓ Returned
                                    </span>
                                @else
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs font-semibold">
                                        ⏳ Issued
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                No borrowing activities yet
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($allBorrows->hasPages())
            <div class="px-6 py-4 border-t">
                {{ $allBorrows->links() }}
            </div>
        @endif
    </div>

    <!-- Quick Actions -->
    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <a href="{{ route('books.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow p-4 text-center transition">
            <p class="text-2xl mb-2">📚</p>
            <p class="font-semibold">Manage Books</p>
        </a>
        <a href="{{ route('categories.index') }}" class="bg-purple-500 hover:bg-purple-600 text-white rounded-lg shadow p-4 text-center transition">
            <p class="text-2xl mb-2">📂</p>
            <p class="font-semibold">Manage Categories</p>
        </a>
        <a href="{{ route('users.index') }}" class="bg-green-500 hover:bg-green-600 text-white rounded-lg shadow p-4 text-center transition">
            <p class="text-2xl mb-2">👥</p>
            <p class="font-semibold">Manage Users</p>
        </a>
        <a href="{{ route('borrow.logs') }}" class="bg-red-500 hover:bg-red-600 text-white rounded-lg shadow p-4 text-center transition">
            <p class="text-2xl mb-2">📋</p>
            <p class="font-semibold">Borrowing Logs</p>
        </a>
    </div>
</div>
@endsection
