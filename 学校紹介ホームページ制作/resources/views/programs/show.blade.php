<div class="show-form{{$program->id}} show">
    <div class="show-header col-md-11">
        <h1 class="show-title">{{$program->title}}</h1>
        <hr>
        <div class="show-information">
            <p class="col-md-6">작성자 : {{$program->user->name}}</p>
            <p class="col-md-6">작성날짜 : {{$program->created_at}}</p>
        </div>
        <hr>
    </div>
    <div class="show-body col-md-11">
        <div class="show-imgbox col-md-8">
            <img class="show-img" src="http://btrya23.iptime.org:8000/files3/{{\App\Program_attachment::whereId($program->id)->first()->filename}}" alt="program-img">
        </div>
        <hr>
        <div class="show-content col-md-11">
            <p>{{$program->content}}</p>
        </div>
        <hr>
        <div class="show-buttons col-md-8">
            <label class="btn btn-primary btnCreate col-md-3" onclick="edit({{$program->id}})">수정 하기</label>  
            <label class="btn btn-primary btnCreate col-md-3" onclick="dorp({{$program->id}})">삭제 하기</label>  
            <label class="btn btn-primary btnCreate col-md-3" onclick="back()">뒤로 가기</label>  
        </div>
    </div>
</div>