<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Storage;
use Illuminate\Http\Request;

class uploadController extends Controller{

    /**
     * 上传图片
     * @param Request $request
     * @return array|null|string|\Symfony\Component\HttpFoundation\File\UploadedFile 文件名
     */
    public function pictureUpload(Request $request){

        $file = $request->file('file');

        $originalName = $file->getClientOriginalName(); // 文件原名
        $ext = $file->getClientOriginalExtension();     // 扩展名
        $realPath = $file->getRealPath();   //临时文件的绝对路径
        $type = $file->getClientMimeType();     // image/jpeg
        $logo = md5($originalName . time()) . '.' . $ext;

        $flag = Storage::disk()->put($logo, file_get_contents($realPath));

        return response()->json([
            "flag" => $flag,
            "file" => $logo
        ]);
    }

    /**
     * 上传简历文件
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fileUpload(Request $request){


        $file = $request->file('file');

        $originalName = $file->getClientOriginalName(); // 文件原名
        $ext = $file->getClientOriginalExtension();     // 扩展名
        $realPath = $file->getRealPath();   //临时文件的绝对路径
        $type = $file->getClientMimeType();     // image/jpeg
        $logo = md5($originalName . time()) . '.' . $ext;

        $flag = Storage::disk()->put($logo, file_get_contents($realPath));

        $user = Auth::user();
        $resume = $user->resume;
        $resume->annex = $logo;
        $resume->save();

        return response()->json([
            'flag' => $flag
        ]);
    }
}
