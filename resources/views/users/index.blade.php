@extends('layouts.app')

@section('title', 'Users Management')

@section('content')
<div class="space-y-4 sm:space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 sm:gap-0">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Users Management</h1>
        <a href="{{ route('users.create') }}" class="w-full sm:w-auto bg-indigo-600 text-white px-3 sm:px-4 py-2 rounded-lg hover:bg-indigo-700 transition font-medium text-center text-sm sm:text-base">
            + Add User
        </a>
    </div>

    <!-- Users Table - Responsive -->
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        @if($users && $users->count() > 0)
            <!-- Desktop View -->
            <table class="hidden md:table w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Name</th>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Email</th>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Phone</th>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Address</th>
                        <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                <span class="text-xs sm:text-sm font-medium text-gray-900">{{ $user->name }}</span>
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                <span class="text-xs sm:text-sm text-gray-600">{{ $user->email }}</span>
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                <span class="text-xs sm:text-sm text-gray-600">{{ $user->phone ?? '-' }}</span>
                            </td>
                            <td class="px-3 sm:px-6 py-4">
                                <span class="text-xs sm:text-sm text-gray-600 line-clamp-2">{{ $user->address ?? '-' }}</span>
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm font-medium space-x-2">
                                <a href="{{ route('users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
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
                @foreach($users as $user)
                    <div class="border border-gray-200 rounded-lg p-4 space-y-3">
                        <div class="flex justify-between items-start gap-2">
                            <div>
                                <h3 class="font-semibold text-gray-900 text-sm">{{ $user->name }}</h3>
                                <p class="text-xs text-gray-600 truncate">{{ $user->email }}</p>
                            </div>
                        </div>
                        @if($user->phone)
                            <div class="text-xs text-gray-600">
                                <span class="font-medium">Phone:</span> {{ $user->phone }}
                            </div>
                        @endif
                        @if($user->address)
                            <div class="text-xs text-gray-600">
                                <span class="font-medium">Address:</span> {{ Str::limit($user->address, 50) }}
                            </div>
                        @endif
                        <div class="flex gap-2 flex-wrap pt-2 border-t border-gray-200">
                            <a href="{{ route('users.edit', $user->id) }}" class="text-xs bg-blue-50 text-blue-600 px-3 py-1 rounded hover:bg-blue-100">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
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
                <p class="text-gray-500 text-sm sm:text-lg">No users found. <a href="{{ route('users.create') }}" class="text-indigo-600 hover:text-indigo-700 font-medium">Create one now</a></p>
            </div>
        @endif
    </div>
</div>
@endsection
