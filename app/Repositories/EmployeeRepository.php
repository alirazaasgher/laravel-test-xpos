<?php

namespace App\Repositories;
use Illuminate\Support\Facades\Log;
use App\Models\Employee;
/**
 * Class EmployeeRepository.
 */
class EmployeeRepository
{
    public function allEmployees(){
        $employee = Employee::paginate(10);
        return \App\Helper\ResponseBuilder::json('', $employee, 200);
    }
    public function create(array $data)
    {
        try{
            $employee = Employee::create($data);
        }catch(\Exception $e){
            Log::error($e);
            return \App\Helper\ResponseBuilder::json('Something,went wrong can\'t process your request', null, 404 );
        }
        return \App\Helper\ResponseBuilder::json('Employee is successfully created.', null, 200);
    }

    public function update($employee, array $data)
    {
        try{
            $employee->update($data);
        }catch(\Exception $e){
            Log::error($e);
            return \App\Helper\ResponseBuilder::json('Something,went wrong can\'t process your request', null, 404 );
        }
        return \App\Helper\ResponseBuilder::json('Company update successfully', null, 404 );
    }

}
