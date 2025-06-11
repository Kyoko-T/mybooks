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

    //本の一覧画面（管理者用）を作成
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != null) {
            // 検索されたら検索結果を取得する
            $posts = Book::where('title', $cond_title)->get();
        } else {
            // それ以外はすべての本の情報を取得する
            $posts = Book::all();
        }    
        return view('admin.books.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    // 以下を追記
    public function delete(Request $request)
    {
        // 該当するBook Modelを取得
        $book = Book::find($request->id);

        // 削除する
        $book->delete();

        return redirect('admin/books/');
    }
    
    public function edit(Request $request)
    {
        $book = Book::find($request->id);
        if (empty($book)) {
            abort(404);
        }
        return view('admin.books.edit', ['book_form' => $book]);
    }

    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, Book::$rules);
        // Book Modelからデータを取得する
        $book = Book::find($request->id);

        // 送信されてきたフォームデータを格納する
        $book_form = $request->all();

        if ($request->remove == 'true') {
            $book_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $book_form['image_path'] = basename($path);
        } else {
            $book_form['image_path'] = $book->image_path;
        }
        
        unset($book_form['image']);
        unset($book_form['remove']);
        unset($book_form['_token']);

        // 該当するデータを上書きして保存する
        $book->fill($book_form)->save();

        return redirect('admin/books');
    }
}
