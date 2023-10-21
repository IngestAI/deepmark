<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AIModel extends Model
{
    use HasFactory;

    public const ICON_PATH = 'images/models';

    public function scopeActive(Builder $query)
    {
        $query->where('active', 1);
    }

    public function scopeSlug(Builder $query, string $slug)
    {
        $query->where('slug', $slug);
    }

    public function scopeText(Builder $query)
    {
        $query->where('input_format', 'text')->where('output_format', 'text');
    }

    public function fullname(): Attribute
    {
        return Attribute::make(
            get: function () {
                $provider = AIProvider::find($this->provider_id ?? 0);
                $providerName = $provider->name ?? '';
                return trim($providerName . ' ' . $this->name);
            }
        );
    }

    public function iconPath(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->icon ? config('app.url') . '/' . self::ICON_PATH . '/' . $this->icon : '',
        );
    }
}
