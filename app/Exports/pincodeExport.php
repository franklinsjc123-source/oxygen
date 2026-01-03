<?php

namespace App\Exports;

use App\Models\PinCode\PinCode;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PinCodeExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Perform the join and return the data
        return PinCode::join('zonals', 'zonals.id', '=', 'pincode.zonal_id')
            ->get(['pincode.id', 'zonals.name as zonalname', 'pincode.name', 'pincode.area', 'pincode.post_region', 'pincode.status']);
    }

    public function headings(): array
    {
        return [
            'id', 'zonalname', 'name', 'area', 'post_region', 'status'
        ];
    }
}
