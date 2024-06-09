<?php


namespace App\Models;


class UserRoles
{
    const user = 'user';
    const admin = 'admin';

    public static function getPill($trans_type)
    {
        switch ($trans_type) {
            case "user":
                return "badge-primary";
            case "admin":
                return "badge-success";
            default:
                return null;
        }
    }
}
