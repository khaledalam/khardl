<?php

namespace App\Models\Tenant;

use Carbon\Carbon;
use App\Models\Tenant\Branch;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\JsonResponse;

class OrderTableInvoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'n_of_guests',
        'date_time',
        'environment',
        'user_id',
        'note',
        'new_user',
        'status'
    ];
    public function user(){
        return $this->belongsTo(RestaurantUser::class);
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public static function ValidateDateTime($branch_id,$datetime): JsonResponse {
        $branch = Branch::Active()->findOrFail($branch_id);
        $datetime = Carbon::createFromFormat('Y-m-d H', $datetime);

        $dayOfWeek = strtolower($datetime->format('l'));

        if ($branch->{$dayOfWeek . '_closed'}) {
            return response()->json(['valid' => false, 'message' => __('The branch is closed on this day.')]);
        }

        $openTime = Carbon::parse($branch->{$dayOfWeek . '_open'});
        $closeTime = Carbon::parse($branch->{$dayOfWeek . '_close'});
        $existingOrder = OrderTableInvoice::where('branch_id', $branch_id)
        ->whereDate('date_time', $datetime)
        ->exists();

        if ($existingOrder) {
            return response()->json(['valid' => false, 'message' => __('Selected date time has been booked by another customer')]);
        }

        if ($datetime->between($openTime, $closeTime)) {
            return response()->json(['valid' => true]);
        } else {
            return response()->json(['valid' => false, 'message' => __('Selected time is outside the branch operating hours.')]);
        }
    }
}
