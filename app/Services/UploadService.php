<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

use Illuminate\Support\Facades\Storage;

class UploadService {

    public function upload(string $disk = 'local', string $path = 'images', UploadedFile $file) 
    {
        return $file->store($path, $disk);
    }

    public function removeIfExists(string $disk, string $file) 
    {
        if ($this->verifyIfExists($disk, $file) ) 
        {
            Storage::disk($disk)->delete($file);
        }
    }

    public function verifyIfExists(string $disk, string $file)
    {
        if (Storage::disk($disk)->exists($file)) 
        {
            return true;
        }

        return false;
    }
}