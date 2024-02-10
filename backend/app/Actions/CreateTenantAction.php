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
        if($tenantId){
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
                "password" => $user->password,
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
                "password" => $user->password,
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
