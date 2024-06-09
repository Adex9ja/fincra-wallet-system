<?php

namespace App\Models;


class TransactionType
{
    const debit = "debit";
    const credit = "credit";

    public static function getPill($trans_type)
    {
        switch ($trans_type) {
            case "debit":
                return "badge-danger";
            case "credit":
                return "badge-success";
            default:
                return null;
        }
    }
}
