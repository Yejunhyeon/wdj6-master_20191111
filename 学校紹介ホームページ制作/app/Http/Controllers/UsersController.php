<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    # 라라벨이 지원하는 guest 유저만 로그인 창을 볼 수 있음
    public function __construct() 
    {
        $this->middleware('guest');
    }

    # 로그인 페이지 web.php 와 연관, 로그인 하는 창을 보여줌
    public function create()
    {
        return view('users.create');
    }

    # 로그인 페이지 web.php 와 연관, 로그인 전송 요청
    public function store(request $request)
    {
        # 유효성 검사
        # resources\lang\en\validation 확인
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        # 이메일 확인 코드
        $confirmCode = Str::random(60);

        $user = \App\User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'confirm_code' => $confirmCode,
        ]);

        # 메일 보내려면 필요함
        # 이벤트로 분류해서 Mail::send를 별도로 관리
        event(new \App\Events\UserCreated($user));  
        #-->userCreated이 이벤트가 발생하면ㄴ은 UserEventListener로 반응하게 된다.
        # 플래시 메시지와 리디렉션 응답이 여러 번 반복되므로 이렇게 한다
        return $this->respondCreated( # 아래 쪽 확인
            '가입하신 메일 계정으로 가입 확인 메일을 보내드렸습니다.
            가입 확인하시고 로그인해 주세요.'
        );
    }

    # 전송된 url이 confirm_code 지우고 activated 여부를 on
    public function confirm($code)
    {
        $user = \App\User::whereConfirmCode($code)->first();
        if (!$user) {
            return $this->respondError('URL이 정확하지 않습니다.');
        }

        $user->activated = 1;
        $user->confirm_code = null;
        $user->save(); # db를 저장하는 메서드, make save 응용

        auth()->login($user);
        flash(auth()->user()->name . '님, 환영합니다. 가입 확인되었습니다.');

        return redirect('home');
    }

    protected function respondCreated($message)
    {
        flash($message);
        return redirect('/');
    }

    protected function respondError($message)
    {
        flash()->error($message);
        return redirect('/');

        //confirm.blade.php
    }
}