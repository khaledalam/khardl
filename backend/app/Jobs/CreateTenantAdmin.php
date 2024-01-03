<?php

namespace App\Jobs;

use App\Models\Tenant;
use App\Utils\ResponseHelper;
use Illuminate\Bus\Queueable;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Packages\TapPayment\Customer\Customer as CustomerTap;

class CreateTenantAdmin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public const RESTAURANT_OWNER_USER_ID = 1;


    /** @var Tenant */
    protected $tenant;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->tenant->run(function ($tenant) {
            $user= RestaurantUser::create(
                $tenant->only(['first_name','last_name', 'email', 'password','phone'])
                + ['phone_verified_at'=>now(),'status'=>'active', 'id' => self::RESTAURANT_OWNER_USER_ID]
            );
            $user->assignRole('Restaurant Owner');

            $tenant->update([
                'ready' => true,
            ]);
            // create new customer for tap 
            // TODO @todo add tap customer to queue server
            CustomerTap::createWithModel($user);
            
        });
    }
}
