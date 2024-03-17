<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasSlug
{

    abstract public function slugSource(): string;

    public static function bootHasSlug(): void
    {
        static::saving(function (self $model) {
            $model->slug = $model->generateSlut();
        });
    }

    private function generateSlut(): string
    {
        return Str::slug($this->slugSource());
    }
}
