<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanBeli extends Model
{
    use HasFactory;
    protected $table = 'transaksi_beli';
    protected $fillable = [
        'kode_transaksi', 'tanggal', 'waktu', 'nama_lengkap', 'total_point', 'id_pengguna' 
    ];
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';
    
    public function transaksiBeli()
    {
    return $this->belongsTo(TransaksiBeli::class, 'kode_transaksi', 'kode_transaksi');
    }
}