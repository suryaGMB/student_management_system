<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use App\Models\College;
use App\Models\Batch;
use App\Models\Department;
use App\Models\Section;


class UserImport implements ToModel,WithHeadingRow
{
    protected $collegeId;
    protected $batchId;
    protected $departmentId;
    protected $sectionId;

    public function __construct($collegeId, $batchId, $departmentId, $sectionId)
    {
        $this->collegeId = $collegeId;
        $this->batchId = $batchId;
        $this->departmentId = $departmentId;
        $this->sectionId =$sectionId;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    
    public function model(array $row)
    {
        $user = User::where('email', $row['email'])->first();
// dd(  $user);
        // dd($row);
        if ($user) {
            // Update name and phone_number for existing user
            $user->name = $row['name'];
            $user->phone_number = $row['phone_number'];
            $user->save();
        } else {
            
            // Insert new user
            return new User([
                'name' => $row['name'],
                'email' => $row['email'],
                'phone_number' => $row['phone_number'],
                'password' => bcrypt($row['password']), 
                'user_type' => 'users',
                'college_id' => $this->collegeId, // Store the name of the selected college
                'batch_id' => $this->batchId, // Store the name of the selected batch
                'department_id' => $this->departmentId, // Store the name of the selected department
                'section_id' => $this->sectionId, // Store the name of the selected section
            ]);
            
        }

    }
}
