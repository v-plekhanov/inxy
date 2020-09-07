<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;


class DashboardController extends BaseController
{

    public function __invoke()
    {
        return redirect()->route('servers.index');
    }

}
