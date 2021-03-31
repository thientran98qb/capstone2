<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadImageTrait{

    public function storageTraitUpload($request,$fieldName,$nameFolder){
        if($request->hasFile($fieldName)){
            $file = $request->file($fieldName);
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNamePath = str_random('20'). '.' . $file->getClientOriginalExtension();
            $filePath = $request->file($fieldName)->storeAs('public/'.$nameFolder.'/'.auth()->id(), $fileNamePath);
            $data = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($filePath)
            ];
            return $data;
        }
        return null;
    }
    public function storageTraitUploadMult($file,$nameFolder){
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNamePath = str_random('20'). '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('public/'.$nameFolder.'/'.auth()->id(), $fileNamePath);
            $data = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($filePath)
            ];
            return $data;
    }
}
