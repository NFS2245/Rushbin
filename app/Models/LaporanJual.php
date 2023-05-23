<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanJual extends Model
{
    use HasFactory;
    protected $table = 'transaksi_jual';
    protected $fillable = [
        'kode_transaksi', 'tanggal', 'waktu', 'nama_lengkap', 'total_pembelian'
    ];
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';

    public function transaksiJual()
    {
    return $this->belongsTo(TransaksiJual::class, 'kode_transaksi', 'kode_transaksi');
    }
}