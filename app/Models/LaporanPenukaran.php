<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPenukaran extends Model
{
    use HasFactory;
    protected $table = 'penukaran';
    protected $fillable = [
        'id_penukaran', 'id_pengguna', 'id_pengguna', 'point', 'tanggal', 'waktu', 'status' 
    ];
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';

}