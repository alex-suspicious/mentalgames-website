<?php

namespace App\Additions\User;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasBackgroundPhoto
{
    /**
     * Update the user's background photo.
     *
     * @param  \Illuminate\Http\UploadedFile  $photo
     * @param  string  $storagePath
     * @return void
     */
    public function updateBackgroundPhoto(UploadedFile $photo, $storagePath = 'background-photos')
    {
        tap($this->background_photo_path, function ($previous) use ($photo, $storagePath) {
            $this->forceFill([
                'background_photo_path' => $photo->storePublicly(
                    $storagePath, ['disk' => $this->backgroundPhotoDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->backgroundPhotoDisk())->delete($previous);
            }
        });
    }

    /**
     * Delete the user's background photo.
     *
     * @return void
     */
    public function deleteBackgroundPhoto()
    {
         if (is_null($this->background_photo_path)) {
            return;
        }

        Storage::disk($this->backgroundPhotoDisk())->delete($this->background_photo_path);

        $this->forceFill([
            'background_photo_path' => null,
        ])->save();
    }

    /**
     * Get the URL to the user's background photo.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function backgroundPhotoUrl(): Attribute
    {
        return Attribute::get(function (): string {
            return $this->background_photo_path
                    ? Storage::disk($this->backgroundPhotoDisk())->url($this->background_photo_path)
                    : $this->defaultBackgroundPhotoUrl();
        });
    }

    /**
     * Get the default background photo URL if no background photo has been uploaded.
     *
     * @return string
     */
    protected function defaultBackgroundPhotoUrl()
    {
        $name = trim(collect(explode(' ', $this->name))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
    }

    /**
     * Get the disk that background photos should be stored on.
     *
     * @return string
     */
    protected function backgroundPhotoDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('jetstream.background_photo_disk', 'public');
    }
}
