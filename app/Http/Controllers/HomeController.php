<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeleProvider;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $providers = TeleProvider::orderBy("name")->get();

        return view('input', [
            "providers" => $providers
        ]);
    }

    public function output()
    {
        $providers = TeleProvider::orderBy("name")->get();

        return view('output', [
            "providers" => $providers
        ]);
    }
}
