<?php

namespace Database\Seeders\Tenant;

use Carbon\Carbon;
use App\Models\Tenant\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentDateTime = Carbon::now();
        Branch::create([
            'name' => 'Branch 1',
            'lat' => '37.7',
            'lng' => '37.7',
            'is_primary' => true,
            'saturday_open' => $currentDateTime->format('H:i'),
            'saturday_close' => $currentDateTime->addHour()->format('H:i'),
            'sunday_open' => $currentDateTime->format('H:i'),
            'sunday_close' => $currentDateTime->addHour()->format('H:i'),
            'monday_open' => $currentDateTime->format('H:i'),
            'monday_close' => $currentDateTime->addHour()->format('H:i'),
            'tuesday_open' => $currentDateTime->format('H:i'),
            'tuesday_close' => $currentDateTime->addHour()->format('H:i'),
            'wednesday_open' => $currentDateTime->format('H:i'),
            'wednesday_close' => $currentDateTime->addHour()->format('H:i'),
            'thursday_open' => $currentDateTime->format('H:i'),
            'thursday_close' => $currentDateTime->addHour()->format('H:i'),
            'friday_open' => $currentDateTime->format('H:i'),
            'friday_close' => $currentDateTime->addHour()->format('H:i'),
        ]);



        

    }
}
