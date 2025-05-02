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
        //dd($request->title);
        
        //検索条件が未入力のときはトップページに戻す
        if($request->title == ""){
            $books = [];
            return view('books.top', compact('books'));   
        }

        //入力された検索条件をURLに埋め込む
        $query = 'title="' . $request->title .'"'; // 検索キーワードと条件
        $url = 'https://iss.ndl.go.jp/api/sru?operation=searchRetrieve&query=' . urlencode($query) . '&recordSchema=dcndl&maximumRecords=10';
        
        //APIの実行。取得された本情報を$xmlに格納する
        $xml = file_get_contents($url);
        $data = simplexml_load_string($xml);
        
        $data->registerXPathNamespace('srw', 'http://www.loc.gov/zing/srw/');
        $data->registerXPathNamespace('dc', 'http://purl.org/dc/elements/1.1/');
        $data->registerXPathNamespace('dcndl', 'http://ndl.go.jp/dcndl/terms/');
        $data->registerXPathNamespace('xsi', 'http://www.w3.org/2001/XMLSchema-instance');

        $records = $data->xpath('//srw:recordData');

        $message = "";

        foreach ($records as $record) {
            $record->registerXPathNamespace('dc', 'http://purl.org/dc/elements/1.1/');
            $record->registerXPathNamespace('dcndl', 'http://ndl.go.jp/dcndl/terms/');
            $record->registerXPathNamespace('xsi', 'http://www.w3.org/2001/XMLSchema-instance');

            $isbnNodes = $record->xpath('.//dc:identifier[@xsi:type="dcndl:ISBN"]');
            if (empty($isbnNodes)) {
                continue; // ISBNがなければスキップ
            }

            $title = $record->xpath('.//dc:title')[0] ?? '';
            $creator = $record->xpath('.//dc:creator')[0] ?? '';
            $publisher = $record->xpath('.//dc:publisher')[0] ?? '';
            $date = $record->xpath('.//dc:date')[0] ?? '';
            // ISBNだけを抽出（xsi:type="dcndl:ISBN"）
            $isbnNodes = $record->xpath('.//dc:identifier[@xsi:type="dcndl:ISBN"]');
            $isbn = isset($isbnNodes[0]) ? (string)$isbnNodes[0] : '';
            // 結果出力
            
            $message = $isbn;
            
            //dd($message);
        }
        dd($xml);
        $xmlObj = simplexml_load_string($xml);
        //dd($xmlObj);
        //$exResData = simplexml_load_string($xmlObj->records);
        // $xmlObj->records[0] が SimpleXMLElement の要素だと仮定
        $recordData = (string) $xmlObj->records->record[1]->recordData;
        // XMLとして再パース
        $innerXml = simplexml_load_string($recordData);

        // 利用可能な名前空間を取得
        $namespaces = $innerXml->getNamespaces(true);

        // "dc" 名前空間を使って要素にアクセス
        $dc = $innerXml->children($namespaces['dc']);

        //dd($xml,$dc,$xmlObj);
        

        // XMLとして再パース
        $innerXml = simplexml_load_string($recordData);

        //dd($innerXml,$recordData);
      
        $books = [];

        //$xmlがfalseのときは本情報の取得に失敗
        if ($xml === false) {
            echo "データの取得に失敗しました。\n";
        } else {
                        
            // ＜ここで正規表現を使って <recordData>～</recordData> を抜き出す＞
            preg_match_all('/<recordData>(.*?)<\/recordData>/s', $xml, $matches);
            
            //dd($matches);
            // $matches[1]に、抜き出した結果が入っている
                       
            if (isset($matches[1])) {
                foreach ($matches[1] as $mk => $mv) {
                // ①抜き出した結果をhtmlspecialchar_decode()する
                $entity = htmlspecialchars_decode($mv, ENT_QUOTES);
                // dcとか邪魔なのでどかす
                $entity = str_replace('dc:', '', $entity);
                // ②タグ要素でkey=>valueの形にする
                $pattern = '/<(\w+)>(.*?)<\/\1>/';  // \1 は最初の () の中身と同じものを指す
                preg_match_all($pattern, $entity, $match2);
        
                    // 配列に変換
                    foreach ($match2[1] as $index => $key) {
                        $books[$mk][$key] = $match2[2][$index];
                    }
                }
            }
        //dd($books);

        }    
            return view('books.top',compact('books'));
    } 
}
