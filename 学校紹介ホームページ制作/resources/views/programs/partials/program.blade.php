<div class="card card-program program{{$program->id}}" onclick="show({{$program->id}})" data-id="{{$program->id}}">
    <div class="card-imgbox col-md-4">
        <!-- <img class="cardimg" src="files\programs\{{\App\Program_attachment::whereId($program->id)->first()->filename}}" alt="program-img"> -->
        <img class="cardimg" src="http://127.0.0.1:8000/files3/{{\App\Program_attachment::whereId($program->id)->first()->filename}}" alt="program-img">
    </div>
    <div class="card-body col-md-8">
        <h1 class="card-title">{{$program->title}}</h1>
        <div class="card-information">
            <p class="card-information-name col-md-6">작성자 : {{$program->user->name}}</p> 
            <p class="card-information-time col-md-6">작성날짜 : {{$program->created_at->format('Y-m-d')}}</p>
        </div>
        <div class="card-content">
            <p>{{$program->content}}</p>
        </div>
    </div>
</div>