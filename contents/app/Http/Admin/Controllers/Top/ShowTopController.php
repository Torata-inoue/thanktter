<?php

namespace App\Http\Admin\Controllers\Top;

use App\Http\Admin\Controllers\BaseController;
use Illuminate\View\View;

class ShowTopController extends BaseController
{
    public function __invoke(): View
    {
        return view('admin.top.index');
    }
}
