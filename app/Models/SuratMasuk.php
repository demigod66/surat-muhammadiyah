<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    protected $table = 'suratmasuk';
    protected $fillable = [
        'no_surat',
        'asal_surat',
        'isi',
        'kode',
        'tgl_surat',
        'tgl_terima',
        'file_masuk',
        'keterangan'
    ];
}
