<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller
{

    public function index(Request $request) {
        dd($request->all());
    }

    public function store(Request $request) {
        dd($request->all());
    }
}
