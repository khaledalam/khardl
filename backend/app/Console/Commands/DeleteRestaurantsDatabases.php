<?php

namespace App\Console\Commands;

use App\Jobs\CreateTenantAdmin;
use App\Models\User;
use App\Models\Tenant;
use Database\Seeders\UserSeeder;
use Illuminate\Console\Command;
use Database\Seeders\TenantActionSeeder;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\DB;

class DeleteRestaurantsDatabases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:tenants';

    /**
     * The console Delete all tenants.
     *
     * @var string
     */
    protected $description = 'Create a new tenant with subdomain and DB';

    /**
     * Execute the console command.
     *
     * [BE CAREFUL] Delete all databases the start with "restaurant_" prefix
     */
    public function handle()
    {
        try {
            $tenants = Tenant::all();

            foreach ($tenants as $tenant) {
                $tenant->run(function ($tenant) {
                    $databaseName = DB::connection()->getDatabaseName();
                    DB::query("DROP DATABASE $databaseName;");
                    $this->info("Deleted tenant $databaseName!");
                });
            }


        }catch(\Throwable $e){
            $this->error("Failed to delete tenants");
            return ;
        }

        $this->info("All tenants deleted successfully!");
    }
}
