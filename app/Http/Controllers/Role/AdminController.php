<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role == 'admin' ||
                auth()->user()->role == 'super_admin' )
                return $next($request);

            exit('forbidden access');
        });
    }
}
