<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Str;
class CommentsController extends Controller
{
    /**
     * CommentsController constructor.
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function store(\App\Http\Requests\CommentsRequest $request, \App\Article $article)
    {    
        //로그인 하지 않은 유저가 댓글을 쓸 경우
        if(!$request->user()){
            //비회원 유저를 생성
            \App\User::create([
                'name' => "(비회원)",
                'email' => Str::random(10) . '@test.com',
                'password' => '1234',
            ]);
            //생성한 비회원 유저를 get
            
            $last_user = \App\User::latest()->limit(1)->get();
            
            //생성한 비회원 유저로 댓글을 생성
            $comment = $article->comments()->create(array_merge(  //유저를 합친다 
                $request->all(),
                ['user_id' => $last_user[0]->id]
            ));
        }
        //로그인 한 유저가 댓글을 쓴 경우
        else{
            //댓글을 생성
            $comment = $article->comments()->create(array_merge(
                $request->all(),
                ['user_id' => $request->user()->id]
            ));
        }
        \Log::info($comment);
        flash()->success('작성하신 댓글을 저장했습니다.');
        return response()->json([], 204);
    }

    public function update(\App\Http\Requests\CommentsRequest $request, \App\Comment $comment)
    {   
        \Log::info( $request->all());
        \Log::info($comment);
        $comment->update($request->all());

        flash()->success('작성하신 댓글을 수정했습니다.');
        return response()->json([], 204);

    }

    public function destroy(\App\Comment $comment)
    {   \Log::info($comment);
        $comment->delete();
        return response()->json([], 204);
    }

    
    public function vote(Request $request, \App\Comment $comment)
    {
        $this->validate($request, [
            'vote' => 'required|in:up,down',
        ]);
        if ($comment->votes()->whereUserId($request->user()->id)->exists()) {
            $up_down = $request->input('vote') == 'up' ? 'up' : 'down';
            // \Log::info($up_down);
            $comment->votes()->where('user_id', $request->user()->id)->delete();
        }
            $up = $request->input('vote') == 'up' ? true : false;
            $comment->votes()->create([
                'user_id'  => $request->user()->id,
                'up'       => $up,
                'down'     => ! $up,
                'voted_at' => \Carbon\Carbon::now()->toDateTimeString(),
            ]);
        return response()->json([], 201);

    }
    
}