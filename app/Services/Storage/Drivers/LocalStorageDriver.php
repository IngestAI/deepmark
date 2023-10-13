<?php

namespace App\Services\Storage\Drivers;

use App\Services\Storage\Enums\StorageTypeEnum;
use Illuminate\Support\Facades\Storage;

class LocalStorageDriver implements StorageDriver
{
    public function upload(string $path, $file, $visibility = null): bool
    {
        $visibility = $visibility ?: [];

        return Storage::disk((string) StorageTypeEnum::local())->put($path, $file, $visibility);
    }

    public function uploadFromStream(string $path, $sourceStream): mixed
    {
        Storage::disk((string) StorageTypeEnum::local())->getDriver()->writeStream($path, $sourceStream);
        return $this->exists($path);
    }

    public function copy(string $path, $existedFile): bool
    {
        return Storage::disk((string) StorageTypeEnum::local())->put($path, $existedFile);
    }

    public function download(string $path, $originalName): mixed
    {
        return Storage::disk((string) StorageTypeEnum::local())->download($path, $originalName);
    }

    public function exists(string $path) : bool
    {
        return Storage::disk((string) StorageTypeEnum::local())->exists($path);
    }

    public function get(string $path): mixed
    {
        return Storage::disk((string) StorageTypeEnum::local())->get($path);
    }

    public function delete(string $path) : bool
    {
        return Storage::disk((string) StorageTypeEnum::local())->delete($path);
    }

    public function url(string $path): string
    {
        return asset(Storage::disk((string) StorageTypeEnum::local())->url($path));
    }

    public function path(string $path): string
    {
        return Storage::disk((string) StorageTypeEnum::local())->path($path);
    }
}
