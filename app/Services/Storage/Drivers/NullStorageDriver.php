<?php

namespace App\Services\Storage\Drivers;

class NullStorageDriver implements StorageDriver
{
    public function upload(string $path, $file, $visibility = null): bool
    {
        return true;
    }

    public function uploadFromStream(string $path, $sourceStream): mixed
    {
        return true;
    }

    public function copy(string $path, $existedFile): bool
    {
        return true;
    }

    public function download(string $path, $originalName): mixed
    {
        return response()->json([]);
    }

    public function exists(string $path): bool
    {
        return true;
    }

    public function get(string $path): mixed
    {
        return '';
    }

    public function delete(string $path) : bool
    {
        return true;
    }

    public function url(string $path): string
    {
        return $path;
    }

    public function path(string $path): string
    {
        return $path;
    }
}
