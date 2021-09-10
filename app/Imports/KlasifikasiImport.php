<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Klasifikasi;

class KlasifikasiImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function collection(array $row)
    {
        return new Klasifikasi([
            'id'    => $row[0],
            'nama'  => $row[1],
            'kode'  => $row[2],
            'uraian'    => $row[3],
        ]);
    }
}
