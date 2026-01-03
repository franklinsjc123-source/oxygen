<?php

namespace App\Exports;

use App\Models\Staffcreates;
use App\Models\Route;
use App\Models\Zonal;
use App\Models\Departments;
use App\Models\designation\designation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StaffExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

   
    public function collection()
    {
        return Staffcreates::select(
                'staffother.employee_id',
                'staffother.username',
                'staffother.fullname',
                'staffother.dob',
                'departments.name as department_name', // Department name
                'designation.designation as designation_name', // Designation name
                'staffother.mobileno',
                'staffother.a_mobileno',
                'staffother.email',
                'staffother.qualification',
                'staffother.exprience',
                'staffother.bloodgroup',
                'staffother.doj',
                'staffother.permanant_addr',
                'staffother.curr_addr',
                'staffother.password',
                'staffother.profileimage',
                'staffother.aatherimage',
                'staffother.pancard',
                'staffother.otherdoc',
                'staffother.monthlysalary',
                'staffother.ctc',
                'staffother.dailytarget',
                'staffother.monthlytarget',
                'zonals.name as zone_name',           // Zonal name
                'routes.name as route_name'           // Route name
            )
            ->leftJoin('routes', 'staffother.route_id', '=', 'routes.id')  // Join Route table
            ->leftJoin('zonals', 'staffother.zone_id', '=', 'zonals.id')  // Join Zonal table
            ->leftJoin('departments', 'staffother.department', '=', 'departments.id')  // Join Departments table
            ->leftJoin('designation', 'staffother.designation', '=', 'designation.id')  // Join Designation table
            ->get();
    }

    public function headings():array{
        return[
            
            'employee_id',
            'username',
            'fullname',
            'dob',
            'department',
            'designation',
            'mobileno',
            'a_mobileno',
            'email',
            'qualification',
            'exprience',
            'bloodgroup',
            'doj',
            'permanant_addr',
            'curr_addr',
            'password',
            'profileimage',
            'aatherimage',
            'pancard',
            'otherdoc',
            'monthlysalary',
            'ctc',
            'dailytarget',
            'monthlytarget',
            'zonel',
            'route' 
        ];
    } 
}
