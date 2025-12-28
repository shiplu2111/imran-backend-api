<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait UploadsImages
{
    public function uploadImage(?UploadedFile $file, ?string $oldPath = null, string $folder = 'images', string $disk = 'public'): ?string
    {
        if (!$file) {
            return null;
        }

        if ($oldPath && Storage::disk($disk)->exists($oldPath)) {
            Storage::disk($disk)->delete($oldPath);
        }

        $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();

        return $file->storeAs($folder, $filename, $disk);
    }
}
