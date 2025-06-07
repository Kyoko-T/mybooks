{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')

{{-- admin.blade.phpの@yield('title')に'トップページ'を埋め込む --}}
@section('title', 'トップページ')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>絵本検索</h2>

                {{-- このフォームの中にあるデータを、searchというURLに、GET形式で送信 --}}
                <form action="{{ route('search') }}" method="get">
                    

                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-10">
                        <input type="text" class="form-control" name="title" value="{{ old('title', $keyword ?? '') }}">
                        </div>
                    </div>

                    
                    <input type="submit" class="btn btn-primary" value="検索">
                </form>

                {{-- 検索結果の表示 --}}
                @if (!empty($searched))
                    <div class="mt-4">
                        <h3>検索結果</h3>

                        @if ($books->isEmpty())
                            <p>検索結果は0件でした。</p>
                        @else
                            <ul class="list-group">
                                @foreach ($books as $book)
                                    <li class="list-group-item">
                                        <strong>タイトル:</strong> {{ $book->title ?? '不明' }}<br>
                                        <strong>説明文:</strong> {{ $book->caption ?? '不明' }}<br>
                                        <strong>キーワード:</strong> {{ $book->keyword ?? '不明' }}<br>
                                        <strong>著者:</strong> {{ $book->creator ?? '不明' }}<br>
                                        <strong>出版社:</strong> {{ $book->publisher ?? '不明' }}<br>
                                        <strong>ISBN:</strong> {{ $book->isbn ?? 'なし' }}<br>

                                        @if ($book->image_path)
                                            <img src="{{ asset('storage/image/' . $book->image_path) }}" alt="{{ $book->title }}" style="max-width: 200px;">
                                        @else
                                            <p>画像なし</p>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
