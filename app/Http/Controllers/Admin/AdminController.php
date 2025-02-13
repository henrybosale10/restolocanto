<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index'); // Assurez-vous que la vue existe et que le slot est bien défini dans cette vue
    }


    public function create()
    {

    }
}
