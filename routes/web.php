<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DailyRecordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::delete('/users/{uuid}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/fetch-users', [UserController::class, 'fetchUsers']);
Route::get('/user-count', [UserController::class, 'count']);


Route::get('/daily-records', [DailyRecordController::class, 'index'])->name('dailyrecords.index');

// Route::get('/test-redis', function () {
//     try {
//         \Illuminate\Support\Facades\Redis::set('test_key', 'test_value');
//         $value = \Illuminate\Support\Facades\Redis::get('test_key');
//         return "Redis is working! Retrieved value: " . $value;
//     } catch (\Exception $e) {
//         return "Redis connection failed: " . $e->getMessage();
//     }
// });

// use Illuminate\Support\Facades\Redis;
// Route::get('/test-redis', function () {
//     Redis::set('test_key', 'Hello from Redis');
//     return Redis::get('test_key');
// });

use Illuminate\Support\Facades\Redis;
Route::get('/test-redis', function() {
    try {
        Redis::set('test', 'value');
        $value = Redis::get('test');
        return response()->json(['value' => $value]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Redis connection failed: ' . $e->getMessage()]);
    }
});

