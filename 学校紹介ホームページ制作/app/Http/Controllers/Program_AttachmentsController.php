<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
class Program_AttachmentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }
    public function store(Request $request)
    {
        
        $attachments = [];
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $filename = str_random() . filter_var($file->getClientOriginalName(), FILTER_SANITIZE_URL);
                $payload = [
                    'filename' => $filename,
                    'bytes' => $file->getClientSize(),
                    'mime' => $file->getClientMimeType()
                ];
                $file->move(program_attachments_path(), $filename);
                $attachments[] = ($id = $request->input('program_id'))
                    ? \App\Program::findOrFail($id)->program_attachments()->create($payload)
                    : \App\Prgram_Attachment::create($payload);
            }
        }
        return response()->json($attachments);
    }

    //삭제
    public function destroy(\App\Attachment $attachment)
    {
    }

    public function show($file)
    {
    }
}