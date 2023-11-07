<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class WorkerController extends Controller
{
    public function branches(){

        $user = Auth::user();

        $branch = DB::table('branches')
            ->where('id', $user->branch_id)
            ->first();

        return view('worker.branches', compact('user', 'branch'));
    }
}
