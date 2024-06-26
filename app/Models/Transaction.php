<?php

namespace App\Models;

use App\Traits\ConvertToTimezone;
use Carbon\Carbon;
use Cookie;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory, ConvertToTimezone;

    protected $fillable = [
        'type',
        'amount',
        'payment_date',
        'desc',
        'status',
    ];


    protected function status(): Attribute
    {
        $type = [
            'id' => [
                'paid' => 1,
                'unpaid' => 2,
            ],
            'text' => [
                1 => 'Paid',
                2 => 'Unpaid',
            ]
        ];
        return new Attribute(
            get: fn($value) => $type['text'][$value],
            set: fn($value) => $type['id'][$value],
        );
    }

    protected function type(): Attribute
    {
        $type = [
            'id' => [
                'income' => 1,
                'expense' => 2,
            ],
            'text' => [
                1 => 'Income',
                2 => 'Expense',
            ]
        ];
        return new Attribute(
            get: fn($value) => $type['text'][$value],
            set: fn($value) => $type['id'][$value],
        );
    }

    public function getTPaymentDateAttribute()
    {
        return Carbon::parse($this->payment_date)
            ->timezone(Cookie::get('timezone'))->format(config('constants.date'));
    }
}
