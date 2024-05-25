<?php

namespace App\Rules;

use App\Actions\CreateTenantAction;
use App\Models\Domain;
use App\Models\Tenant\RestaurantUser;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueSubdomain implements ValidationRule
{

    public function __construct(public $except = null)
    {
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $domain = CreateTenantAction::generateSubdomain($value);
        $domainQuery = Domain::where('domain', $domain);
        $userQuery = User::where('restaurant_name', $value);
        if ($this->except) {
            $userQuery->where('id', '!=', $this->except);
        }

        if ($domainQuery->exists() || $userQuery->exists()) {
            $fail(__("This restaurant name is already taken"));
        }
    }
}
