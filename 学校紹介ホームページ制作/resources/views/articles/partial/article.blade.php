<!-- 게시판 제목, 작성자, 날짜 등을 보여줌 -->
<div class="media{{$article->id}}">
    @include('users.partial.avatar', ['user' => $article->user])
    <div class="media-body">
        <h4 class="meida-heading">
            <h6>[ {{$article->id}} ] 번째 게시글
                &nbsp; 
                &nbsp; 
                <i class="text-muted">
                    <i class="fa fa-user"></i> {{ $article->user->name}} ({{$article->user->email}})
                    &nbsp; 
                    <i class="text-right">
                        <i class="fa fa-clock-o"></i> {{$article->created_at->format('Y-m-d')}}  
                    </i>
                </i>
            </h6>    
            <button class="btn__show__article btn btn-info" data-id = "{{$article->id}}">
                {{$article->title}} <!--버튼형식 -->
            </button>
        </h4>
        <div class="divdiv">
        @if($viewName === 'articles.index')
        @include('tags.partial.list',['tags' => $article->tags])
        @endif 

        @if($viewName === 'articles.show')
        @include('attachments.partial.list', ['attachments' => $article->attachments])
        @endif  <!-- 첨부파일, 댓글 보여주는것  -->
        </div>
    </div>
</div>