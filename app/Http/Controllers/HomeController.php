<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     *
     */

    protected $id_role;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if(Auth::user()->tipe=="admin"){
                return redirect('admin')->with('status', [
                    'enabled'       => true,
                    'type'          => 'success',
                    'content'       => 'Berhasil login!'
                ]);
            }else if(Auth::user()->tipe=="anggota"){
                return redirect('anggota')->with('status', [
                    'enabled'       => true,
                    'type'          => 'success',
                    'content'       => 'Berhasil login!'
                ]);
            }
            return $next($request);
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->tipe=="admin"){
            return redirect('admin')->with('status', [
                'enabled'       => true,
                'type'          => 'success',
                'content'       => 'Berhasil login!'
            ]);
        }else if(Auth::user()->tipe=="anggota"){
            return redirect('anggota')->with('status', [
                'enabled'       => true,
                'type'          => 'success',
                'content'       => 'Berhasil login!'
            ]);
        }
    }
    public function forbidden(){
        return view ('error.404');
    }

}
