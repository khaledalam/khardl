<?php

namespace App\Actions;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Database\Factories\Tenant\UserFactory;
use Stancl\Tenancy\Database\Models\Domain;

class CreateTenantAction
{
    public function __invoke(
        string $domain,
        User $user,
        $tenantId = null): Tenant
    {
        do {
            $mapper_hash = generateToken();
            $tenant = Tenant::whereJsonContains('data->mapper_hash', $mapper_hash)->first();
        } while($tenant);

        if(env('APP_ENV')=='testing'){
            $tenantId = $tenantId ?? '140c813f-5794-4e47-8e28-3426ac01f1f8';
            $database = config('tenancy.database.prefix').$tenantId;
            if ($this->databaseExists($database)) {
                $this->dropDatabase($database);
            }

            $tenant = Tenant::create([
                'id' => $tenantId,
                'user_id'=> $user->id,
                'ready' => true,
                'email'=> $user->email,
                "first_name" => $user->first_name,
                "last_name" =>$user->last_name,
                "phone"=>$user->phone,
                'restaurant_name'=>$domain,
                'restaurant_name_ar'=>$user->restaurant_name_ar,
                "password" => $user->password,
                'mapper_hash' => $mapper_hash // used for order_id prefix
            ]);
            $domain = Domain::create([
                'domain' => $domain,
                'tenant_id' => $tenantId
            ]);
            return $tenant;
        }else{
            $tenant = Tenant::create([
                'user_id'=> $user->id,
                'ready' => true,
                'email'=> $user->email,
                "first_name" => $user->first_name,
                "last_name" =>$user->last_name,
                "phone"=>$user->phone,
                'restaurant_name'=>$domain,
                'restaurant_name_ar'=>$user->restaurant_name_ar,
                "password" => $user->password,
                'mapper_hash' => $mapper_hash // used for order_id prefix
            ]);
        }


        $tenant->createDomain([
            'domain' => self::generateSubdomain($domain),
        ]);


        // $tenant->run(function ($tenant) {
        //     // run actions through tenant scope
        // });



        return $tenant;
    }
    public static function generateSubdomain($text){
        $transliterated = Str::slug($text);

        // $words = explode('-', $transliterated);
        // $firstWord = $words[0];

        return $transliterated;
    }
    protected function dropDatabase($databaseName)
    {
        Schema::getConnection()->getDoctrineSchemaManager()->dropDatabase("`{$databaseName}`");
    }

    protected function databaseExists($databaseName)
    {
        $existingDatabases = Schema::getConnection()->getDoctrineSchemaManager()->listDatabases();
        return in_array($databaseName, $existingDatabases);
    }


}
