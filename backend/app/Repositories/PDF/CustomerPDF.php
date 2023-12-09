<?php

namespace App\Repositories\PDF;

use App\Models\Tenant;
use App\Models\Tenant\Order;
use App\Models\Tenant\RestaurantUser;

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
            if($this->id){
                return [RestaurantUser::findOrFail($this->id)];
            }else{
                return  RestaurantUser::customers()->orderBy('created_at','DESC')->get();
            }
        });
       
    }
    public function view():string {
        return 'pdf.customers';
    }
    public function fileName():string {
        if($this->id){
            return "{$this->restaurant->restaurant_name}-customer-$this->id.pdf";
        }
        return "{$this->restaurant->restaurant_name}-customers.pdf";
    }
}
