<?php

namespace App\Http\Controllers;

use App\Models\Repository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

abstract class Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $product;
    public $user;
    public $mproxy;

    public function __construct()
    {
        $this->product = Config::get('app.name');
        $this->user = Auth::user();
        $this->mproxy = new Repository();
    }

    public function prepareMessage(bool $success, $msg): string
    {
        $msgTemplate = "<div class='row'> <div class='col-md-12 alert alert-success alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a><center>$msg</center></div></div>";
        $errTemplate = "<div class='row'> <div class='col-md-12 alert alert-warning alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a><center>$msg</center></div></div>";
        return $success ? $msgTemplate : $errTemplate;
    }
}
