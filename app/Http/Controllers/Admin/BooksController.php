<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Bookモデルを読み込む
use App\Models\Book;
//画像アップロードに必要
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    //以下追記
    public function index()
    {
        return view('books.top', ['books' => $books]);
    }

    public function add()
    {
        return view('admin.books.create');
    }

    public function create(Request $request)
    {
        //バリデーション
        $this->validate($request, Book::$rules);

        //フォームから送られてきたデータを取得
        $form = $request->all();

        //画像が送信されてきたら保存
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            //ファイル名だけ保存
            $form['image_path'] = basename($path);
        } else {
            $form['image_path'] = null;
        }

        //不要なトークンなどを削除
        unset($form['_token']);
        //file本体はいらないので消す
        unset($form['image']);
        

        //データベースに保存
        $book = new Book();
        $book->fill($form)->save();

        //フォームに戻る
        return redirect('admin/books/create')->with('success', '本を登録しました');

    }

   
}
