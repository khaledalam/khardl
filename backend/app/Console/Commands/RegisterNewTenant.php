<?php

namespace App\Console\Commands;

use App\Jobs\CreateTenantAdmin;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Console\Command;
use Database\Seeders\TenantActionSeeder;
use Illuminate\Database\UniqueConstraintViolationException;

class RegisterNewTenant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:tenant {name=first}';

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
        $name = $this->argument('name') ?? 'first';
        $user = User::where('restaurant_name', '=', $name)->first();

        if(!$user){
            $this->error("No user registered, try run `php artisan migrate:fresh --seed`");
            return ;
        }
        try {
            $seeder->run($name,$user->id);
        }catch(UniqueConstraintViolationException $e){
            $this->error($e->getMessage());
            return ;
        }

        // sign first user
        $url = Tenant::where('restaurant_name', '=', $name)->first()->impersonationUrl(CreateTenantAdmin::RESTAURANT_OWNER_USER_ID); //  USER restaurant owner id
        $this->info("Tenant has been created successfully, visit `$url`");
    }
}
