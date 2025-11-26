<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Borrow;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Admin dashboard with all activities
            $totalUsers = User::count();
            $totalBooks = Book::count();
            $totalCategories = Category::count();
            $activeIssues = Borrow::where('return_date', null)->count();
            $allBorrows = Borrow::with(['user', 'book'])->latest()->paginate(15);
            $recentUsers = User::latest()->take(5)->get();

            return view('dashboard.admin', compact(
                'totalUsers',
                'totalBooks',
                'totalCategories',
                'activeIssues',
                'allBorrows',
                'recentUsers'
            ));
        } else {
            // User dashboard - only their books
            $issuedBooks = $user->borrows()
                ->with('book')
                ->where('return_date', null)
                ->latest()
                ->get();
            
            $returnedBooks = $user->borrows()
                ->with('book')
                ->where('return_date', '!=', null)
                ->latest()
                ->paginate(10);

            return view('dashboard.user', compact('issuedBooks', 'returnedBooks'));
        }
    }
}
