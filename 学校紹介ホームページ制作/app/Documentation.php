<?php

namespace App;

use File;   #File 파사드 import
use Illuminate\Support\Str;

class Documentation
{
    public function get($file = 'documentation.md')
    {
        $content = File::get($this->path($file));
        return $this->replaceLinks($content);
    }

    #파일 경로를 계산하는 메서드
    protected function path($file)
    {
        #확장자 없이 파일을 요청했을 경우를 대비해 확장자를 덧붙여 주는 구문
        $file = Str::endsWith($file, '.md') ? $file : $file . '.md';

        #base_path(string $path)는 라라벨 루트 경로를 기준으로 넘겨받은
        #$path의 절대경로를 반환하는 함수
        $path = base_path('docs' . DIRECTORY_SEPARATOR . $file);

        #파일이 있는지 확인하는 메서드
        if (!File::exists($path)) {
            #파일이 없으면 예외를 던짐
            abort(404, '요청하신 파일이 없습니다');
        }
        return $path;
    }
    #깃허브 관련 메서드
    protected function replaceLinks($content)
    {
        return str_replace('/docs/{{version}}', '/docs', $content);
    }
}