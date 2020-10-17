@extends('layouts.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div>
        <div class="page-header">
            <div class="program-title">
                <h2>현지학기제</h2>
            </div>
            <div class="program-button">
                <label class="btn btn-primary btnCreate" onclick="create()">새글 쓰기</label>     
            </div>
            <hr>
        </div>
        @if($program->count()>3)    
            <div class="carousel-divbox">
                <div class="carousel-div">
                    @include('programs.carousel', compact('program')) 
                <!-- carousel을 불러온다 -->
                </div>
            </div>
        @endif
        <div class="program-div">
            @forelse ($programs as $program)
               @include('programs.partials.program', compact('program'))
            @empty
                <p class="text-center text-danger">
                    글이 없습니다.     
                </p>
            @endforelse
            @if($programs->count())
                <div class="text-center program-paginator">
                    <div class="paginator">
                        {!! $programs->appends(request()->except('page'))->render() !!}
                    </div>
                </div>
            @endif
        </div>
        <div class="create-form">
            @include('programs.create')
        </div>
        <div class="edit-div">
            @forelse ($programs as $program)
                @include('programs.edit',compact('program'))
            @empty
            @endforelse
        </div>
        <div class="show-divbox">
            <div class="show-div">
                @forelse ($programs as $program)
                    @include('programs.show', compact('program'))
                @empty
                @endforelse
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
        $('#carousel-example-generic').carousel();
        $('.carousel').carousel({interval: 2000});

        function create(){
            console.log('create form 호출');
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                type:'GET',
                url: '/programs/'+'create',
                data: {},
                error:function(request,status,error){
                    alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                },
            }).then(function(){    
                $('.program-div').css("display","none");
                $('.create-form').css("display","block");
                $('.page-header').css("display","none");
                $('.carousel-div').css("display","none");
                $(".form-control").val("");
            });
            if(!'{{auth()->user()}}'){
                alert("로그인 한 유저만 글 작성이 가능합니다");
                return;
            }
        }

        function back(){
            $('.program-div').css("display","block");
            $('.create-form').css("display","none");
            $('.page-header').css("display","block");
            $('.carousel-div').css("display","block");
            $(`.show`).css("display","none");
            $(`.edit-form`).css("display","none");
        }   

        function show(program_id){
            console.log('show-form 호출');
            $.ajax({
                type:'GET',
                url: `/programs/${program_id}`,
                data: program_id,
                error:function(request,status,error){
                    alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                },
            }).then(function(e){  
                $('.program-div').css("display","none");
                $('.create-form').css("display","none");
                $('.page-header').css("display","none");
                $('.carousel-div').css("display","none");
                $(`.show`).css("display","none");
                // $(`.show-form${program_id}`).css("display","none");
                $(`.show-form${program_id}`).css("display","block");  // $ 제이쿼리  show.blade.php 
            });
        }

        function store(){
            var form = $('#program_create_form')[0];
            var data = new FormData(form);
            $.ajax({
                type:'POST',
                url: 'programs',
                data: data,
                processData:false,
                contentType:false,
            }).then(function(){    
                $('.program-div').load('/programs .program-div').css("display","block");
                $('.create-form').css("display","none");
                $('.page-header').css("display","block");
                $(`.show-divbox`).load('/programs .show-div');
                $('.carousel-divbox').load('/programs .carousel-div').css("display","block");
            });
        }

        function dorp(program_id){
            if(confirm('글을 삭제합니다.')){
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: "DELETE",
                    url: `/programs/${program_id}`,
                    data: program_id,
                    error:function(request,status,error){
                    alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                },
                }).then(function(program){  
                    console.log(program); 
                    $('.program-div').load('/programs .program-div').css("display","block");
                    $('.create-form').css("display","none");
                    $('.page-header').css("display","block");
                    $(`.show-divbox`).load('/programs .show-div');
                    $('.carousel-divbox').load('/programs .carousel-div').css("display","block");
                });
            }
        }
        function edit(program_id){
            $.ajax({
                type: "get",
                url: `/programs/${program_id}/edit`,
                data: program_id,
                error:function(request,status,error){
                alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
                },
            }).then(function(){  
               
                $('.program-div').load('/programs .program-div').css("display","none");
                $(`.edit-form`).css("display","none");
                $(`.edit${program_id}`).css("display","block");  //#아이디고 . class다 
                $('.page-header').css("display","none");
                $(`.show-divbox`).load('/programs .show-div');
                $('.carousel-divbox').load('/programs .carousel-div').css("display","none");
                
            });
        }
        function update(program_id){
            var form = $('#program_edit_form')[0];  // 수정한 내용 값들
            var data = new FormData(form);
            console.log(form);
            data.append('_method','PUT');
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                type:'POST',
                url: `/programs/${program_id}`,
                data: data,
                processData:false,
                contentType:false,
            }).then(function(){    
                $('.program-div').load('/programs .program-div').css("display","block");
                $('.create-form').css("display","none");
                $('.page-header').css("display","block");
                $(`.show-divbox`).load('/programs .show-div');  // 수정한 부분을 봐꿔치기해서 보여주는 부분  /programs 부분만 봐꾸겠다.
                $(`.edit-form`).css("display","none");
                $('.carousel-divbox').load('/programs .carousel-div').css("display","block");
            });
        }
    </script>
