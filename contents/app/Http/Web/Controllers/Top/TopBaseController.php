<?php

namespace App\Http\Web\Controllers\Top;

use App\Http\BaseController;
use Illuminate\View\View;

class TopBaseController extends BaseController
{
    public function index(): View
    {
        return view('app');
    }
}
