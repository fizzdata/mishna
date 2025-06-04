<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/', function () {
    return response()->json(['message' => 'API is working']);
});
Route::get('/{family_uid}/perakim', [ApiController::class, 'index'])
    ->name('api.data')
    ->middleware('api'); // Ensure this route is accessible via API middleware

Route::post('/{family_uid}/store', [ApiController::class, 'store'])
    ->name('api.store')
    ->middleware('api'); // Ensure this route is accessible via API middleware
