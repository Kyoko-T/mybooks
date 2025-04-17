<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    //以下追記
    public function add()
    {
        return view('admin.books.create');
    }
}
