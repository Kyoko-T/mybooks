<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    //以下追記
    //トップページを表示するアクション
    public function index()
    {
        return view('books.top');
    }

    public function add()
    {
        return view('admin.books.create');
    }

    public function create(Request $request)
    {
        //admin/books/createにリダイレクトする
        return redirect('admin/books/create');
    }
}
