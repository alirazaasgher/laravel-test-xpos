<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use App\Repositories\EmployeeRepository;
class EmployeeController extends Controller
{

    protected $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return $this->employeeRepository->allEmployees();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        //

        $data = $request->validated();
        return $this->employeeRepository->create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
        return \App\Helper\ResponseBuilder::json('',$employee, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        //
        $data = $request->validated();
        return $this->employeeRepository->update($employee,$data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
        $employee->delete();
        return \App\Helper\ResponseBuilder::json('Employee Deleted succesfully',null, 204);
    }
}
