@extends('layouts.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">   
    <div>
        <div class="page-header">
            <h2>조원소개</h2>
        </div>
        @can('member_create', $members)
        <label class="btn btn-primary btnCreate" onclick="create()">멤버 추가</label>  <!--라벨에다가 onclick을 달았다.  --> 
        @endcan

        <div class="createDiv" id="createDiv">
            <hr />
        </div>
    </div>
    <div class="contentDiv" id="contentDiv">
        @forelse ($members as $member) <!--6번 돈다--> <!--for문 돌때마다 이미지 등 정보가 하나씩 생성된다.  --> 
            <div class="memberDiv" id="memberDiv{{$member->id}}">
                <div class="imgDiv">
                    <img class="img-thumbnail" src="http://127.0.0.1:8000/files2/{{$member->filename}}" alt="11"
                    onclick="imgClick({{$member->id}},'{{$member->name}}','{{$member->comments}}')">
                    <!--<img class="img-thumbnail" src="http://btrya23.iptime.org:8000/files2/{{$member->filename}}" alt="11"
                    onclick="imgClick({{$member->id}},'{{$member->name}}','{{$member->comments}}')"> -->
                </div>
                <div class="infoDiv">
                    <label onclick="imgClick({{$member->id}},'{{$member->name}}','{{$member->comments}}')"
                    class="btn btn-info" onclick="edit({{$member->id}})">정보 확인</label>
                </div>
                <div class="conDiv" id="conDiv{{$member->id}}"></div>
                <div class="btnDiv">
                @can('member_edit', $member)   
                    <label class="btn btn-primary btnEdit" onclick="edit({{$member->id}})">수정</label>
                    <label class="btn btn-danger "onclick="del('{{$member->id}}')">삭제</label>
                @endcan
                </div>
                <div class="editDiv" id="editDiv{{$member->id}}">
                </div>  
            </div>
        @empty
        @endforelse
    </div>
@stop
@section('script')
<script>
    var createCheck = 1; //create()함수 온오프 관리 
    var editCheck =1; //edit 함수 온오프 관리
    var check =999; // 조회 함수 온오프 상태를 알기위해서 만듬
    var nameDiv = document.createElement("div");
    var commentsDiv = document.createElement("div");
    function imgClick(id,name,comments){
        console.log('imgClick!!!');
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        $.ajax({
            type:"GET",
            url:'/members/'+id+'/edit',
            data: {'id': id, 'name' : name, 'comments':comments},
        }).then(function(data){
            console.log(data);
            var conDiv = document.getElementById("conDiv"+data.id);
            if(check==999){
                nameDiv.id = "nameDiv"+data.id;
                commentsDiv.id = "commentsDiv"+data.id;
                nameDiv.innerHTML= data.name;
                commentsDiv.innerHTML= data.comments;                   
                conDiv.append(nameDiv);
                conDiv.append(commentsDiv);
                check= data.id;
                console.log("이프문"+check);
            }
            else if(check==data.id){
                nameDiv.innerHTML= '';
                commentsDiv.innerHTML= '';
                check=999;
                console.log("이프엘스문"+check);
            }
            else{
                nameDiv.id = "nameDiv"+data.id;
                commentsDiv.id = "commentsDiv"+data.id;
                nameDiv.innerHTML= data.name;
                commentsDiv.innerHTML= data.comments;                   
                conDiv.append(nameDiv);
                conDiv.append(commentsDiv);
                check= data.id;
                console.log("엘스문"+check);
            }
        
        })
    };
    function del(id){
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        if(confirm('멤버를 삭제합니다.')){
            console.log("이프문");
            $.ajax({
                type:"DELETE",
                url: '/members/' +id
            }).then(function(e){
                console.log("덴");
                window.location.href='/members';
            },function(e){

                console.log(e);
            });
        }
    };
    function btnCre(){
        var contentDiv = document.getElementById('contentDiv');
        var form =$('#creForm')[0]; //제이쿼리 객체안에 있는 HTMLFormElement객체!!! 가져오기 위해서 썼다. 
        var data = new FormData(form);
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            console.log("이프문");
            $.ajax({
                type:"post",
                enctype:"multipart/form-data",
                data:data,
                url: "/members",
                processData: false,
                contentType: false,
                cache:false,
                success:function(data){
                    console.log(data);
                    var createDiv = document.getElementById('createDiv');
                    createDiv.innerHTML = '';
                    createCheck=1;
                    var editDiv = document.createElement('div');
                    var memberDiv = document.createElement('div');
                    var imgDiv = document.createElement('div');
                    var conDiv = document.createElement('div');
                    var btnDiv = document.createElement('div');
                    var infoDiv = document.createElement('div');
                    var nameDiv = document.createElement('div');
                    var commentsDiv = document.createElement('div');
                    var img = document.createElement('img');
                    var btnEdit = document.createElement('label');
                    var btnDel =document.createElement('label');
                    editDiv.id = "editDiv"+data.id;
                    editDiv.className = "editDiv";
                    nameDiv.id= "nameDiv"+data.id;
                    commentsDiv.id = "comments"+data.id;
                    img.src="http://btrya23.iptime.org:8000/files2/"+data.filename;
                    // img.src="http://127.0.0.1:8000/files2/"+data.filename;
                    img.className = "img-thumbnail";
                    img.alt= "사진 안보여";
                    $(img).on('click',function(){
                        imgClick(data.id,data.name,data.comments);
                    });
                    btnEdit.innerHTML="수정";
                    $(btnEdit).on('click',function(){                            
                        edit(data.id);
                    });
                    btnDel.innerHTML="삭제";
                    $(btnDel).on('click',function(){
                        del(data.id);
                    });
                    memberDiv.className = "memberDiv";
                    memberDiv.id = 'memberDiv'+data.id;
                    imgDiv.className = "imgDiv";
                    infoDiv.className = "infoDiv";
                    conDiv.className = "conDiv";
                    conDiv.id = "conDiv"+data.id;
                    btnDiv.className = "btnDiv";
                    btnEdit.className = "btn btn-primary";
                    btnDel.className = "btn btn-danger";
                    // 정보 확인 라벨추가
                    var btnInfo = document.createElement('label');
                    btnInfo.innerHTML="정보 확인";
                    $(btnInfo).on('click',function(){
                        imgClick(data.id,data.name,data.comments);
                    })
                    btnInfo.className = "btn btn-info";
                    contentDiv.appendChild(memberDiv);
                    memberDiv.appendChild(imgDiv);
                    imgDiv.appendChild(img);
                    // 정보 확인 div
                    memberDiv.appendChild(infoDiv);
                    // 정보 확인 label
                    infoDiv.appendChild(btnInfo);
                    memberDiv.appendChild(conDiv);
                    conDiv.appendChild(nameDiv);
                    conDiv.appendChild(commentsDiv);
                    memberDiv.appendChild(btnDiv);
                    memberDiv.appendChild(editDiv);
                    btnDiv.appendChild(btnEdit);
                    btnDiv.appendChild(btnDel);
                }
                ,
                error:function(e){
                    console.log(e);
                alert("정보를 전부 기입해 주세요.");
                }
            });
    }
    function btnEdit(id){
        console.log('btnEdit 실행!');
        var editDiv = document.getElementById('editDiv'+id);
        var form  = $('#editForm'+id)[0];  //제이쿼리 객체안에 있는 form객체를 가져오기 위해서 선언했다. 
        var data = new FormData(form); 
        data.append('_method','put'); //타입을 post로 해야 서버로 보내기 가능, 
        // method:'PUT',
        // @method('PUT')

        console.log(form);
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        $.ajax({
                type:"post",  //post는데 읽어오는값을 put으로 준다 그래야 update을 받을 수 있다. 
                url: '/members/' +id,
                data: data,
                processData:false,
                contentType:false,
            }).then(function(data){
                var nameDiv = document.getElementById('nameDiv'+data.id);
                var commentsDiv = document.getElementById('commentsDiv'+data.id);
                console.log("수정 성공");
                console.log(data);
                // nameDiv.innerHTML= data.name;
                // commentsDiv.innerHTML= data.comments;
                editDiv.innerHTML = '';
                editCheck=1;
            },function(e){
                console.log("수정실패");
                console.log(e);
            });
    };
    function create(){   //조원소개 추가할 때
            var createDiv = document.getElementById('createDiv');  
            var creForm = document.createElement('form');           //form 태그를 만들어서 변수에 담는다 <form> </form> 이런형태이다
            var nameLabel = document.createElement('label');
            var nameInput = document.createElement('input');
            var commentsLabel = document.createElement('label');
            var commentsTextarea = document.createElement('textarea');
            var fileLabel = document.createElement('label');
            var fileInput = document.createElement('input');
            var creLabel = document.createElement('label');
            var nameDiv = document.createElement('div');
            var commentsDiv=document.createElement('div');
            var fileDiv =document.createElement('div');
            nameDiv.className = "form-group";
            //namediv변수에 classd이름을 form-group 줘라
            commentsDiv.className = "form-group";
            fileDiv.className = "form-group";
            creForm.id = "creForm";
            creForm.enctype = "multipart/form-data";
            // creForm.attri
            nameLabel.innerHTML = "이름";
            //<label> 이름 </label>
            nameInput.type ="text";
            nameInput.name = "name";
            commentsLabel.innerHTML="한마디";
            commentsTextarea.name ='comments';
            commentsTextarea.className = "form-control";
            
            fileLabel.innerHTML = "파일";
            fileInput.type = "file";
            fileInput.name = "file";
            creLabel.innerHTML = "저장 하기";
            $(creLabel).on('click',function(){
                btnCre();
            })
            
            creLabel.className="btn btn-primary";
            if(createCheck == 1){  //처음 생성할 때 
                createDiv.appendChild(creForm); //자식으로 들어간다  append는 하단으로 들어가야한다.
                /*<div>         
                <form> </form>
                </div>
                */
                creForm.appendChild(nameDiv);
                creForm.appendChild(commentsDiv);
                creForm.appendChild(fileDiv);
                nameDiv.appendChild(nameLabel);
                nameDiv.appendChild(nameInput);
                commentsDiv.appendChild(commentsLabel);
                commentsDiv.appendChild(commentsTextarea);
                fileDiv.appendChild(fileLabel);
                fileDiv.appendChild(fileInput);
                creForm.appendChild(creLabel);
                createCheck=0;   //
            }
            else if(createCheck == 0){  // 입력한 정보 초기화 
                console.log("작동");
                createDiv.innerHTML='';
                createCheck=1;
            }         
    }
    function edit(id){  //수정버튼
        var memberDiv = document.getElementById('memberDiv'+id);
        var editDiv = document.getElementById('editDiv'+id);
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        $.ajax({
            type:"GET",
            url:'/members/'+id+'/edit',  
            data: {'id': id},
        }).then(function(data){  //요청이 성공했을 떄
            var editForm = document.createElement('form'); //빈 폼태그를 만듬
            var nameLabel = document.createElement('label');
            var nameInput = document.createElement('input');
            var commentsLabel = document.createElement('label');
            var commentsTextarea = document.createElement('textarea');
            var editLabel = document.createElement('label');
        
            editForm.id = "editForm"+data.id;  //빈 폼 태그에 속성을 입힘
            editForm.method = "POST";
            nameLabel.innerHTML = "이름";
            nameInput.type = "text";
            nameInput.id="name2";
            nameInput.name="name3";
            nameInput.value = data.name;
            nameInput.className = "form-control"
            commentsLabel.innerHTML = "한마디";
            commentsTextarea.type = "textarea";
            commentsTextarea.id="comments2";
            commentsTextarea.name="comments2";
            commentsTextarea.value = data.comments;
            commentsTextarea.className = "form-control"
            editLabel.className = "btn btn-success";
            editLabel.innerHTML = "수정된 내용 저장";
            $(editLabel).on("click",function(){
                btnEdit(data.id);
            })
            if(editCheck == 1){
                console.log("이프문");
                editDiv.appendChild(editForm);
                editForm.appendChild(nameLabel);
                editForm.appendChild(nameInput);
                editForm.appendChild(commentsLabel);
                editForm.appendChild(commentsTextarea);
                editForm.appendChild(editLabel);
                editCheck=0;
                                }
            else if(editCheck == 0){
                console.log("엘스문");
                editDiv.innerHTML = '';
                editCheck=1;
                                    }
        })
    
    }
    
</script>
@stop
@section('style')
        <style>
            .memberDiv{
                display:inline-block;
            }
            .conDiv, .btnDiv, .infoDiv{
                width:177px;
            }
            .btn-info{
                width:100%;
                margin-top: 10px;
                color: white;
            }
            .imgDiv{
                width:177px;
                height:236px;
            }
            img{
                width:100%;
                height:100%;
            }
            .btnDiv > label {
                width:48%;
            }
            .btn-success{
                width:98%;
                margin:1%;
            }
        </style>
@stop