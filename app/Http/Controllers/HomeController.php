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
        $books = Book::all();
        //dd($books);

        
        return view('books.top', [
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
        