<?php

namespace App\Repositories;
use Illuminate\Support\Facades\Log;
use App\Models\Company;
use App\Notifications\CompanyRegister;
/**
 * Class CompanyRepository.
 */
class CompanyRepository
{
    public function allCompanies(){
        $company = Company::paginate(10);
        return \App\Helper\ResponseBuilder::json('', $company, 200);
    }
    public function create(array $data)
    {
        try{
            $company = Company::create($data);
            $company->notify(new CompanyRegister());
        }catch(\Exception $e){
            Log::error($e);
            dd($e->getMessage());
            return \App\Helper\ResponseBuilder::json('Something,went wrong can\'t process your request', null, 404 );
        }
        return \App\Helper\ResponseBuilder::json('Company is successfully created.', null, 200);
    }

    public function update($company, array $data)
    {
        if ($data['email'] !== $company->email) {
            // Check if the new email already exists (excluding the current company's ID)
            $existingCompany = Company::where('email', $data['email'])
                ->where('id', '!=', $company->id)
                ->first();
    
            if ($existingCompany) {
                return \App\Helper\ResponseBuilder::json('Company already exist with this email', null, 404 );
            }
        }
        try{
            $company->update($data);
        }catch(\Exception $e){
            Log::error($e);
            dd($e->getMessage());
            return \App\Helper\ResponseBuilder::json('Something,went wrong can\'t process your request', null, 404 );
        }
        return \App\Helper\ResponseBuilder::json('Company update successfully', null, 404 );
    }
    public function uploadFile($request){
        $logo = $request->file('logo');
        $logoName = time() . '.' . $logo->getClientOriginalExtension();
        $logo->storeAs('public/logos', $logoName);
        $imageUrl = asset('storage/logos/' . $logoName);
        return $imageUrl;
}
}
