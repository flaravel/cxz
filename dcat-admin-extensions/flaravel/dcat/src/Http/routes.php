<?php

use Flaravel\Dcat\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('dcat', Controllers\DcatController::class.'@index');