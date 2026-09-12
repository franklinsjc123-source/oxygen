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
		$pincodeName = trim((string) $row[1]);
		if (empty($pincodeName)) {
			return null;
		}
		$zonal = Zonal::where('name', $row[0])->first();
		$zonalId = $zonal ? $zonal->id : 1;

		// Update existing record or create a new one based on unique 'name'
		PinCode::updateOrCreate(
			[
				'name' => $pincodeName,
			],
			[
				'zonal_id'    => $zonalId,
				'area'        => $row[2],
				'post_region' => $row[3],
				'status'      => $row[4] ?? 1,
				'flag'        => 1,
				'createdBy'   => 1,
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
