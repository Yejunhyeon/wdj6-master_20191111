<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class MembersController extends Controller
{
    public function index()  //get방식으로 요청하여 index로 오게된다
    {
        $members = \App\Member::get();  //멤머테이블을 members에 넣게된다.
        if( $members == null){  //테이블의 값이 없으면 null을 넣게한다 
            $members = '00000';
        }
        return view('members.index',compact('members'));    // view함수를 사용하면 members.index 이라는 것 member.blade를 불러온다. 
                                                            // compact는 데이터를 배열로 만들어준다
                                                            // 넣은 변수 값들을 compact를 이용해서 배열화 해주는 것이다 
    }

    public function create()  //생성요청
    {
    }

    public function store(Request $request)   // 생성부분
    {   
        // dd($request->file);
        if($request->hasFile('file')){ //사진파일이 있을 때
            $file = $request->file('file');
            $filename = Str::random().filter_var($file->getClientOriginalName(), FILTER_SANITIZE_URL);  //FILTER_SANITIZE_URL 쓸모없는 문자열들을 지워준다. /#! 등등

            $members = \App\Member::create([ #   1 
                'name'=>$request->name,  // 'name'은 속성테이블 $request->name은 입력한 값
                'comments'=>$request->comments,
                'filename' => $filename,
            ]);

            // $file->move(attachments_path(), $filename);
            $file->move(attachments_path2(), $filename);
        }

        return response()->json($members,201);
    }

    public function show(\App\Member $member)
    {
    }

    public function edit(Request $request, $id)   // 수정요청
    {
        $members = \App\Member::where('id',$id)->first();
        
        return response()->json($members,201);
    }

    public function update(Request $request, $id) // 수정완료 
    {   
        $validator = Validator::make($request->all(), [
            'name2' => 'require',
            'comments2' => 'required', 
        ]);
        \App\Member::where('id',$id)->update([
            'name'=>$request->name3,
            'comments'=>$request->comments2,
        ]);

        $members = \App\Member::where('id',$id)->first();


        return response()->json($members,201);
    }

    public function destroy(\App\Member $member)  //삭제 
    {
        $member->delete();
    
        return response()->json([],204);
    }
}
