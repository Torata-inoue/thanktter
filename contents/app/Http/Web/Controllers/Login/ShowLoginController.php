<?php

namespace App\Http\Web\Controllers\Login;

use App\Http\BaseController;
use Illuminate\View\View;

class ShowLoginController extends BaseController
{
    public function index(): View
    {
        return view('login');
    }
}
