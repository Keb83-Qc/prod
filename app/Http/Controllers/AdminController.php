<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Retourne la vue du tableau de bord
        return view('admin.dashboard');
    }
}
