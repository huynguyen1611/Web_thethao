<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    // request đón biến đé xử lí
    public function uploadImage(Request $request)
    {

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->storeAs('images', $fileName, 'public');

            return response()->json([
                'success' => true,
                'path' => '/storage/images/' . $fileName,
            ]);
        }

        return response()->json(['success' => false]);
    }

    public function uploadImages(Request $request)
    {
        $files = $request->file('files');
        for ($i = 0; $i < count($files); $i++) {
            $fileName = time() . '-' . $files[$i]->getClientOriginalName();
            $files[$i]->storeAs('/images', $fileName, 'public');
            $url[] = '/storage/images/' . $fileName;
        }
        return response()->json([
            'success' => true,
            'message' => 'Tải ảnh thành công',
            'paths' => $url
        ]);
    }
}
