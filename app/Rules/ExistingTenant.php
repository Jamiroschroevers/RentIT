<?php

namespace App\Rules;

use App\Models\Tenant;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ExistingTenant implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $tenant = Tenant::where('email', $value)->first();

        if ($tenant === null) {
            $fail('Je :attribute is niet gekoppeld aan een huurwoning.');
        }
    }
}
