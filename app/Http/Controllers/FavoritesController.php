<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    /**
     * 投稿をお気に入り登録するアクション。
     *
     * @param  $micropostId  投稿のid
     * @return \Illuminate\Http\Response
     */
    public function store(string $micropostId)
    {
        // 認証済みユーザー（閲覧者）が、 micropostIdの投稿をお気に入り登録する
        \Auth::user()->favorite(intval($micropostId));
        // 前のURLへリダイレクトさせる
        return back();
    }

    /**
     * 投稿をお気に入り解除するアクション。
     *
     * @param  $micropostId  投稿のid
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $micropostId)
    {
        // 認証済みユーザー（閲覧者）が、 idのユーザーをアンフォローする
        \Auth::user()->unfavorite(intval($micropostId));
        // 前のURLへリダイレクトさせる
        return back();
    }
    
    public function favorites()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            // お気に入り登録している投稿を取得
            $favoriteMicroposts = $user->favorite_microposts()->orderBy('created_at', 'desc')->paginate(10);
    //dd($favoriteMicroposts);
            $data = [
              'user' => $user,
              'microposts' => $favoriteMicroposts,
            ];
        }
        
        return view('users.favorites', $data);
    }
}