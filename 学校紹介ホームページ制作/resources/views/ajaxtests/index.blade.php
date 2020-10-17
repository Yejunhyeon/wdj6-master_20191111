@extends('layouts.app')

@section('content')
<div class="page-header">
  <h2>CRUD TEST</h2>
</div>
<div class="spanDiv">
    <li><span><label for="">POST 등록</label>       <button id="C">C</button></span></li>
    <li><span><label for="">View 전체 읽기</label>  <button id="R">R</button></span></li>
    <li><span><label for="">View 부분 읽기</label>  <button id="Rp">Rp</button></span></li>
    <li><span><label for="">PUT 수정</label>        <button id="U">U</button></span></li>
    <li><span><label for="">DELETE 삭제</label>     <button id="D">D</button></span></li>
    <li><span><label for="">create_form</label>     <button id="create_form">create_form</button></span></li>
    <li><span><label for="">edit_form</label>       <button id="edit_form">edit_form</button></span></li>
</div>
@stop

@section('script')
<script>
  window.onload = function() {
    var int = 777;

    var C = document.getElementById('C');
    $(C).on('click',function(){
      console.log('C store 호출');
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
      $.ajax({
        type:'POST',
        url: 'ajaxtests',
        data: {
          mydata: "mydata",
        },
        success: function(data){
          console.log(data);
        }
      });
    })

    var R = document.getElementById('R');
    $(R).on('click',function(){
      console.log('R index 호출');
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
      $.ajax({
        type:'GET',
        url: 'ajaxtests',
        data: {
          mydata: "mydata",
        },
        success: function(data){
          console.log(['View 전체 읽기']);
        }
      });
    })

    var Rp = document.getElementById('Rp');
    $(Rp).on('click',function(){
      console.log('Rp show 호출');
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
      $.ajax({
        type:'GET',
        url: 'ajaxtests/'+int,
        data: {
          mydata: "mydata",
        },
        success: function(data){
          console.log(data);
        }
      });
    })

    var U = document.getElementById('U');
    $(U).on('click',function(){
      console.log('U update 호출');
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
      $.ajax({
        type:'PUT',
        url: 'ajaxtests/'+int,
        data: {
          mydata: "mydata",
        },
        success: function(data){
          console.log(data);
        }
      });
    })

    var D = document.getElementById('D');
    $(D).on('click',function(){
      console.log('d destroy 호출');
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
      $.ajax({
        type:'DELETE',
        url: 'ajaxtests/'+int,
        data: {
          mydata: "mydata",
        },
        success: function(data){
          console.log(data);
        }
      });
    })

    var create_form = document.getElementById('create_form');
    $(create_form).on('click',function(){
      console.log('create form 호출');
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
      $.ajax({
        type:'GET',
        url: 'ajaxtests/'+'create',
        data: {
          mydata: "mydata",
        },
        success: function(data){
          console.log(data);
        }
      });
    })

    var edit_form = document.getElementById('edit_form');
    $(edit_form).on('click',function(){
      console.log('edit form 호출');
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
      $.ajax({
        type:'GET',
        url: 'ajaxtests/'+int+'/edit',
        data: {
          mydata: "mydata",
        },
        success: function(data){
          console.log(data);
        }
      });
    })
  };
</script>
@stop
