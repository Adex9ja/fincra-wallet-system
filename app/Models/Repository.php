<?php

namespace App\Models;


use App\Exceptions\InsufficientBalanceException;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Repository
{

    public function getAllUsers(): Collection
    {
        return User::all();
    }

    public function getAllTransactions(): Collection
    {
        return Transaction::all();
    }

    public function getDashBoardReportData(): array
    {
        $totalUsers = User::count();
        $totalTransactions = Transaction::count();
        $totalBalance = Wallet::sum('balance');
        return compact('totalUsers', 'totalTransactions', 'totalBalance');
    }

    public function getUser($id)
    {
        return User::where('id', $id)->first();
    }

    public function debitWallet(Request $request)
    {
        DB::transaction(function () use ($request) {
            $wallet = Wallet::lockForUpdate()->find($request->wallet_id);

            if ($wallet->balance < $request->amount) {
                throw new InsufficientBalanceException('Insufficient balance');
            }

            $wallet->balance -= $request->amount;
            $wallet->save();

            Transaction::create([
                'wallet_id' => $wallet->id,
                'type' => TransactionType::debit,
                'amount' => $request->amount,
            ]);
        });
    }

    public function creditWallet(Request $request)
    {
        DB::transaction(function () use ($request) {
            $wallet = Wallet::lockForUpdate()->find($request->wallet_id);
            $wallet->balance += $request->amount;
            $wallet->save();

            Transaction::create([
                'wallet_id' => $wallet->id,
                'type' => TransactionType::credit,
                'amount' => $request->amount,
            ]);
        });
    }

    public function getBalance($userId)
    {
        $user = $this->getUser($userId);
        if($user == null){
            throw new NotFoundHttpException('User not found');
        }
        if(!isset($user->wallet)){
            throw new NotFoundHttpException('User does not have a wallet');
        }
        return $user->wallet->balance;
    }

    public function getWeeklyReport()
    {
        $endDate = Carbon::now();
        $startDate = $endDate->copy()->subWeek();

        $transactions = Transaction::whereBetween('created_at', [$startDate, $endDate])->get();

        // Aggregate data
        $totalTransactions = $transactions->count();
        $totalAmount = $transactions->sum('amount');
        $averageAmount = $transactions->average('amount');

        // Group transactions by day
        $transactionsByDay = $transactions->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m-d'); // grouping by day
        });

        $dailyStats = $transactionsByDay->map(function ($dayTransactions) {
            return [
                'total_transactions' => $dayTransactions->count(),
                'total_amount' => $dayTransactions->sum('amount'),
                'average_amount' => $dayTransactions->average('amount'),
            ];
        });
        return [
            'totalTransactions' => $totalTransactions,
            'totalAmount' => $totalAmount,
            'averageAmount' => $averageAmount,
            'dailyStats' => $dailyStats,
        ];
    }

    public function getWeekTransactions()
    {
        $endDate = Carbon::now();
        $startDate = $endDate->copy()->subWeek();

        return Transaction::whereBetween('created_at', [$startDate, $endDate])->get();

    }
}
