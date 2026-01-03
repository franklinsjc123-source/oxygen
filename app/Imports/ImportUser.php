<?php

namespace App\Imports;

use App\Models\User;

use App\Models\auction\auction;

use Maatwebsite\Excel\Imports\HeadingRowFormatter; 
use Illuminate\Support\Collection; 
use App\Live;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;


class ImportUser implements ToModel, WithStartRow, WithMultipleSheets
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $max_row = 30;
       
            return new auction([
                'admin_id'    => session()->get('login_id'),
               'product_type' => $row[0],
               'product_id'   => $row[1],
               'start_price'  => $row[2],
               'slab'         => $row[3],
               'bid_price'    => $row[4],
               'start_date'   => $row[5],
               'end_date'     => $row[6],          
    
            ]);
        
        
    }

    private $setStartRow = 2;
   
    public function startRow(): int
    {
        return 2;
    }
    
    public function headingRow(): int
    {
        return 2;
    }
    public function sheets(): array
  {
    return [
      new ImportUser()
    ];
  }
}
