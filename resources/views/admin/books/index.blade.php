@extends('layouts.admin')
@section('title', '絵本リスト')

@section('content')
    <div class="container">
        <div class="row">
            <h2>登録した絵本の一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('admin.books.add')  }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ route('admin.books.index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                        </div>
                        <div class="col-md-2">
                            @csrf
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">タイトル</th>
                                <th width="40%">説明文</th>
                                <th width="20%">キーワード</th>
                                <th width="10%"></th>
                                                                      
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $books)
                                <tr>
                                    <th>{{ $books->id }}</th>
                                    <td>{{ Str::limit($books->title, 100) }}</td>
                                    <td>{{ Str::limit($books->caption, 250) }}</td>
                                    <td>{{ Str::limit($books->keyword, 100) }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ route('admin.books.edit', ['id' => $books->id]) }}" class="text-primary">編集</a>
                                        </div>
                                        <div>
                                            <a href="{{ route('admin.books.delete', ['id' => $books->id]) }}" class="text-danger">削除</a>
                                        </div>
                                    </td>    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection