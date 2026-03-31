<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //// ProfileController
public function edit() { return view('admin.profile.edit'); }
public function update() { return back(); }
}
