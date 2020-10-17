

<div class="media item__comment {{ $isReply ? 'sub' : 'top' }}" data-id= "{{ $comment->id }}" id="comment_{{ $comment->id }}">
  @include('users.partial.avatar', ['user' => $comment->user, 'size' => 32])

  <div class="media-body">
    <h5 class="media-heading">
        {{ $comment->user->name }}
      <small>
        {{ $comment->created_at->diffForHumans() }}
      </small>
    </h5>

    <div class="content__comment">
      {!! $comment->content !!}
    </div>

    <div class="action__comment">
      @if ($currentUser)
        <button class="btn__vote__comment btn-success" data-vote="up" title="좋아요">
          <i class="fa fa-chevron-up"></i>
          <span>좋아요{{ $comment->up_count }}</span>
        </button>

        &nbsp;

        <button class="btn__vote__comment btn-danger" data-vote="down" title="싫어요"}>
          <i class="fa fa-chevron-down"></i> <span>싫어요{{ $comment->down_count }}</span>
        </button>
        
      @endif
    </div>
    <div class="action__comment">
      @can('update', $comment)
        <button class="btn__delete__comment"><i class="fa fa-trash-o"></i>댓글 삭제</button> •
        <button class="btn__edit__comment"><i class="fa fa-pencil"></i>댓글 수정</button> •
      @endcan

      <!-- textarea를 토글 시켜주는 버튼(답글) -->
        <button class="btn__reply__comment">
          답글 쓰기
        </button>
    </div>
    @include('comments.partial.create', ['parentId' => $comment->id])

    <!-- 댓글 수정 -->
    @can('update', $comment)
      @include('comments.partial.edit')
    @endcan


    <!-- 대댓글 출력 -->
    @forelse ($comment->replies as $reply)
      @include('comments.partial.comment', [
        'comment' => $reply,
        'isReply' => true,
      ])
    @empty
    @endforelse
  </div>
</div>