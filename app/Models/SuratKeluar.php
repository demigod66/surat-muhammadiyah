<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    protected $table = 'suratkeluar';

    protected $fillable = [
        'no_surat',
        'tujuan_surat',
        'isi',
        'kode',
        'tgl_catat',
        'tlg_surat',
        'filekeluar',
        'keterangan'
    ]
}
