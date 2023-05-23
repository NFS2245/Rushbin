<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiCustomer extends Model
{
    use HasFactory;
    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';
    protected $fillable = [
        'id_pengguna', 'nama_lengkap', 'telepon', 'alamat1', 'alamat2', 'alamat3', 'point', 'username' 
    ];
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';

}