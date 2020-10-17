@section('content')
@parent
<div style="display:none" class="new_article">

    <h1>새 포럼 글 쓰기</h1>
    <form action ='', id = "article_create_form" method="POST" enctype="multipart/form-data" class="form__article">

        <hr />
        {!! csrf_field() !!}
        @include('articles.partial.form')
    </form>

        <div class="form-group text-center">
            <button class="btn btn-primary btn__save__article">
                저장하기
            </button>
        </div>
</div>
@stop