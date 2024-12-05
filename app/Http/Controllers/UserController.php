<?php

namespace App\Http\Controllers;

use App\Models\EspacioEstacionamiento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function store(Request $request)
    {

    }

    public function index()
    {
        return "si jala";
    }

    public function show($rfid)
    {

    }
}
