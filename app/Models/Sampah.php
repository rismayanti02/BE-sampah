<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sampah extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sampah';
    protected $fillable = [
        'kepala_keluarga',
        'no_rumah',
        'rt_rw',
        'total_karung_sampah',
        'kriteria',
        'tanggal_pengangkutan'
    ];
    protected $dates = ['deleted_at'];
}
