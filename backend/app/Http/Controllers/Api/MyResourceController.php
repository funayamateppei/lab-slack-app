<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
