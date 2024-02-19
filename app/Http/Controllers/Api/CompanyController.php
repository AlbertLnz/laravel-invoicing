<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
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
            'tin' => 'required | string',
            'direction' => 'required | string',
            'logo_path' => 'nullable | string',
            'root_user' => 'required | string',
            'root_password' => 'required | string',
            'certificate' => 'required | file | mimes:pem,txt', // accept .pem or .txt
        ]);

        $data['certificate_path'] = $request->file('certificate')->store('certificatesFolder');

        return $data;
    }

    public function show(Company $company) {
        //
    }

    public function update(Request $request, Company $company) {
        //
    }

    public function destroy(Company $company) {
        //
    }
}
