<?php

namespace App\Http\Controllers;

class HealthController extends Controller
{
    //
    public function health()
    {
        return api()->response(200, 'Health Check', [true]);
    }
}
