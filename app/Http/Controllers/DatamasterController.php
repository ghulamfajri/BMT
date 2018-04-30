<?php

namespace App\Http\Controllers;

use App\Repositories\InformationRepository;
use App\Simpanan;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rekening;
use Illuminate\Support\Facades\Validator;

class DatamasterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $id_role;
    protected $rekening;

    public function __construct(
        Rekening $rekening,
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

    public function get_id($id){
        $induks = array();
        if ($id == "master") {
            $induk = $this->informationRepository->getInduk();
            if (count($induk) == 0)
                $new_id = "1";
            else
                $new_id = $induk[0]['id_rekening'] + 1;
            $id_induk = "master";
        } else {
            $subid = $id . ".%";
            $subidk = substr_count($id, '.');
            $id_induk = $id;
            $induk = $this->informationRepository->getSubInduk($subid);
            foreach ($induk as $id){
                if(substr_count($id, '.')==$subidk+1)
                    array_push($induks ,$id);
            }

            if (count($induks) == 0) {
                $new_id = $id . ".1";
            }
            else {
                $revers = strrev($induks[0]);
                $next = str_before($revers, '.');
                $prev = str_after($revers, '.');
                $prev_back = (strrev($prev));
                $next_back = (strrev($next)) + 1;
                $new_id = $prev_back . "." . $next_back;
            }
        }
        $data['id'] =$new_id;
        $data['induk'] =$id_induk;
        return $data;

    }

//   Data Master REKENING start here
    public function add_rekening(Request $request){
        $data = $this->get_id($request->id_rekening);
        $inputRekening = new Rekening();
        $inputRekening->id_rekening=$data['id'];
        $inputRekening->id_induk=$data['induk'];
        $inputRekening->nama_rekening=$request->namaRek;
        $inputRekening->jenis_rekening=$request->tipeRek;

        if($inputRekening->save())  $status = ["success" ,"Data Rekening berhasil diubah"];
        else $status = ["danger" ,"Data Rekening berhasil diubah"];

        return back();

//        return Redirect::route('admin.datamaster.rekening.add_rekening')->with( ['status' => $status] );;


//        $dropdown_data = Rekening::select('id_rekening', 'nama_rekening', 'jenis_rekening', 'detail')->where('jenis_rekening', "!=","detail")->get();
//        $data = Rekening::select('id_rekening', 'nama_rekening', 'jenis_rekening', 'detail')->get();
//
//        return view('admin.datamaster.rekening',[
//            'data' => $data,
//            'dropdown_rekening' => $dropdown_data,
//            'status' => $status
//        ]);
    }
    public function edit_rekening(Request $request){
        $rekening = $this->informationRepository->getRekening($request->id_);
        $data =$this->get_id($request->indukRek);
        if (!$rekening) {
            $rekening = New Rekening();
            $rekening->id_rekening = $data['id'];
            $rekening->id_induk = $request->indukRek;
            $rekening->nama_rekening = $request->namaRek;
            $rekening->jenis_rekening = $request->tipeRek;
        } else {
            $rekening->id_rekening = $data['id'];
            $rekening->id_induk = $request->indukRek;
            $rekening->nama_rekening = $request->namaRek;
            $rekening->jenis_rekening = $request->tipeRek;
        }
        if($rekening->save())  $status = ["success" ,"Data Rekening berhasil diubah"];
        else $status = ["danger" ,"Data Rekening berhasil diubah"];

        return back();
    }

    public function delete_rekening(Request $request)
    {
        if (count($rekening = $this->informationRepository->getRekening($request->id_)) > 0){
            $status = ["success", "Data Rekening berhasil diubah"];
            Rekening::where('id_rekening', ($request->id_))->delete();
        }
        else
            $status = ["danger" ,"Data Rekening berhasil diubah"];
        return back();
    }

//end of Data master REKENING


//   Data Master ANGGOTA start here
    public function add_anggota(Request $request){

        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_ktp' => 'required|string|digits:4|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $date = Carbon::now('Asia/Jakarta');
        $inputUser = new User();
        $inputUser->no_ktp= $request['no_ktp'];
        $inputUser->nama= $request['nama'];
        $inputUser->alamat= $request['alamat'];
        $inputUser->tanggal_registrasi= $date;
        $inputUser->password= bcrypt($request['password']);
        $inputUser->tipe= $request['tipe'];

        if($inputUser->save())  $status = ["success" ,"Data Rekening berhasil diubah"];
        else $status = ["danger" ,"Data Rekening berhasil diubah"];

        return back();
    }

    public function edit_anggota(Request $request){
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_ktp' => 'required|string|digits:4|unique:users',
        ]);

        $inputUser = $this->informationRepository->getAnggota($request->id_);
        if (!$inputUser) {
            $inputUser = New User();
            $inputUser->no_ktp= $request['no_ktp'];
            $inputUser->nama= $request['nama'];
            $inputUser->alamat= $request['alamat'];
            $inputUser->tipe= $request['tipe'];
        }
        else {
            $inputUser->no_ktp= $request['no_ktp'];
            $inputUser->nama= $request['nama'];
            $inputUser->alamat= $request['alamat'];
            $inputUser->tipe= $request['tipe'];
        }
        if($inputUser->save())  $status = ["success" ,"Data User berhasil diubah"];
        else $status = ["danger" ,"Data User berhasil diubah"];

        return back();
    }

    public function delete_anggota(Request $request)
    {
        if (count($this->informationRepository->getAnggota($request->id_)) > 0){

            $status = ["success", "Data User berhasil dihapus"];
            User::where('no_ktp', ($request->id_))->delete();
        }
        else
            $status = ["danger" ,"Data User gagal dihapus"];
        return back();
    }

    public function editPwd_anggota(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);
        $inputUser = $this->informationRepository->getAnggota($request->no_ktp);
        if (!$inputUser) {
            $status = ["danger" ,"Password User gagal diubah"];
        }
        else {
            $inputUser->password= bcrypt($request->password);
            $inputUser->save();
            $status = ["success", "Password User berhasil diubah"];
        }
        return back();
    }
