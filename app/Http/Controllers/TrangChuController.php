<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrangChuController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $vai_tro = Auth::user()->vai_tro;
            if ($vai_tro === 'admin') {
                return redirect()->route('admin.dashboard');
            }
        }
        return view('trang_chu');
    }
}
