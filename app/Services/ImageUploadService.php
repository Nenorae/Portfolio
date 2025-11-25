<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

//
// Tugas:
// - Handle upload gambar (profile photo & post image)
// - Resize/compress gambar
// - Hapus gambar lama
// - Generate unique filename
//
// Methods:
// - uploadProfilePhoto(\$file, \$user) Upload foto profil
// - uploadPostImage(\$file) Upload gambar post, return path
// - deleteImage(\$path) Hapus gambar
// - resizeImage(\$file, \$width, \$height) Resize gambar (opsional)
//
class ImageUploadService
{
    /**
     * Upload dan update foto profil user.
     *
     * @return string Path gambar yang baru.
     */
    public function uploadProfilePhoto(UploadedFile $file, User $user): string
    {
        // Hapus foto profil lama jika ada
        if ($user->profile_photo) {
            $this->deleteImage($user->profile_photo);
        }

        $path = $this->upload($file, 'profiles');
        $user->update(['profile_photo' => $path]);

        return $path;
    }

    /**
     * Upload gambar untuk post.
     *
     * @return string Path gambar yang diupload.
     */
    public function uploadPostImage(UploadedFile $file): string
    {
        return $this->upload($file, 'posts');
    }

    /**
     * Hapus file gambar dari storage.
     */
    public function deleteImage(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    /**
     * Core upload logic.
     */
    protected function upload(UploadedFile $file, string $directory): string
    {
        // Generate unique filename
        $filename = uniqid().'_'.time().'.'.$file->getClientOriginalExtension();

        // Store file
        return $file->storeAs($directory, $filename, 'public');
    }

    /**
     * Resize gambar. (Membutuhkan library tambahan seperti Intervention/image)
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  int  $width
     * @param  int  $height
     * @return mixed
     */
    // public function resizeImage(UploadedFile $file, int $width, int $height)
    // {
    //     // Implementasi dengan library Intervention/image
    //     // $image = Image::make($file)->fit($width, $height);
    //     // return $image->save();
    // }
}
