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
        //
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
