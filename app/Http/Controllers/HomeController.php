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
        $view = Auth::user()->role == 'admin' ? 'perpus.index' : 'user.home';
        return view($view, ['perpuses' =>  $this->BookRepo->getData($request)]);
    }

    public function show(Perpus $id){
        return view('user.show', compact('id'));
    }
}
