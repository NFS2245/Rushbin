<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pickup extends Model
{
    use HasFactory;
    protected $table = 'pickup';
    protected $fillable = [
        'id_pengantaran', 'nama_lengkap', 'alamat', 'tanggal', 'gambar1' 
    ];
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';

}