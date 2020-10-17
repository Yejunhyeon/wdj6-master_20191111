<!-- 제목 -->
<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    <label for="title">제목</label>
    <input type="text" name="title" id="title" value="" class="form-control" />
    {!! $errors->first('title', '<span class="form-error">:message</span>') !!}
</div>

<!-- 내용 -->
<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
    <label for="content">내용</label>
    <textarea name="content" id="content" rows="10"
        class="form-control"></textarea>
    {!! $errors->first('content', '<span class="form-error">:message</span>') !!}
</div>

<!-- 첨부파일 -->
<div class="form-group {{ $errors->has('files') ? 'has-error' : '' }}">
    <label for="files">파일</label>
    <input type="file" name="files[]" id="program_file" class="form-control" multiple="multiple" enctype="multipart/form-data"/>
    {!! $errors->first('files', '<span class="form-error">:message</span>') !!}
</div>