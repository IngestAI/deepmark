<?php

namespace App\Services\Storage;

use App\Services\Storage\Enums\StorageTypeEnum;
use App\Services\Storage\Drivers\LocalStorageDriver;
use App\Services\Storage\Drivers\NullStorageDriver;
use App\Services\Storage\Drivers\StorageDriver;

final class StorageFactory
{
    public static function create(string $type = ''): StorageDriver
    {
        switch (strtolower($type)) {
            case (string) StorageTypeEnum::local():
                return new LocalStorageDriver();
        }

        return new NullStorageDriver();
    }
}