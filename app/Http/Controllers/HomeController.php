<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class HomeController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Bookモデルを使って、booksテーブルの全レコードを取得
        $books = Book::all();
        //dd($books);

        // books/top.blade.php にデータを渡して画面を表示
        return view('books.top', [
            // 絵本データ（全件）をビューに渡す
            'books' => $books,
            'searched' => true
        ]);
    }

    /**
     * 書籍検索処理
     *
     */
    public function search(Request $request)
    {
        // ユーザーからの検索キーワードを取得
        $keyword = $request->input('title');

        // 検索キーワードが空なら全件表示にする
        if (empty($keyword)) {
            $books = Book::all();
        } else {
            // titleカラムに部分一致する本を取得
            $books = Book::where('title', 'like', '%' . $keyword . '%')->get();
       
        }

        return view('books.top', [
            'books' => $books,
            'keyword' => $keyword,
            'searched' => true 
        ]);
        
    }
}
        