<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TransactionFactory extends Factory
{
	protected $model = Transaction::class;

	public function definition(): array
	{
		return [
			'type'         => $this->faker->randomElement(['income', 'expense']),
			'amount'       => $this->faker->randomNumber(),
			'payment_date' => Carbon::now(),
			'desc'         => $this->faker->word(),
			'status'       => $this->faker->randomElement(['paid', 'unpaid']),
		];
	}
}
