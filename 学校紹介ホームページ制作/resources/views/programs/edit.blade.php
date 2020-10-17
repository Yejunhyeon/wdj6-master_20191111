<div class="edit-form edit{{$program->id}}">
    <div class="create-header">
        <div class="create-title">
            <h1>현지학기제 글 쓰기</h1>
        </div>
        <div class="create-button">
            <label class="btn btn-primary btnCreate" onclick="back()">뒤로 가기</label>   
        </div>
    </div>
    <hr />
    <!-- 인코딩 타입변경-->
    <form id="program_edit_form" action="" method="POST" enctype="multipart/form-data" class="form__program">
        {!! csrf_field() !!}
        @include('programs.partials.editform')
    </form>
    <div class="form-group text-center">
        <label class="btn btn-primary btnCreate" onclick="update({{$program->id}})">저장 하기</label>   
    </div>
</div>