<?php

namespace App\Console\Commands;

use App\Jobs\CreateTenantAdmin;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Console\Command;
use Database\Seeders\TenantActionSeeder;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\DB;

class AddNewBranchSlotSubToTestTenants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:add-dummy-branch-slot {name=first}';

    /**
     * The console Create a new tenant with subdomain and DB.
     *
     * @var string
     */
    protected $description = 'Create a new dummy branch slot sub';

    /**
     * Execute the console command.
     */
    public function handle(TenantActionSeeder $seeder)
    {
        $name = $this->argument('name') ?? 'first';
        $tenant = Tenant::where('restaurant_name', '=', $name)->first();

        // need to change "first"
        /**
         * USE khardl;

        SET @tenant_database := (SELECT CONCAT('restaurant_', id) FROM tenants WHERE restaurant_name = 'first');
        SELECT @tenant_database;

        SET @query := CONCAT('USE `', @tenant_database, '`');
        PREPARE stmt FROM @query;
        EXECUTE stmt;

        INSERT INTO `r_o_subscriptions` (`id`, `start_at`, `end_at`, `amount`, `number_of_branches`, `subscription_id`, `user_id`, `status`, `created_at`, `updated_at`, `type`, `reminder_email_sent`, `reminder_suspend_email_sent`)
        VALUES (NULL, '2024-01-31', '2025-02-28', '10', '2', 'test_sub_id', '1', 'active', NULL, NULL, 'new', '0', '0');

        DEALLOCATE PREPARE stmt;
         */
        $tenant->run(function () {
            DB::statement(<<<SQL
INSERT INTO `r_o_subscriptions` (`id`, `start_at`, `end_at`, `amount`, `number_of_branches`, `subscription_id`, `user_id`, `status`, `created_at`, `updated_at`, `type`, `reminder_email_sent`, `reminder_suspend_email_sent`)
VALUES (NULL, '2024-01-31', '2025-02-28', '10', '2', 'test_sub_id', '1', 'active', NULL, NULL, 'new', '0', '0');
SQL);


        });

        $this->info("New branch slot sub added to `$name` tenant.");
    }
}
