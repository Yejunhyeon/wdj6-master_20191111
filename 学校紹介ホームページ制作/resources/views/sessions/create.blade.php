@extends('layouts.app')

@section('content')
<form action="{{ route('sessions.store') }}" method="POST" role="form" class="form__auth">
    {!! csrf_field() !!}

    <div class="page-header">
        <h2>로그인</h2>
    </div>
            <!-- 만약에 error라는 변수;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
            
            e oo안에 email이라는 게있으면 div 클래스 이름은 form-group haserror라는 됩니다. -->
    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}"> 
        <!-- <input type="email" name="email" class="form-control" placeholder="이메일" value="{{ old('email') }}" autofocus /> -->
        <input type="email" name="email" class="form-control" placeholder="이메일" value="admin@mail.com" autofocus />
        {!! $errors->first('email', '<span class="form-error">:messages</span>') !!}
    <!-- !!!만약에 error라는 변수에서 email이라는 객체가 안에 있으면 젤 첫번째 email 값에 해당하는 매세지를 가져옵니다-->
    
    </div>

    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
        <!-- <input type="password" name="password" class="form-control" placeholder="비밀번호"> -->
        <input type="password" name="password" class="form-control" placeholder="비밀번호" value="secret">
        {!! $errors->first('password', '<span class="form-error">:message</span>')!!}
    </div>

    <div class="form-group">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember" value="{{ old('remember', 1) }}" checked>
                로그인 기억하기
                <span class="text-danger">
                    (공용 컴퓨터에서는 사용하지 마세요!)
                </span>
            </label>
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-primary btn-lg btn-block" type="submit">
            로그인
        </button>
    </div>

    <div>
        <p class="text-center">
            회원이 아니라면?
            <a href="{{route('users.create')}}">
                가입하세요
            </a>
        </p>
        <p class="text-center">
            <a href="{{ route('remind.create') }}">
                비밀번호를 잊으셨나요?
            </a>
        </p>
    </div>
</form>
@stop