//end of Data master ANGGOTA

//   Data Master SIMPANAN start here
    public function add_simpanan(Request $request){
        $simpanan = $this->informationRepository->getRekening($request->idRek);
        $sim = $this->informationRepository->getSimpanan($request->idRek);
        if(count($sim)==0){
            $inputSim = new Simpanan();
            $inputSim->id_simpanan= $simpanan['id'];
            $inputSim->id_rekening= $request['idRek'];
            $inputSim->jenis_simpanan= $simpanan['nama_rekening'];
            $inputSim->nisbah= $request['nisbah'];
            $inputSim->saldo_minimal= $request['saldo'];
            if($inputSim->save())  $status = ["success" ,"Data Rekening berhasil diubah"];
        }
        else $status = ["danger" ,"Data Rekening berhasil diubah"];


        return back();
    }

    public function edit_simpanan(Request $request){
        $inputSim = $this->informationRepository->getSimpanan($request->id_);
        if (!$inputSim) {
            $status = ["danger" ,"Data Jenis Simpanan berhasil diubah"];
        }
        else {
            $inputSim->nisbah= $request->nisbah;
            $inputSim->saldo_minimal= $request->saldo;
            if($inputSim->save())  $status = ["success" ,"Data Jenis Simpanan berhasil diubah"];
        }
        return back();
    }

    public function delete_simpanan(Request $request)
    {
        if (count($this->informationRepository->getSimpanan($request->id_)) > 0){
            $status = ["success", "Data Simpanan berhasil dihapus"];
            Simpanan::where('id_rekening', ($request->id_))->delete();
        }
        else
            $status = ["danger" ,"Data Seimpanan gagal dihapus"];
        return back();
    }

//end of Data master SIMPANAN

}
