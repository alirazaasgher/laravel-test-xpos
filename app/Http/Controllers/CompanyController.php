<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use App\Repositories\CompanyRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
      protected $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return $this->companyRepository->allCompanies();
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
    public function store(CompanyRequest $request)
    {
        //
        $data = $request->validated();
        if($request->hasFile('logo')){
            $data['logo'] = $this->companyRepository->uploadFile($request);
        }
        return $this->companyRepository->create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
        return \App\Helper\ResponseBuilder::json('',$company, 200);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, Company $company)
    {
        //
        $data = $request->validated();
        if($request->hasFile('logo')){
            $data['logo'] = $this->companyRepository->uploadFile($request);
        }
        return $this->companyRepository->update($company,$data);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
        $company->delete();
        return \App\Helper\ResponseBuilder::json('Company Deleted succesfully',null, 204);

    }

 
}
