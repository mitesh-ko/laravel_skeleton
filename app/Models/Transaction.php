<?php

namespace App\Models;

use App\Casts\TimezoneConvert;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'amount',
        'payment_date',
        'desc',
        'status',
    ];

    protected $casts = [
        'created_at' => TimezoneConvert::class,
        'updated_at' => TimezoneConvert::class,
        'payment_date' => TimezoneConvert::class,
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
}
