<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Perpus;
use App\Http\Repositories\BukuRepository;
use App\User;
use App\Http\Requests\PinjamRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $BookRepo;
    public function __construct()
    {
        $this->middleware('auth');
        $this->BookRepo = new BukuRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perpuses = $this->BookRepo->getData($request);
        return (Auth::user()->role == 'admin' ) ? view('perpus.index', compact('perpuses')) : view('user.home', compact('perpuses'));
    }

    public function show(Perpus $id){
        return view('user.show', compact('id'));
    }
}
