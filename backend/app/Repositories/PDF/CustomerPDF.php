<?php

namespace App\Repositories\PDF;

use App\Models\Tenant;
use App\Models\Tenant\Order;
use App\Models\Tenant\RestaurantUser;

class CustomerPDF implements PdfPrintInterface
{
    public function __construct(
        public $tenant_id ,
        public $id = null,
    )
    {
       
    }
    public function data()
    {
        return Tenant::findOrFail($this->tenant_id)->run(function(){
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
            return "customer-$this->id.pdf";
        }
        return 'customers.pdf';
    }
}
