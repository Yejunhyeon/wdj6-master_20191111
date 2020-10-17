<div style="display:none" class="media media__edit__comment">
  <div class="media-body">
      {!! csrf_field() !!}
      {!! method_field('PUT') !!}

      <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
        
        <textarea id ="{{'edit_comment' . $parentId}}"name="content" class="form-control">{{ old('content', $comment->content) }}</textarea>
        {!! $errors->first('content', '<span class="form-error">:message</span>') !!}
        
        <div class="preview__content">
          {!! old('content', '...') !!}
        </div>
      </div>

      <div class="text-right">
        <button type="submit" class="btn btn__update__comment btn-sm btn-primary">
          수정하기
        </button>
      </div>
  </div>
</div>