@extends('layouts.app')

@section('content')
<div class="page-header">
    <h4>
        <a href="{{ route('articles.index') }}">
            포럼
        </a>
        <small>
            / 글 수정
            / {{ $article->title }}
        </small>
    </h4>
</div>
    <form action ='', id = "article_edit_form{{$article->id}}" method="PUT" enctype="multipart/form-data" class="form__article">
        <hr />
        {!! csrf_field() !!}
        @include('articles.partial.form')
    </form>

    <div class="form-group text-center">
        <button class="button__update__articles btn btn-success">
            수정 하기
        </button>
    </div>
@stop
