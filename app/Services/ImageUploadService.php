<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageUploadService
{
    /**
     * Upload and update the user's profile photo.
     *
     * @return string Path of the new image.
     */
    public function uploadProfilePhoto(UploadedFile $file, User $user): string
    {
        // Delete the old profile photo if it exists
        if ($user->profile_photo) {
            $this->deleteImage($user->profile_photo);
        }

        $path = $this->upload($file, 'profiles');
        $user->update(['profile_photo' => $path]);

        return $path;
    }

    /**
     * Upload an image for a post.
     *
     * @return string Path of the uploaded image.
     */
    public function uploadPostImage(UploadedFile $file): string
    {
        return $this->upload($file, 'posts');
    }

    /**
     * Delete an image file from storage.
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
        $filename = uniqid().'_'.time().'.'.$file->getClientOriginalExtension();

        return $file->storeAs($directory, $filename, 'public');
    }

    /**
     * Resize image. (Requires additional library like Intervention/image)
     */
    // public function resizeImage(UploadedFile $file, int $width, int $height)
    // {
    // }
}
