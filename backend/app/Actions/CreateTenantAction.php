<?php

namespace App\Actions;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Database\Factories\Tenant\UserFactory;

class CreateTenantAction
{
    public function __invoke(
        string $domain,
        User $user): Tenant
       
    {
      
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

        $tenant->createDomain([
            'domain' => self::generateSubdomain($domain),
        ]);

    
        $tenant->run(function ($tenant) {
            // run actions through tenant scope
        });

        

        return $tenant;
    }
    public static function generateSubdomain($text){
        $transliterated = Str::slug($text);

        $words = explode('-', $transliterated);
        $firstWord = $words[0];

        return $firstWord;
    }
}
