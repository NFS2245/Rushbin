<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiBeli extends Model
{
    use HasFactory;
    protected $table = 'laporan_beli';
    protected $primaryKey = 'kode_transaksi';
    protected $fillable = [
        'kode_transaksi', 'id_sampah','harga_jual', 'nama_sampah', 'point','jumlah_sampah' 
    ];
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();
    
        static::creating(function ($model) {
            $latestId = static::max('kode_transaksi');
    
            if ($latestId) {
                $prefix = 'TB';
                $lastNumber = (int) substr($latestId, strlen($prefix));
                $newNumber = $lastNumber + 1;
                $newId = $prefix . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
            } else {
                $newId = 'TB00001';
            }
    
            $model->kode_transaksi = $newId;
        });
    }
    }