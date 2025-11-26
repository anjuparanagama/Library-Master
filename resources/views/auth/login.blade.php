@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center px-4 sm:px-6 lg:px-8" style="height: calc(100vh - 140px);">
    <div class="max-w-md w-full bg-white rounded-lg shadow-md p-6 sm:p-8">
        <div class="text-center mb-6">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Library Master</h2>
            <p class="text-gray-600 mt-1 text-sm">Sign in to your account</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg">
                @foreach ($errors->all() as $error)
                    <p class="text-red-600 text-xs">{{ $error }}</p>
                @endforeach
            </div>
        @endif


        <form method="POST" action="{{ route('login.post') }}" class="space-y-3">
            @csrf

            <div>
                <label for="email" class="block text-xs font-medium text-gray-700 mb-1">
                    Email Address
                </label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
                    placeholder="Enter your email"
                />
            </div>

            <div>
                <label for="password" class="block text-xs font-medium text-gray-700 mb-1">
                    Password
                </label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
                    placeholder="Enter your password"
                />
            </div>

            <button
                type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 text-sm"
            >
                Sign In
            </button>
        </form>
    </div>
</div>
@endsection
