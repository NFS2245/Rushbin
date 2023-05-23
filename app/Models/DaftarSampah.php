<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarSampah extends Model
{
    use HasFactory;
    protected $table = 'daftar_sampah';
    protected $primaryKey = 'id_sampah';
    protected $fillable = [
        'nama_sampah', 'jenis_sampah', 'jumlah_sampah', 'point', 'harga_jual'
    ];
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
{
    parent::boot();

    static::creating(function ($model) {
        $latestId = static::max('id_sampah');

        if ($latestId) {
            $prefix = 'SP-';
            $lastNumber = (int) substr($latestId, strlen($prefix));
            $newNumber = $lastNumber + 1;
            $newId = $prefix . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
        } else {
            $newId = 'SP-0001';
        }

        $model->id_sampah = $newId;
    });
}
}
