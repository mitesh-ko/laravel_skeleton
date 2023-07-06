<?php

namespace App\Casts;

use Carbon\Carbon;
use Cookie;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class TimezoneConvert implements CastsAttributes
{
    public array $format = [
        'date' => null,
        'dateTime' => null
    ];

    /**
     * Cast the given value.
     *
     * @param array<string, mixed> $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if ($value) {
            $converted = Carbon::parse($value)->timezone(Cookie::get('timezone'));
            $this->format['date'] = $converted->format('d/M/Y');
            $this->format['dateTime'] = $converted->format('d/M/Y H:i');
        }
        return (object)$this->format;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param array<string, mixed> $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return $value;
    }
}
