<?php

namespace App\Http\Controllers;

use App\Models\Message;

use Illuminate\Http\Request;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $messages = Message::all();

    return view('messages.index', [
            'messages' => $messages,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|max:255',   // 追加
            'content' => 'required|max:255',
        ]);

        // メッセージを作成
        $message = new Message;
        $message->title = $request->title;    // 追加
        $message->content = $request->content;
        $message->save();

        // トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $message = Message::findOrFail($id);

        // メッセージ詳細ビューでそれを表示
        return view('messages.show', [
            'message' => $message,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         // idの値でメッセージを検索して取得
        $message = Message::findOrFail($id);

        // メッセージ編集ビューでそれを表示
        return view('messages.edit', [
            'message' => $message,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|max:255',   // 追加
            'content' => 'required|max:255',
        ]);

        // idの値でメッセージを検索して取得
        $message = Message::findOrFail($id);
        // メッセージを更新
        $message->title = $request->title;    // 追加
        $message->content = $request->content;
        $message->save();

        // トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // idの値でメッセージを検索して取得
        $message = Message::findOrFail($id);
        // メッセージを削除
        $message->delete();

        // トップページへリダイレクトさせる
        return redirect('/');
    }
}
