<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProgramsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', ]]);
    }

    public function index()
    {
        $program = new \App\program;
        $programs = $program->latest()->paginate(5);  //만든시간 기준으로 최근으로 역순으로 한 페이지당 5개 게시글
        return view('programs.index',compact('program','programs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json(['form'],201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\ProgramsRequest $request)
    {
        //작성을 요청한 유저의 글을 만듬(작성을 요청한 정보의 모든 속성을 $program에 대입)
        //$program는 auth()->user()->programs()->create()를 호출함
        //로그인 한 유저의 게시판을 작성
        $program = $request->user()->programs()->create($request->all());
        //작성된 글이 없으면 
        if (!$program) {
            flash()->error('글 작성 실패');
            return back()->withInput();
        }

        //파일이 있다면 
        if ($request->hasFile('files')) {
            // 파일 저장
            $files = $request->file('files');
            foreach($files as $file) {
                $filename = Str::random().filter_var($file->getClientOriginalName(), FILTER_SANITIZE_URL);
                // 순서 중요 !!!
                // 파일이 PHP의 임시 저장소에 있을 때만 getSize, getClientMimeType등이 동작하므로,
                // 우리 프로젝트의 파일 저장소로 업로드를 옮기기 전에 필요한 값을 취해야 함.
                $program->program_attachments()->create([
                    'program_id'=> $program->id,
                    'filename' => $filename,
                    'bytes' => $file->getSize(),
                    'mime' => $file->getClientMimeType()
                ]);
                $file->move(program_attachments_path(), $filename);
            }
        }

        //이벤트를 발생시킴 
        // var_dump('이벤트 발생완료');
        event(new \App\Events\ProgramCreated($program));
        flash()->success('게시판을 생성하였습니다.');

        return response()->json(['form'],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $program = \App\Program::find($id);

        return $program;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Program $program)
    {

        return response()->json([], 204);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\ProgramsRequest $request, \App\Program $program)
    {
        \Log::info($request->all());
        $this->authorize('update', $program);  //업데이트 가능한지 권한 확인 
        $program->update($request->all());
        //store메서드에도 있음
        flash()->success('수정하신 내용을 저장했습니다.');
        return response()->json([], 204);
    }
    public function destroy(\App\Program $program)
    {   
        $this->authorize('delete', $program);
        $program->delete();
        return response()->json([], 204);
        return $program;
    }
}
