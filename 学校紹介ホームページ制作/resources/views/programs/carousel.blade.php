<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>
 <!-- 카운셀 3개이다. -->
  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <!-- <img class="carousel-img" src="files\programs\{{\App\Program_attachment::whereId(\App\Program::max('id'))->first()->filename}}" alt="1"> -->
      <img class="carousel-img" src="http://127.0.0.1:8000/files3/{{\App\Program_attachment::whereId(\App\Program::max('id'))->first()->filename}}" alt="1">
                                                                      <!-- 파일경로를 프로그램 어텐치먼트 라는 곳에 저장 한 곳에서 id값을 가져와서 제일 최신에 해당하는 아이디를 가져와서  -->
      <div class="carousel-caption">
        <h1 class="carousel-title">{{App\Program::whereId(\App\Program::max('id'))->first()->title}}</h1>
                                    <!-- 타이틀은 가장 최신글의 제목을 가져오갰다 -->
      </div>
    </div>
    <div class="carousel-item">
      <!-- <img class="carousel-img" src="files\programs\{{\App\Program_attachment::whereId(\App\Program::whereNotIn('id',[\App\Program::max('id')])->max('id'))->first()->filename}}" alt="2"> -->
      <img class="carousel-img" src="http://127.0.0.1:8000/files3/{{\App\Program_attachment::whereId(\App\Program::whereNotIn('id',[\App\Program::max('id')])->max('id'))->first()->filename}}" alt="2">
                                                                                                                        <!-- 가장 맥스인 아이디값을 찾아내서 그거를 제거한 것 중에 제일 큰값 -->
      <div class="carousel-caption">
        <h1 class="carousel-title">{{App\Program::whereId(\App\Program::whereNotIn('id',[\App\Program::max('id')])->max('id'))->first()->title}}</h1>
      </div>
    </div>
    <div class="carousel-item ">
      <!-- <img class="carousel-img" src="files\programs\{{\App\Program_attachment::whereId(\App\Program::whereNotIn('id',[\App\Program::max('id'),\App\Program::whereNotIn('id',[\App\Program::max('id')])->max('id')])->max('id'))->first()->filename}}" alt="3"> -->
      <img class="carousel-img" src="http://127.0.0.1:8000/files3/{{\App\Program_attachment::whereId(\App\Program::whereNotIn('id',[\App\Program::max('id'),\App\Program::whereNotIn('id',[\App\Program::max('id')])->max('id')])->max('id'))->first()->filename}}" alt="3">
      <div class="carousel-caption">                                                       <!-- 가장 맥스인 아이디값을 찾아내서 그거를 제거를 2번한 것 중에 제일 큰값 -->
        <h1 class="carousel-title">{{App\Program::whereId(\App\Program::whereNotIn('id',[\App\Program::max('id'),\App\Program::whereNotIn('id',[\App\Program::max('id')])->max('id')])->max('id'))->first()->title}}</h1>
      </div>
    </div>
  </div>

  <!-- Controls 사진이동하는 화살표  -->
  <a class="left carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>