@extends('layouts.app')

@section('content')
@php $viewName = 'articles.show'; @endphp
<div class ="row container__article">

    <div class="list__article">
        <article class ="article_show" data-id="{{ $article->id }}">
            <h3>게시글
            </h3> 
            @include('articles.partial.article', compact('article'))
            <div>
                <p>{!! $article->content !!}</p>
            </div>
        </article>

        <div class="text-center action__article">
            @can('update', $article)
            <button class="btn btn-primary button__edit__articles">
                <i class="fa fa-pencil"></i>
                글 수정
            @endcan
        
            @can('delete', $article)
            <button class="btn btn-danger button__delete__articles">
                <i class="fa fa-trash-o"></i>
                글 삭제
            </button>
            @endcan
            <button class="btn btn-default button__list__articles">
                <i class="fa fa-list"></i>
                글 목록
            </button>
        </div>

        <div class="container__comment">
            @include('comments.index')
        </div>
    </div>
</div>
@stop

