<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BookController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', function (Request $request) {
    $user = User::where('email', $request->email)->first();
    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }
    $token = $user->createToken('api-token')->plainTextToken;
    return response()->json(['token' => $token]);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/books', [BookController::class, 'index'])->middleware('role:admin,editor,viewer');
    Route::post('/books', [BookController::class, 'store'])->middleware('role:admin,editor');
    Route::get('/books/{id}', [BookController::class, 'show'])->middleware('role:admin,editor,viewer');
    Route::put('/books/{id}', [BookController::class, 'update'])->middleware('role:admin,editor');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->middleware('role:admin');
});