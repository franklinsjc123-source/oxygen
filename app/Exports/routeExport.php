<?php

namespace App\Exports;

use App\Models\Route;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class routeExport implements FromCollection,WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Route::all();
    }

    public function headings():array{
        return[
            'id', 'zonal_id','name', 'description','status','flag','createdBy','created_at','updated_at'
        ];
    } 
}
