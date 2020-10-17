<div   
style="{{ isset($parentId) ? 'display:none' : '' }}" value = "aa"
class="media media__create__comment {{ isset($parentId) ? 'sub' : 'top' }}">

  @include('users.partial.avatar', ['user' => $currentUser, 'size' => 32])

  <div  class="media-body">
      {!! csrf_field() !!}

      <!-- 답글이면 부모 아이디를 숨김 -->
      @if(isset($parentId))
        <input type="hidden" name="parent_id" value="{{ $parentId }}">
      @endif
      
      <!-- content필드에 대한 에러 메시지가 존재하는지의 여부 -->
      <div  class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
        <!-- 답글, 댓글 textarea-->
        <textarea id="{{isset($parentId) ? $article->id . 'new_comment' . $parentId      :     $article->id . 'new_comment'}}" name="content" class="form-control">{{ old('content') }}</textarea>
        {!! $errors->first('content', '<span class="form-error">:message</span>') !!}
      </div>

      <div class="text-right">
        <button class="btn btn__create__comment btn-primary btn-sm">
          전송하기
        </button>
      </div>
  </div>
</div>