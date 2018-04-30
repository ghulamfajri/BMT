<?php
/**
 * Created by PhpStorm.
 * User: Ghulam Fajri
 * Date: 4/30/2018
 * Time: 2:08 PM
 */

namespace App\Repositories;

use App\Rekening;
use App\Simpanan;
use App\User;

class InformationRepository {

    protected $kategori;
    protected $informasi;
    protected $foto;
    function __construct(
        Rekening $rekening,
        User $user,
        Simpanan $simpanan
    ){
        $this->rekening = $rekening;
        $this->user = $user;
        $this->simpanan = $simpanan;
    }

//    REKENING
    function  getRekening($id){
        $data = $this->rekening->where('id_rekening',$id)->first();
        return $data;
    }

    function  getAllRekening(){
        $data = $this->rekening->select('id_rekening', 'nama_rekening', 'jenis_rekening', 'id_induk', 'detail')->get();
        return $data;
    }

    function  getInduk(){
        $data = $this->rekening->select('id_rekening')->where('jenis_rekening', "master")->orderBy('id_rekening', 'DESC')->get()->toArray();
        return $data;
    }

    function  getDropdown(){
        $data = $this->rekening->select('id_rekening', 'nama_rekening', 'jenis_rekening','id_induk',  'detail')->where('jenis_rekening', "!=","detail")->get();
        return $data;
    }

    function  getSubInduk($subid){
        $data = $this->rekening->select('id_rekening')->where('id_rekening', 'like', $subid)->orderBy('id_rekening', 'DESC')->pluck('id_rekening');
        return $data;
    }

//    ANGGOTA
    function  getAllAnggota(){
        $data = $this->user->select('no_ktp', 'nama', 'alamat', 'tipe', 'tanggal_registrasi')->get();
        return $data;
    }
    function  getAnggota($id){
        $data = $this->user->where('no_ktp',$id)->first();
        return $data;
    }

    //    SIMPANAN
    function  getAllSimpanan(){
        $data = $this->simpanan->select('id', 'id_rekening', 'id_simpanan', 'jenis_simpanan', 'saldo_minimal', 'nisbah')->get();
        return $data;
    }
    function  getSimpanan($id){
        $data = $this->simpanan->where('id_rekening',$id)->first();
        return $data;
    }
    function  getDdSimpanan(){
        $data = $this->rekening->select('id','id_rekening', 'nama_rekening', 'jenis_rekening','id_induk',  'detail')->where('jenis_rekening',"detail")->get();
        return $data;
    }


    function getKategori(){
        $data = $this->kategori->orderBy('id');
        return $data;
    }

    function store($request){
        $data = $this->kategori->create(array(
            'nama'	=> $request['nama']
        ));
        return $data;
    }

    function detail($id){
        $data = $this->kategori->find($id);
        return $data;
    }

    function update($request,$id){
        $data = $this->kategori->where('id',$id)->update(array(
            'nama'	=> $request['nama']
        ));
        return $data;
    }

    function getInformasi($id){
        $data = $this->informasi->select('id','nama','kategori_id','alamat','latitude','longitude','email','website','telp','data')->where('kategori_id',$id)->orderBy('id');
        return $data;
    }

    function detailInformasi($id){
        $data = $this->informasi->find($id);
        return $data;
    }

    function informationUpdate($request,$id){
        $data = $this->informasi->where('id',$id)->update(array(
            'nama'		=> $request['nama'],
            'alamat'	=> $request['alamat'],
            'data'		=> $request['data'],
            'latitude'	=> $request['latitude'],
            'longitude'	=> $request['longitude'],
            'email'		=> $request['email'],
            'website'	=> $request['website'],
            'telp'		=> $request['telp']
        ));
        return $data;
    }

    function informationCreate($request,$id){
        $data = $this->informasi->create(array(
            'nama'		=> $request['nama'],
            'alamat'	=> $request['alamat'],
            'data'		=> $request['data'],
            'kategori_id'	=> $id,
            'latitude'	=> $request['latitude'],
            'longitude'	=> $request['longitude'],
            'email'		=> $request['email'],
            'website'	=> $request['website'],
            'telp'		=> $request['telp']
        ));
        return $data;
    }

    function getFoto($id_informasi, $id_kategori){
        $kat = $this->kategori->find($id_kategori);
        if(isWisata($kat->nama)){
            $data = $this->foto
                ->leftJoin('relasi','relasi.fotochild','=','foto.id')
                ->select('foto.id','foto.nama','foto.informasi_id','relasi.nama_parent','relasi.derajat','foto.path')->where('foto.informasi_id',$id_informasi)->orderBy('foto.id');
        }
        else{
            $data = $this->foto->select('id','nama','informasi_id','path')->where('informasi_id',$id_informasi)->orderBy('id');
        }
        return $data;
    }

