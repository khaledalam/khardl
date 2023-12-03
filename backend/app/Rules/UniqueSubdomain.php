<?php

namespace App\Rules;

use App\Actions\CreateTenantAction;
use App\Models\Domain;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueSubdomain implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $domain = CreateTenantAction::generateSubdomain($value);
        if ( Domain::where('domain', $domain)->exists()) {
            $fail(__("This restaurant name already taken"));
        }
    }
}
