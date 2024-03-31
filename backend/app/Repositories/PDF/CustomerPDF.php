<?php

namespace App\Repositories\PDF;

use Carbon\Carbon;
use App\Models\Tenant;
use App\Models\Tenant\Order;
use App\Models\Tenant\RestaurantUser;
use App\Models\Tenant\RestaurantStyle;

class CustomerPDF implements PdfPrintInterface
{
    public $restaurant;
    public function __construct(
        public $tenant_id ,
        public $id = null,
    )
    {
        $this->restaurant = Tenant::findOrFail($tenant_id);
    }
    public function data()
    {
        return $this->restaurant->run(function(){
            $logo = RestaurantStyle::first()->logo;
            $data = [
                'restaurant_name'=> $this->restaurant->restaurant_name,
                'logo' =>($logo)?storage_path("app/public/".RestaurantStyle::STORAGE."/".basename($logo)): public_path('/images/Logo.webp')
            ];
            if($this->id){
                $data['customers'] = [RestaurantUser::findOrFail($this->id)];
                return $data;
            }else{
                $data['customers'] =   RestaurantUser::customers()->orderBy('id','DESC')->get();
                return $data;
            }
        });

    }
    public function view():string {
        return 'pdf.customers';
    }
    public function fileName():string {
        if($this->id){
            return "{$this->restaurant->restaurant_name} - customers-$this->id ".Carbon::now()->format('d-m-Y h:i a').".pdf";
        }
        return "{$this->restaurant->restaurant_name} - customers ".Carbon::now()->format('d-m-Y h:i a').".pdf";

    }
}
