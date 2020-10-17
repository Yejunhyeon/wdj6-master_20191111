<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxTestsController extends Controller
{
    public function index()
    {
        # View 전체 읽기
        return view('ajaxtests.index');
    }

    public function create()
    {
        # POST form 생성
        return response()->json([public_path()],201);
    }

    public function store(Request $request)
    {
        # POST 등록
        return response()->json(['POST 등록'],201);
    }

    public function show($id)
    {
        # View 요청 부분 읽기
        return response()->json(['View 부분 읽기'],201);
    }

    public function edit($id)
    {
        # POST PUT, DELETE form 생성
        return response()->json(['update, delete form'],201);
    }

    public function update(Request $request, $id)
    {
        # PUT 수정
        return response()->json(['U'],201);
    }

    public function destroy($id)
    {
        # DELETE 삭제
        return response()->json(['D'],201);
    }
}
