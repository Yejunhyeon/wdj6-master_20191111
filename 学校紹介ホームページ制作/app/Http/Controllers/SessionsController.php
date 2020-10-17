<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class SessionsController extends Controller
{
    public function __construct()  //생성자 
    {
        $this->middleware('guest', ['except' => 'destroy']);  //이 기능들 전체는 guest만 할 수 있다. guest만 못하는 것은 로그아웃이다.
    }

    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    { //유효성 검사
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (!auth()->attempt($request->only('email', 'password'), $request->has('remember'))) {
            return $this->respondError('이메일 또는 비밀번호가 맞지 않습니다.');
        } //$request->only 현재 요청한게 DB에 있는지 없는지 

        if (!auth()->user()->activated) {
            auth()->logout();
            return $this->respondError('이메일로 가입확인해 주세요.');
        }

        return $this->respondCreated(auth()->user()->name . '님, 환영합니다.');
    }

    public function destroy()
    {
        auth()->logout();
        flash('또 방문해 주세요.');
        return redirect('/');
    }

    protected function respondError($message)
    {
        flash()->error($message);
        # back 이전페이지로 가기
        return back()->withInput();
    }

    protected function respondCreated($message)
    {
        flash($message);
        return redirect()->intended('home');
    }
}