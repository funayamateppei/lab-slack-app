<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Api\MyIconStoreRequest;


class MyResourceController extends Controller
{
    public function me(Request $request)
    {
        // これで認証済みのリクエストしている人のUserインスタンスが取得できる
        $me = Auth::user();
        // 別に以下のように書いてもOK（が以下の書き方を簡単に書く方法が↑です）
        // $myId = Auth::id();
        // $me = User::find($myId);
        // とりあえず、そのままレスポンスします（後ほど整形します）
        return response()->json($me);
    }
    
    public function channels(Request $request)
    {
        $channels = Channel::with('users')
            ->whereHas('users', function (Builder $query) {
                $query->where('user_id', Auth::id());
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($channels);
    }

    public function updateIcons(MyIconStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            $savePath = $request->image->store('users/images');
            try {
                Auth::user()
                ->fill([
                    'icon_path' => $savePath,
                ])
                ->save();
                } catch (\Exception $e) {
                    // DBでエラー発生 保存したファイルを削除
                    Storage::delete($savePath);
                    throw $e;
                }
        });
        return response()->json(
            route('web.users.image', ['userId' => Auth::id()])
        );
    }
}

