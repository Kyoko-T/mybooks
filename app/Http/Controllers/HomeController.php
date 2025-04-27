<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('books.top');
    }

    /**
     * 書籍検索処理
     *
     */
    public function search(Request $request)
    {
        //検索条件が未入力のときはトップページに戻す
        if($request->title == ""){
            return view('books.top');   
        }

        //入力された検索条件をURLに埋め込む
        $query = urlencode('title=' . $request->title); // 検索キーワードと条件
        $url = 'https://iss.ndl.go.jp/api/sru?operation=searchRetrieve&query=' . $query . '&recordSchema=dcndl';
        
        //APIの実行。取得された本情報を$xmlに格納する
        $xml = file_get_contents($url);

        //$xmlがfalseのときは本情報の取得に失敗
        if ($xml === false) {
            echo "データの取得に失敗しました。\n";
        } else {
            // TODOで以下の処理は修正が必要
            // XMLレスポンスを解析する処理
            $xmlDoc = new \DOMDocument();
            $xmlDoc->loadXML($xml);
        
            $records = $xmlDoc->getElementsByTagName('record');
            foreach ($records as $record) {
                $title = '';
                $creator = '';
                $publisher = '';
                $isbn = '';
        
                $titles = $record->getElementsByTagName('title');
                if ($titles->length > 0) {
                    $title = $titles->item(0)->textContent;
                }
        
                $creators = $record->getElementsByTagName('creator');
                if ($creators->length > 0) {
                    $creator = $creators->item(0)->textContent;
                }
        
                $publishers = $record->getElementsByTagName('publisher');
                if ($publishers->length > 0) {
                    $publisher = $publishers->item(0)->textContent;
                }
        
                $identifiers = $record->getElementsByTagName('identifier');
                foreach ($identifiers as $identifier) {
                    if ($identifier->getAttribute('type') === 'isbn') {
                        $isbn = $identifier->textContent;
                        break;
                    }
                }
        
            }            
        return view('books.top');
        }
    } 
       
}
