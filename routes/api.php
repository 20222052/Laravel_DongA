<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiCategoryController;
use Illuminate\Support\Facades\Http;

Route::get('/transactions', function (Request $request) {
    $accountNumber = '2004020423'; 
    $limit = 20;
    $bearerToken = 'MBNOXEPUXNWMJ0AG3C8FFTSFV2BGCLI9KVTZ7QSS86TRRGGUIBTDPHWXFPOOZY57'; 

    $response = Http::withHeaders([
        'Authorization' => "Bearer $bearerToken",
        'Content-Type' => 'application/json',
    ])->get("https://my.sepay.vn/userapi/transactions/list", [
        'account_number' => $accountNumber,
        'limit' => $limit
    ]);

    return $response->json();
});

Route::get('categories',[ApiCategoryController::class, 'index'])->middleware('auth:sanctum');
Route::post('categories',[ApiCategoryController::class, 'store']);

Route::get('categories/{category}',[ApiCategoryController::class, 'show']);
Route::put('categories/{category}',[ApiCategoryController::class, 'update']);

Route::delete('categories/{category}',[ApiCategoryController::class, 'destroy']);

Route::post('/login',[ApiCategoryController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
