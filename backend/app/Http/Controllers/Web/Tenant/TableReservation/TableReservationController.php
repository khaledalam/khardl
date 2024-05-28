<?php

namespace App\Http\Controllers\Web\Tenant\TableReservation;

use App\Http\Controllers\Controller;
use App\Models\Tenant\OrderTableInvoice;
use Illuminate\Support\Facades\Auth;

class TableReservationController extends Controller
{
 
    public function index()
    {
        $tables = OrderTableInvoice::with('user','branch')->paginate(config('application.perPage')??20);
        $user= Auth::user();
        return view('restaurant.orders.tables.list', compact('tables','user'));

    }

 
}
