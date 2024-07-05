<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GetController extends Controller
{
    public function __invoke()
    {
        return response()->json('asasdf');
        // TODO: Implement __invoke() method.
    }
}
