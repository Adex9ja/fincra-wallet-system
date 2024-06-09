<?php

// database/factories/TransactionFactory.php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        $randomDate = Carbon::now()->subDays(rand(0, 7));
        $wallet = Wallet::factory()->create();
        return [
            'wallet_id' =>$wallet->id,
            'amount' => $wallet->balance,
            'type' => $this->faker->randomElement([TransactionType::credit, TransactionType::debit]),
            'created_at' => $randomDate,
            'updated_at' => $randomDate,
        ];
    }
}
