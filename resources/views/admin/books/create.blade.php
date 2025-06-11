{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'書籍情報新規作成'を埋め込む --}}
@section('title', '書籍情報新規作成')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>本の情報を新しく登録する</h2>
                <form action="{{ route('admin.books.create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">説明文</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="caption" rows="5">{{ old('caption') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">キーワード</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="keyword" value="{{ old('keyword') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">著者</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="creator" value="{{ old('creator') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">出版社</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="publisher" value="{{ old('publisher') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">ISBN</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="isbn" value="{{ old('isbn') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                    @csrf
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
                <div class="form-group row mt-4">
                    <div class="col-md-6">
                        <a href="{{ route('admin.books.index') }}" class="btn btn-secondary" role="button">一覧に戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection