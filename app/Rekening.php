<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    protected $table = 'rekening';

    protected $fillable = [
        'id',
        'id_rekening',
        'id_induk',
        'nama_rekening',
        'jenis_rekening',
        'detail',
    ];
    //
}
