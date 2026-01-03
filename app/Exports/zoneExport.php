<?php

namespace App\Exports;

use App\Models\Zonal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class zoneExport implements FromCollection,WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Zonal::all();
    }
    public function headings():array{
        return[
            'id', 'name','status','flag','createdBy','created_at','updated_at'
        ];
    } 
}
