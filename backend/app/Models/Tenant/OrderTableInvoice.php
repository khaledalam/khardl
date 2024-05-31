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
        'branch_id',
        'status'
    ];
  

    public function user(){
        return $this->belongsTo(RestaurantUser::class);
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function scopeWhenSearch($query,$search)
    {
        return $query->when($search != null, function ($q) use ($search) {
            return $q
            ->whereHas('user',function($q2)use($search){
                return $q2->where('first_name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%');
            })
            ->orWhere('new_user', 'like', '%' . $search . '%')
            ->orWhere('environment', 'like', '%' . $search . '%');
        });
    }
    public function scopeWhenStatus($query,$status)
    {
        return $query->when($status != null, function ($q) use ($status) {
            return $q->where('status', $status);
        });
    }
    public function scopeWhenDateString($query, $date)
    {
        return $query->when($date != null, function ($q) use ($date) {
            if ($date == 'today') {
                request()->merge(['start_date' => now()->toDateString()]);
                request()->merge(['end_date' => now()->toDateString()]);
                return $q
                ->whereDate('created_at', now()->toDateString())
                ->OrWhere('date_time', now()->toDateString());
            } elseif ($date == 'last_day') {
                request()->merge(['start_date' => now()->subDay()->toDateString()]);
                request()->merge(['end_date' => now()->subDay()->toDateString()]);
                return $q->whereDate('created_at', now()->subDay()->toDateString())
                ->OrWhere('date_time', now()->subDay()->toDateString());
            } elseif ($date == 'this_week') {
                $startDate = now()->startOfWeek();
                $endDate = now()->endOfWeek();
                request()->merge(['start_date' => $startDate?->format('Y-m-d')]);
                request()->merge(['end_date' => $endDate->format('Y-m-d')]);
                return $q->whereBetween('created_at', [$startDate, $endDate])
                ->orWhereBetween('date_time', [$startDate, $endDate]);
            } elseif ($date == 'last_week') {
                $startDate = Carbon::now()->subDays(7)->startOfDay();
                $endDate = Carbon::now()->subDays(1)->endOfDay();
                request()->merge(['start_date' => $startDate?->format('Y-m-d')]);
                request()->merge(['end_date' => $endDate->format('Y-m-d')]);
                return $q->whereBetween('created_at', [$startDate, $endDate])
                ->orWhereBetween('date_time', [$startDate, $endDate]);
            }  elseif ($date == 'this_month') {
                $startOfMonth = now()->startOfMonth();
                $endOfMonth = now()->endOfMonth();
                request()->merge(['start_date' => $startOfMonth?->format('Y-m-d')]);
                request()->merge(['end_date' => $endOfMonth->format('Y-m-d')]);
                return $q->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->orWhereBetween('date_time', [$startOfMonth, $endOfMonth]);
            } elseif ($date == 'last_month') {
                $startOfLastMonth = now()->subMonth()->startOfMonth();
                $endOfLastMonth = now()->subMonth()->endOfMonth();
                request()->merge(['start_date' => $startOfLastMonth?->format('Y-m-d')]);
                request()->merge(['end_date' => $endOfLastMonth->format('Y-m-d')]);
                return $q->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
                ->orWhereBetween('date_time', [$startOfLastMonth, $endOfLastMonth]);
            } elseif ($date == 'this_year') {
                $startOfYear = now()->startOfYear();
                $endOfYear = now()->endOfYear();
                request()->merge(['start_date' => $startOfYear?->format('Y-m-d')]);
                request()->merge(['end_date' => $endOfYear->format('Y-m-d')]);
                return $q->whereBetween('created_at', [$startOfYear, $endOfYear])
                ->orWhereBetween('date_time', [$startOfYear, $endOfYear]);
            } elseif ($date == 'last_year') {
                $startOfLastYear = now()->subYear()->startOfYear();
                $endOfLastYear = now()->subYear()->endOfYear();
                request()->merge(['start_date' => $startOfLastYear?->format('Y-m-d')]);
                request()->merge(['end_date' => $endOfLastYear->format('Y-m-d')]);
                return $q->whereBetween('created_at', [$startOfLastYear, $endOfLastYear])
                ->orWhereBetween('date_time', [$startOfLastYear, $endOfLastYear]);
            }elseif ($date == 'future') {
                $startDate =now()->startOfDay();
                $endDate = now()->addYear()->startOfYear();
                request()->merge(['start_date' => $startDate->format('Y-m-d')]);
                request()->merge(['end_date' => $endDate->format('Y-m-d')]);
                return $q->whereBetween('created_at', [$startDate, $endDate])
                    ->orWhereBetween('date_time', [$startDate, $endDate]);
            }
        });
    }
    
}
