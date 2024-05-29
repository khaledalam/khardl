<?php
namespace App\Rules;

use Closure;
use Carbon\Carbon;
use App\Models\Tenant\Branch;
use App\Models\Tenant\OrderTableInvoice;
use Exception;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidateTableDatetime implements ValidationRule
{
    protected $branch_id;
    protected $message;

    public function __construct($branch_id)
    {
        $this->branch_id = $branch_id;
    }
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            $branch = Branch::Active()->findOrFail($this->branch_id);
            $datetime = Carbon::createFromFormat('Y-m-d H', $value);
    
            $dayOfWeek = strtolower($datetime->format('l'));
    
            if ($branch->{$dayOfWeek . '_closed'}) {
                $fail(__('The branch is closed on this day.'));
                return;
            }
    
            $openTime = Carbon::parse($branch->{$dayOfWeek . '_open'});
            $closeTime = Carbon::parse($branch->{$dayOfWeek . '_close'});
    
            if (!$datetime->between($openTime, $closeTime)) {
                $fail(__('Selected time is outside the branch operating hours.'));
                return;
            }
    
            $existingOrder = OrderTableInvoice::where('branch_id', $this->branch_id)
                ->where('date_time', $datetime)
                ->exists();
    
            if ($existingOrder) {
                $fail(__('Selected date time has been booked by another customer'));
                return;
            }
        }catch(Exception $e){
            $fail(__('Selected time is outside the branch operating hours.'));
        }
      
    }
}