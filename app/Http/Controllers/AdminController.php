<?php

namespace App\Http\Controllers;

use App\Repositories\InformationRepository;
use App\Simpanan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rekening;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $id_role;

    public function __construct( Rekening $rekening,
                                 User $user,
                                 Simpanan $simpanan,
                                 InformationRepository $informationRepository)
    {
        $this->middleware(function ($request, $next) {
            $this->id_role = Auth::user()->tipe;
            if(!$this->id_role=="admin")
                return redirect('login')->with('status', [
                    'enabled'       => true,
                    'type'          => 'danger',
                    'content'       => 'Tidak boleh mengakses'
                ]);
            return $next($request);
        });

        $this->rekening = $rekening;
        $this->user = $user;
        $this->simpanan = $simpanan;
        $this->informationRepository = $informationRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('admin.dashboard');
    }

    public function pengajuan_simpanan(){
        return view('admin.simpanan.pengajuan_simpanan');
    }

    public function data_anggota(){
        $data = $this->informationRepository->getAllAnggota();
        return view('admin.datamaster.anggota',[
            'data' => $data,
            'status' => "status"]);
    }

    public function data_rekening(){

        $dropdown_data = $this->informationRepository->getDropdown();
        $data = $this->informationRepository->getAllRekening();
        return view('admin.datamaster.rekening',[
            'data' => $data,
            'dropdown_rekening' => $dropdown_data,
            'status' => "status"]);
    }

    public function data_simpanan(){

        $dropdown_data = $this->informationRepository->getDdSimpanan();
        $data = $this->informationRepository->getAllSimpanan();
        return view('admin.datamaster.simpanan',[
            'data' => $data,
            'dropdown_simpanan' => $dropdown_data,
            'status' => "status"]);
    }



}
