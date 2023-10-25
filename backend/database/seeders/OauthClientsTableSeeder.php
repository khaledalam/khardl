<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OauthClientsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('oauth_clients')->delete();
        
        \DB::table('oauth_clients')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => NULL,
                'name' => 'Laravel Personal Access Client',
                'secret' => 'FNTFj3zqLEhQ8wODSK5uik3yuL8tI6HuEvNDkp5Y',
                'provider' => NULL,
                'redirect' => 'http://localhost',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0,
                'created_at' => '2023-10-02 12:55:54',
                'updated_at' => '2023-10-02 12:55:54',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => NULL,
                'name' => 'Laravel Password Grant Client',
                'secret' => 'xqp68dBy3mOo7K1ZM8jwetBWbRoxWY7I8Xn7bbp5',
                'provider' => 'users',
                'redirect' => 'http://localhost',
                'personal_access_client' => 0,
                'password_client' => 1,
                'revoked' => 0,
                'created_at' => '2023-10-02 12:55:54',
                'updated_at' => '2023-10-02 12:55:54',
            ),
        ));
        
        
    }
}