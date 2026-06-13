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
                'product_type'=> '1',
                'product_id'  => $row[0],
                'start_price' => $row[1],
                'slab'        => $row[2],
                'bid_price'   => (int)$row[1] + (int)$row[2],
                'start_date'  => $this->parseDate($row[3]),
                'end_date'    => $this->parseDate($row[4]),          
            ]);
        
        
    }

    private function parseDate($value)
    {
        if (empty($value)) {
            return null;
        }

        // If it's already a DateTime object
        if ($value instanceof \DateTime) {
            return $value->format('Y-m-d H:i:s');
        }

        // If it's a numeric Excel serial date
        if (is_numeric($value) && $value > 40000 && $value < 60000) {
            try {
                return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value)->format('Y-m-d H:i:s');
            } catch (\Exception $e) {
                // Fallback
            }
        }

        // Otherwise try to parse it as a string
        try {
            return date('Y-m-d H:i:s', strtotime($value));
        } catch (\Exception $e) {
            return null;
        }
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
