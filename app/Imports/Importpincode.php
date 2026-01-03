<?php

namespace App\Imports;

use App\Models\User;
use App\Models\PinCode\PinCode;
use App\Models\Route;
use App\Models\Zonal;
use Maatwebsite\Excel\Imports\HeadingRowFormatter; 
use Illuminate\Support\Collection; 
use App\Live;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class Importpincode implements ToModel, WithStartRow, WithMultipleSheets
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
	{
		// Ensure all required columns exist in the row
		if (!isset($row[0], $row[1], $row[2], $row[3], $row[4])) {
			return null; // Skip rows with missing data
		}
		$zonal = Zonal::where('name', $row[0])->first();
		// Update existing record or create a new one
		PinCode::updateOrCreate(
			[
				// Define the unique key(s) to check for existing records
				'zonal_id' => $zonal->id,
				//'route_id' => $row[1],
				'name'     => $row[1], // Example: use 'name' as a unique identifier
			],
			[
				// Fields to update or insert
				'area'        => $row[2],
				'post_region' => $row[3],
				'status'      => $row[4],
				'flag'        => 1, // Add default value for flag
				'createdBy'   => 1, // Add default value for createdBy
			]
		);

		return null; // Return null because `updateOrCreate` directly handles the database operation
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
        new Importpincode()
        ];
    }
}
