<?php

namespace App\Rules;

use App\Models\Company;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueTinRule implements ValidationRule
{

    public $company_id;

    public function __construct($company_id = null){
        $this->company_id = $company_id;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // php artisan make:rule UniqueTinRule
        // dd($attribute, $value); // ej: ( tin, valueSended )

        $company = Company::where('tin', $value)->
                            where('user_id', auth()->user()->id)->
                            when($this->company_id, function($query, $company_id){
                                $query->where('id', '!=', $company_id);
         })->first();    
        
        // ===

        // $company = Company::where('tin', $value)->
        //                     where('user_id', auth()->user()->id)->
        //                     where('id', '!=', $this->company_id)->
        //                     first();    
    
        if($company) {
            $fail('The company already exists for your user!');
        }

    }
}
