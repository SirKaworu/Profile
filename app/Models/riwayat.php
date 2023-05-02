<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class riwayat extends Model
{
    use HasFactory;
    protected $table = "riwayat";
    protected $fillable = ['judul', 'tipe', 'tgl_mulai', 'tgl_akhir', 'info1', 'info2', 'info3', 'isi'];

    protected $appends = ['tgl_mulai_default', 'tgl_akhir_default'];

    public function getTglMulaiDefaultAttribute()
    {
        return Carbon::parse($this->attributes['tgl_mulai'])->translatedFormat('d F Y');
    }
    public function getTglAkhirDefaultAttribute()
    {
        if($this->attributes['tgl_akhir']){
            return Carbon::parse($this->attributes['tgl_akhir'])->translatedFormat('d F Y');
            
        }else {
            return 'present';
        }
    }
}
