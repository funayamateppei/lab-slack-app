<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/channels', function (Request $request) {
    return response()->json([
        'id' => 1,
        'uuid' => \Str::uuid(),
        'name' => 'テストチャンネルの名前',
        'joined' => true,
    ]);
});

Route::get('/me', function () {
    return response()->json([
        "id" => 1,
        "nickname" => "ニックネーム",
        "email" => "user@example.com",
        "icon_url" => "http://localhost/users/image/1",
    ]);
});

Route::post('/my/icons', function () {
    return 'http://localhost/users/image/1';
});

Route::get('/my/channels', function () {
    return response()->json([
        [
            'id' => 1,
            'uuid' => \Str::uuid(),
            'name' => 'テストチャンネルの名前1',
            'joined' => true,
        ],
        [
            'id' => 2,
            'uuid' => \Str::uuid(),
            'name' => 'テストチャンネルの名前2',
            'joined' => false,
        ],
    ]);
});

Route::delete('/channels/{uuid}/messages/{id}', function ($uuid, $id) {
    return response()->noContent();
});