<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class ProgramsRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }
    protected $dontFlash = ['files'];
    public function rules()
    {   
        $mimes = implode(',', config('attachment.mimes'));
        return [
            'title' => ['required',],
            'content' => ['required', 'min:1'],
            //확장자 jpg,png,zip,tar만 가능 30000KB가 최대   P.280
            'files.*' => ['sometimes', "mimes:{$mimes}", 'max:30000'],
        ];
    }
    public function messages()
    {
        return [
            'required' => '필수 입력 항목입니다.',
            'min' => '최소 :min 글자 이상이 필요합니다.',
            'mimes' => ':values 형식만 허용합니다.',
            'max' => ':max 킬로바이트까지만 허용합니다.',
        ];
    }

    public function attributes()
    {
        return [
            'title' => '제목',
            'content' => '본문',
            'files' => '파일',
            'files.*' => '파일',
        ];
    }
}