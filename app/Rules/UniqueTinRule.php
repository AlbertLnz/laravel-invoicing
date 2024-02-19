<?php

namespace App\Rules;

use App\Models\Company;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueTinRule implements ValidationRule
{

    public $user_id;

    public function __construct($user_id){
        $this->user_id = $user_id;
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

        $company = Company::where('tin', $value)->where('user_id', $this->user_id)->first();    
    
        if($company) {
            $fail('The company already exists for your user!');
        }

    }
}
