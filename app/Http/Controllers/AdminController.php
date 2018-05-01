<?php

namespace App\Http\Controllers;

use App\Repositories\InformationRepository;
use App\Simpanan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rekening;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    public function profile(){
        $data = $this->informationRepository->getAnggota(Auth::user()->no_ktp);
        return view('admin.profile',[
            'data' => $data,
        ]);
    }

    public function edit_pass(Request $request) {

        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $old = $request->password_old;
        $new = $request->password;
        if (Hash::check($old, Auth::user()->password)) {
            $pass = Hash::make($new);
            User::where('no_ktp', Auth::user()->no_ktp)->update(['password'=> $pass]);
            $status = ["success" ,"Password Berhasil Diubah"];
        }
        else {
            $status = ["danger", "Password Salah"];
        }
        return back();
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