    function detailFoto($id){
        $data = $this->foto
            ->select('foto.id','foto.nama', 'relasi.fotoparent', 'relasi.derajat',  'relasi.id as relasi_id')
            ->leftJoin('relasi','relasi.fotochild','=','foto.id')
            ->where('foto.id',$id)
            ->first();
        return $data;
    }

    function fotoUpdate($request,$id_foto,$id_informasi,$id_kategori){
        $kat = $this->kategori->find($id_kategori);
        if($request['path'] != "[object FileList]"){
            if(isWisata($kat->nama)){
                $path       = 'informasi/';
                $fileName   = $request['nama'].'-'.$id_informasi.'-'.$request['path']->getClientOriginalName();
                $request['path']->move($path, $fileName);
                $data = $this->foto->where('id',$id_foto)->update(array(
                    'nama'		=> $request['nama'],
                    'path'		=> $path.$fileName,
                ));
                if($request['fotoparent'] !=  '--'){
                    $check = $this->relasi->where('id',$request['relasi_id'])->count();
                    if($check > 0){
                        $data = $this->relasi->where('id',$request['relasi_id'])->update(array(
                            'fotoparent'	=> $request['fotoparent'],
                            'nama_parent'	=> $request['nama_parent'],
                            'fotochild'		=> $id_foto,
                            'derajat'		=> $request['derajat']
                        ));
                    }
                    else{
                        $data = $this->relasi->create(array(
                            'fotoparent'	=> $request['fotoparent'],
                            'nama_parent'	=> $request['nama_parent'],
                            'fotochild'		=> $id_foto,
                            'derajat'		=> $request['derajat']
                        ));
                    }
                }
                else{
                    $data = $this->relasi->where('id',$request['relasi_id'])->delete();
                }

            }
            else{
                $data = $this->foto->where('id',$id_foto)->update(array(
                    'nama'		=> $request['nama'],
                    'path'		=> $path.$fileName,
                ));
            }
        }
        else{
            if(isWisata($kat->nama)){
                $data = $this->foto->where('id',$id_foto)->update(array(
                    'nama'		=> $request['nama']
                ));
                if($request['fotoparent'] !=  '--')
                {
                    $check = $this->relasi->where('id',$request['relasi_id'])->count();
                    if($check > 0){
                        $data = $this->relasi->where('id',$request['relasi_id'])->update(array(
                            'fotoparent'	=> $request['fotoparent'],
                            'nama_parent'	=> $request['nama_parent'],
                            'fotochild'		=> $id_foto,
                            'derajat'		=> $request['derajat']
                        ));
                    }
                    else{
                        $data = $this->relasi->create(array(
                            'fotoparent'	=> $request['fotoparent'],
                            'nama_parent'	=> $request['nama_parent'],
                            'fotochild'		=> $id_foto,
                            'derajat'		=> $request['derajat']
                        ));
                    }
                }
                else{
                    $data = $this->relasi->where('id',$request['relasi_id'])->delete();
                }
            }
            else{
                $data = $this->foto->where('id',$id_foto)->update(array(
                    'nama'		=> $request['nama']
                ));
            }

        }
        return $data;
    }

    function fotoCreate($request,$id,$id_kategori){
        $path       = 'informasi/';
        $fileName   = $request['nama'].'-'.$id.'-'.$request['path']->getClientOriginalName();
        $request['path']->move($path, $fileName);
        $kat = $this->kategori->find($id_kategori);
        if(isWisata($kat->nama)){
            $data = $this->foto->insertGetId(array(
                'nama'			=> $request['nama'],
                'informasi_id'	=> $id,
                'path'			=> $path.$fileName,
            ));

            if($request['fotoparent'] !=  '--')
            {
                $data = $this->relasi->create(array(
                    'fotoparent'	=> $request['fotoparent'],
                    'nama_parent'	=> $request['nama_parent'],
                    'fotochild'		=> $data,
                    'derajat'		=> $request['derajat']
                ));
            }
        }
        else{
            $data = $this->foto->create(array(
                'nama'			=> $request['nama'],
                'informasi_id'	=> $id,
                'path'			=> $path.$fileName,
            ));
        }
        return $data;
    }

    function fotoDelete($request,$id){
        return $this->foto->where('id',$id)->delete();
    }

    function getParent($id){
        $informasi = $this->foto->find($id);
        $nama = $this->informasi->select('id')->where('nama',$informasi->informasi_id)->first();
        $data = $this->foto->where('informasi_id',$nama->id)->where('id','!=',$id)->get();
        return $data;
    }

    function getParentAll($idinformasi){
        $data = $this->foto->where('informasi_id',$idinformasi)->get();
        return $data;
    }

}