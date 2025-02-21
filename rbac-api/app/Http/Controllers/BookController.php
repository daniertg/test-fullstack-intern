<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
{
    return Book::all();
}

public function store(Request $request)
{
    $validated = $request->validate([
        'judul' => 'required|string',
        'penulis' => 'required|string',
        'tahun_terbit' => 'required|integer',
        'deskripsi' => 'required|string',
    ]);

    $book = Book::create($validated);
    return response()->json($book, 201);
}

public function show($id)
{
    return Book::findOrFail($id);
}

public function update(Request $request, $id)
{
    $book = Book::findOrFail($id);
    $book->update($request->all());
    return response()->json($book);
}

public function destroy($id)
{
    $book = Book::findOrFail($id);
    $book->delete();
    return response()->json(['message' => 'Deleted successfully']);
}
}
