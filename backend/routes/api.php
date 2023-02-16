<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MyResourceController;
use App\Http\Controllers\Api\ChannelController;

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

// Route::post('/channels', function (Request $request) {
//     return response()->json([
//         'id' => 1,
//         'uuid' => \Str::uuid(),
//         'name' => 'テストチャンネルの名前',
//         'joined' => true,
//     ]);
// });
Route::prefix('/channels')
    ->name('channels.')
    ->group(function () {
        Route::post('', [ChannelController::class, 'store'])->name('store');
    });
    

Route::middleware(['auth:sanctum'])
    ->name('api.')
    ->group(function () {
        Route::get('/me', [MyResourceController::class, 'me'])->name('me');
        Route::get('/my/channels', [MyResourceController::class, 'channels'])->name('channels');
        Route::post('/my/icons', [MyResourceController::class, 'updateIcons'])->name('updateIcons');
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
