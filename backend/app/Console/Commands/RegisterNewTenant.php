<?php

namespace App\Console\Commands;

use App\Jobs\CreateTenantAdmin;
use App\Models\User;
use App\Models\Tenant;
use Database\Seeders\UserSeeder;
use Illuminate\Console\Command;
use Database\Seeders\TenantActionSeeder;
use Exception;
use Illuminate\Database\UniqueConstraintViolationException;

class RegisterNewTenant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:tenant {name?}';

    /**
     * The console Create a new tenant with subdomain and DB.
     *
     * @var string
     */
    protected $description = 'Create a new tenant with subdomain and DB';

    /**
     * Execute the console command.
     */
    public function handle(TenantActionSeeder $seeder)
    {
        $user = User::find(UserSeeder::RESTAURANT_OWNER_USER_ID);
        $name = $this->argument('name') ?? 'first';
        if(!$user){
            $this->error("No user registered, try run `php artisan migrate:fresh --seed`");
            return ;
        }
        try {
            $seeder->run($name,$user->id);
        }catch(UniqueConstraintViolationException $e){
            $this->error("The $name domain is occupied by another user. try use different tenant name `php artisan create:tenant {name}`");
            $this->warn("make sure to add this subdomain to your hosts file");
            return ;
        }

        // sign first user
        $url = Tenant::latest()->first()->impersonationUrl(CreateTenantAdmin::RESTAURANT_OWNER_USER_ID); //  USER restaurant owner id
        $this->info("Tenant has been created successfully, visit `$url`");
    }
}