@stop
@section("style")
    <style>
        .create-header{
        margin-top:15px;
        }
        .program-title{
        display: inline-block;
        margin: 5px !important;
        }
        .create-title{
        margin-top:auto;
        margin-bottom:auto;
        display: inline-block;
        }
        .program-button{
        float: right;
        display: inline-block;
        margin: 5px !important;
        }
        .create-button{
        margin-top:auto;
        margin-bottom:auto;
        float: right;
        display: inline-block;
        margin: 5px !important;
        }
        .card {
        position: relative;
        display: -webkit-box;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.125);
        border-radius: 0.25rem;
        margin-bottom:10px;
        overflow:hidden;
        }
        .card-imgbox{
        max-height: 250px;
        margin: 5px;
        }
        .cardimg{
        margin: 5px;
        max-width: 100%;
        width:100%;
        border-radius: 0.25rem;
        }
        .card-body {
        margin: 5px;
        -webkit-box-flex: 1;
                flex: 1 1 auto;
        min-height: 1px;
        max-height: 250px;
        padding: 1.25rem;
        overflow:hidden;
        }
        .card-information{
        display: flex;
        margin-bottom:10px;
        margin-left:0;
        overflow:hidden;
        }
        .card-information-name{
        margin-left:-2%;
        margin-top:auto;
        margin-bottom:auto;
        overflow:hidden;
        }
        .card-information-time{
        margin-left:-2%;
        margin-top:auto;
        margin-bottom:auto;
        overflow:hidden;
        }
        .card-content{
            max-height:100px;
            overflow:hidden;
        }
        .create-form{
            display:none;
        }
        .program-paginator{
            margin:10px 0 0 0;
        }
        .paginator{
            display:inline-block;
            margin:0 auto;
        }
        .carousel-div{
            border: 4px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
            margin-bottom:20px;
        }
        .carousels{
            position: relative;
        }
        .carousels-inner{
            position: relative;
            width: 100%;
            overflow: hidden;
        }
        .carousel-item{
            text-align:center;
            background-color:black;
        }
        .carousel-img{
            margin-top:5px;
            margin-bottom:5px;
            border-radius: 0.5rem;
            max-height:500px;
            max-width: 100%;
        }
        .carousel-title{
            font-size:5em;
            overflow:hidden;
            /* max-width:50%; */
            margin-bottom: 100px;
            color:white;
            font-weight: 800;
            text-align: center;
            text-shadow: 0 0 5px black;
        }
        .show-div{
            margin: 1px;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
        }
        .show-form{
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
            display:none;
        }
        .show{
            display:none;
        }
        .show-header{
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
            overflow:hidden;
            margin-top:10px;
            margin-left:auto;
            margin-right:auto;
        }
        .show-body{
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
            overflow:hidden;
            margin-top:10px;
            margin-bottom:10px;
            margin-left:auto;
            margin-right:auto;
        }
        .show-title{
            overflow:hidden;
            margin-top:10px;
            margin-left:10px;
        }
        .show-information{
            display: flex;
            margin-bottom:10px;
            margin-left:0;
            overflow:hidden;
        }
        .show-content{
            margin-left:auto;
            margin-right:auto;
            margin-left:10px;
        }
        .show-img{
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
            max-width: 100%;
        }
        .show-imgbox{
            margin-top:10px;
            margin-left:auto;
            margin-right:auto;
        }
        .show-buttons{
            margin-left:auto;
            margin-right:auto;
            text-align: center;
        }
        .edit-form{
            display:none;
        }
    </style>
@stop