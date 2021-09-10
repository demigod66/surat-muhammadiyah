<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klasifikasi extends Model
{
    protected $table = 'tbl_klasifikasi';

    protected $fillable = [
        'nama',
        'kode',
        'uraian'
    ];
}
