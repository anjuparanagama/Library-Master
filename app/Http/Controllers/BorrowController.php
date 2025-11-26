<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function showIssueForm()
    {
        $users = User::all();
        $books = Book::where('stock', '>', 0)->get();
        return view('borrow.issue', compact('users', 'books'));
    }

    public function storeIssue(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::find($validated['book_id']);

        if ($book->stock <= 0) {
            return redirect()->back()->with('error', 'Book is out of stock!');
        }

        // Create borrow record
        Borrow::create([
            'user_id' => $validated['user_id'],
            'book_id' => $validated['book_id'],
            'issue_date' => now(),
        ]);

        // Decrease stock
        $book->decrement('stock');

        return redirect()->route('books.index')->with('success', 'Book issued successfully!');
    }

    public function showReturnForm(Request $request)
    {
        $users = User::all();
        $issuedBooks = [];
        $totalIssued = Borrow::whereNull('return_date')->count();

        if ($request->has('user_id') && $request->user_id) {
            $issuedBooks = Borrow::where('user_id', $request->user_id)
                ->whereNull('return_date')
                ->with('book')
                ->get();
        }

        return view('borrow.return', compact('users', 'issuedBooks', 'totalIssued'));
    }

    public function storeReturn(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:borrows,id',
        ]);

        $borrow = Borrow::find($validated['book_id']);

        if (!$borrow || $borrow->return_date !== null) {
            return redirect()->back()->with('error', 'Book already returned or invalid record!');
        }

        // Update return date
        $borrow->update(['return_date' => now()]);

        // Increase stock
        $borrow->book->increment('stock');

        return redirect()->route('borrow.logs')->with('success', 'Book returned successfully!');
    }

    public function showLogs(Request $request)
    {
        $query = Borrow::with('user', 'book');

        if ($request->has('user_id') && $request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->has('action') && $request->action) {
            if ($request->action === 'issued') {
                $query->whereNull('return_date');
            } elseif ($request->action === 'returned') {
                $query->whereNotNull('return_date');
            }
        }

        $borrows = $query->orderBy('issue_date', 'desc')->get();
        $users = User::all();
        
        $totalIssues = Borrow::whereNull('return_date')->count();
        $totalReturns = Borrow::whereNotNull('return_date')->count();
        $booksInCirculation = Borrow::whereNull('return_date')->count();

        return view('borrow.logs', compact('borrows', 'users', 'totalIssues', 'totalReturns', 'booksInCirculation'));
    }
}
