<?php

namespace App\Exports;

use App\Models\PinCode\PinCode;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class pincodeExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PinCode::all();
    }
    public function headings():array{
        return[
             'id','zonal_id', 'route_id', 'name', 'area', 'post_region', 'status','flag', 'createdBy','created_at','updated_at'
        ];
    } 
}
