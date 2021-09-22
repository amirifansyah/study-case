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
        $authid = Auth::user()->role;
        if($authid == 'admin'){
            $perpus = $this->BookRepo->getdata($request);
            $perpuses = $perpus['message'];
            return view('Perpus.index', compact('perpuses'));
        }else{
            $perpus = $this->BookRepo->getdata($request);
            $perpuses = $perpus['message'];
            return view('User.home', compact('perpuses'));
        };
        // return view('home');
    }

    public function show(Perpus $id){
        return view('User.show', compact('id'));
    }
}
