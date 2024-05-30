<?php

namespace App\Console\Commands;

use App\Models\CentralTenantSetting;
use Illuminate\Console\Command;

class DeleteCentralTenantSettingNotExists extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-central-tenant-setting-not-exists';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is responsible for deleting the records in central tenant settings that does not have tenants';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $centralSettingsThatDoesntHaveTenants = CentralTenantSetting::whereDoesntHave('tenants')->delete();
    }
}
