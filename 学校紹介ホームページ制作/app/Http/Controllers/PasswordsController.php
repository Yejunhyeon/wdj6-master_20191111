<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Http\Requests;



class PasswordsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    # 비밀번호 바꾸기 신청 창
    public function getRemind()
    {
        return view('passwords.remind');
    }

    public function postRemind(Request $request)
    {
        $this->validate($request, ['email' => 'required|email|exists:users']);

        $email = $request->get('email');
        $token = Str::random(64);

        # 라라벨 기본제공
        # migrations\ _create_password_resets_table 참고
        \DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);

        # 아이디 만드는 메일 발송을 응용해서 작업
        # 비밀번호 바꾸는 이벤트를 생성
        event(new \App\Events\PasswordRemindCreated($email, $token));
        return $this->respondSuccess(
            '비밀번호 바꾸는 방법을 담은 이메일을 발송했습니다. 메일 박스를 확인해 주세요.'
        );
    }

    public function getReset($token = null)
    {
        return view('passwords.reset', compact('token'));
    }

    public function postReset(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users',
            'password' => 'required|confirmed',
            'token' => 'required'
        ]);

        $token = $request->get('token');

        if (! \DB::table('password_resets')->whereToken($token)->first()) {
            return $this->respondError('URL이 정확하지 않습니다.');
        }

        \App\User::whereEmail($request->input('email'))->first()->update([
            'password' => bcrypt($request->input('password'))
        ]);

        \DB::table('password_resets')->whereToken($token)->delete();
        
        return $this->respondSuccess(
            '비밀번호를 바꾸었습니다. 새로운 비밀번호로 로그인하세요.'
        );
    }

    protected function respondError($message)
    {
        flash()->error($message);
        return back()->withInput(\Request::only('email'));
    }

    protected function respondSuccess($message)
    {
        flash($message);
        return redirect('/');
    }
}