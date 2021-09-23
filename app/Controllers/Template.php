<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Template extends BaseController
{
    public function index()
    {
        $data = [
            'title' => "Blog - Posts"
        ];
        return view('v_admin');
    }
}
