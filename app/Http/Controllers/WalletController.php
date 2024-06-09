<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function credit(Request $request)
    {
        $request->validate([
            'wallet_id' => 'required|exists:wallets,id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $this->mproxy->creditWallet($request);

        return response()->json(['message' => 'Amount credited successfully']);
    }

    public function debit(Request $request)
    {
        $request->validate([
            'wallet_id' => 'required|exists:wallets,id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $this->mproxy->debitWallet($request);

        return response()->json(['message' => 'Amount debited successfully']);
    }

    public function balance($userId)
    {
        $balance = $this->mproxy->getBalance($userId);
        return response()->json(['balance' => $balance]);
    }
}
