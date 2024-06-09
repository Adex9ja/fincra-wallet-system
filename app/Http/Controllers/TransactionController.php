<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Laracsv\Export;

class TransactionController extends Controller
{
    public function transactions()
    {
        $data = $this->mproxy->getAllTransactions();
        return view('transaction_list', ['data' => $data ?? null]);
    }

    public function download()
    {
        $transactions = $this->mproxy->getWeekTransactions();

        $csvExporter = new Export();
        $csvExporter->build($transactions, ['wallet_id', 'amount', 'type', 'created_at'])->download();
    }

}
