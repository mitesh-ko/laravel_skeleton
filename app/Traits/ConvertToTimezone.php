<?php

namespace App\Traits;

use Carbon\Carbon;
use Cookie;

trait ConvertToTimezone
{
    public array $format = [
        'date' => null,
        'dateTime' => null
    ];

    public function getTCreatedAtAttribute(): object
    {
        if ($this->created_at) {
            $converted = Carbon::parse($this->created_at)->timezone(Cookie::get('timezone'));
            $this->format['date'] = $converted->format(config('constants.date'));
            $this->format['dateTime'] = $converted->format(config('constants.dateTime'));
        }
        return (object)$this->format;
    }

    public function getTUpdatedAtAttribute(): object
    {
        if ($this->updated_at) {
            $converted = Carbon::parse($this->updated_at)->timezone(Cookie::get('timezone'));
            $this->format['date'] = $converted->format(config('constants.date'));
            $this->format['dateTime'] = $converted->format(config('constants.dateTime'));
        }
        return (object)$this->format;
    }
}
