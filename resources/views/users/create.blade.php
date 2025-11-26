@extends('layouts.app')

@section('title', 'Add User')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Add New User</h1>

        <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Name Field -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name <span class="text-red-500">*</span></label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('name') border-red-500 @enderror"
                    placeholder="Enter full name"
                    required
                >
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('email') border-red-500 @enderror"
                    placeholder="Enter email address"
                    required
                >
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone Field -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                <input 
                    type="tel" 
                    id="phone" 
                    name="phone" 
                    value="{{ old('phone') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('phone') border-red-500 @enderror"
                    placeholder="Enter phone number"
                >
                @error('phone')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address Field -->
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                <textarea 
                    id="address" 
                    name="address"
                    rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('address') border-red-500 @enderror"
                    placeholder="Enter address"
                >{{ old('address') }}</textarea>
                @error('address')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex gap-3 pt-4">
                <button 
                    type="submit" 
                    class="flex-1 bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition font-medium"
                >
                    Add User
                </button>
                <a 
                    href="{{ route('users.index') }}" 
                    class="flex-1 bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition font-medium text-center"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
