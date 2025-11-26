@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <!-- User Header -->
    <div class="mb-8">
        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900">My Dashboard</h1>
        <p class="text-gray-600 mt-2">Hello, {{ Auth::user()->name }}! 👋</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Issued Books (Active) -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
                <div class="px-6 py-4 bg-gradient-to-r from-blue-500 to-blue-600">
                    <h2 class="text-lg font-semibold text-white">📚 Currently Issued Books</h2>
                </div>

                @if($issuedBooks->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Book Title</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Author</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Issue Date</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Category</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @foreach($issuedBooks as $issue)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                            {{ $issue->book->title }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ $issue->book->author }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ $issue->issue_date->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">
                                                {{ $issue->book->category->name }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile View for Issued Books -->
                    <div class="md:hidden divide-y">
                        @foreach($issuedBooks as $issue)
                            <div class="p-4 border-b hover:bg-gray-50">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-semibold text-gray-900 text-sm flex-1">
                                        {{ $issue->book->title }}
                                    </h3>
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs font-semibold whitespace-nowrap ml-2">
                                        {{ $issue->book->category->name }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600">Author: {{ $issue->book->author }}</p>
                                <p class="text-sm text-gray-600">Issued: {{ $issue->issue_date->format('d M Y') }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-8 text-center">
                        <p class="text-gray-500 text-lg">📭 No books currently issued</p>
                        <p class="text-gray-400 text-sm mt-2">You can request an admin to issue books for you</p>
                    </div>
                @endif
            </div>

            <!-- Returned Books History -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-green-500 to-green-600">
                    <h2 class="text-lg font-semibold text-white">✓ Returned Books History</h2>
                </div>

                @if($returnedBooks->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Book Title</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Issue Date</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Return Date</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Duration</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @foreach($returnedBooks as $return)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                            {{ $return->book->title }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ $return->issue_date->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ $return->return_date->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ $return->return_date->diffInDays($return->issue_date) }} days
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile View for Returned Books -->
                    <div class="md:hidden divide-y">
                        @foreach($returnedBooks as $return)
                            <div class="p-4 border-b hover:bg-gray-50">
                                <h3 class="font-semibold text-gray-900 text-sm mb-2">
                                    {{ $return->book->title }}
                                </h3>
                                <p class="text-sm text-gray-600">Issued: {{ $return->issue_date->format('d M Y') }}</p>
                                <p class="text-sm text-gray-600">Returned: {{ $return->return_date->format('d M Y') }}</p>
                                <p class="text-sm text-green-600 font-semibold mt-2">
                                    Duration: {{ $return->return_date->diffInDays($return->issue_date) }} days
                                </p>
                            </div>
                        @endforeach
                    </div>

                    @if($returnedBooks->hasPages())
                        <div class="px-6 py-4 border-t">
                            {{ $returnedBooks->links() }}
                        </div>
                    @endif
                @else
                    <div class="p-8 text-center">
                        <p class="text-gray-500 text-lg">📚 No returned books yet</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar Info -->
        <div>
            <!-- Profile Card -->
            <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
                <div class="px-6 py-4 bg-gradient-to-r from-indigo-500 to-indigo-600">
                    <h2 class="text-lg font-semibold text-white">👤 My Profile</h2>
                </div>

                <div class="p-6 space-y-4">
                    <div>
                        <p class="text-sm text-gray-500">Full Name</p>
                        <p class="font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Email Address</p>
                        <p class="font-semibold text-gray-900">{{ Auth::user()->email }}</p>
                    </div>

                    @if(Auth::user()->phone)
                        <div>
                            <p class="text-sm text-gray-500">Phone</p>
                            <p class="font-semibold text-gray-900">{{ Auth::user()->phone }}</p>
                        </div>
                    @endif

                    @if(Auth::user()->address)
                        <div>
                            <p class="text-sm text-gray-500">Address</p>
                            <p class="font-semibold text-gray-900">{{ Auth::user()->address }}</p>
                        </div>
                    @endif

                    <div>
                        <p class="text-sm text-gray-500">Member Since</p>
                        <p class="font-semibold text-gray-900">{{ Auth::user()->created_at->format('d M Y') }}</p>
                    </div>

                    @if(Auth::user()->last_login)
                        <div>
                            <p class="text-sm text-gray-500">Last Login</p>
                            <p class="font-semibold text-gray-900">{{ Auth::user()->last_login->diffForHumans() }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Statistics Card -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg shadow p-6 mb-6">
                <h3 class="font-semibold text-gray-900 mb-4">📊 Statistics</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Active Issues:</span>
                        <span class="font-bold text-blue-600">{{ $issuedBooks->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Total Returned:</span>
                        <span class="font-bold text-green-600">{{ $returnedBooks->total() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
