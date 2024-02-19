<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Rules\UniqueTinRule;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class CompanyController extends Controller
{
    
    public function index() {

        $user = JWTAuth::user();
        
        return $user;
    }

    public function store(Request $request) {
        
        // $certificate = $request->file('certificate');
        // $certificate->extension();
        
        $data = $request->validate([
            'entity_type' => 'required | string',
            'tin' => [
                'required',
                'string',
                'regex:/^(10|20)\d{9}$/', // starts 10 or 20, then 9 digital numbers. EX: 20123456789
                new UniqueTinRule(JWTAuth::user()->id)
            ],
            'direction' => 'required | string',
            'logo' => 'nullable | image',
            'root_user' => 'required | string',
            'root_password' => 'required | string',
            'certificate' => 'required | file | mimes:pem,txt', // accept .pem or .txt
        ]);

        if($request->hasFile('logo')) {
            $data['logo_path'] = $request->file('logo')->store('logosFolder');
        }

        $data['certificate_path'] = $request->file('certificate')->store('certificatesFolder');
        $data['user_id'] = JWTAuth::user()->id;

        $company = Company::create($data);

        return response()->json([
            'message' => 'Company created successfully!',
            'company' => $company
        ]);
    }

    public function show($companyTin) {
        
        $userId = JWTAuth::user()->id;
        $company = Company::where('tin', $companyTin)->where('user_id', $userId)->firstOrFail();

        return response()->json($company, 200);
    }

    public function update(Request $request, Company $company) {
        //
    }

    public function destroy(Company $company) {
        //
    }
}
