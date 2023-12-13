<?php

namespace App\Repositories\PDF;

use Carbon\Carbon;
use App\Models\Tenant;
use App\Models\Tenant\Order;
use App\Models\Tenant\RestaurantStyle;

class OrderPDF implements PdfPrintInterface
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
                'logo' =>($logo)?storage_path("app/public/".RestaurantStyle::STORAGE."/".basename($logo)): public_path('/img/logo.png')
            ];
            if($this->id){
                $data['orders'] = [ Order::with(['delivery_type:id,name','payment_method:id,name','items.item','user:id,first_name,last_name','branch:id,name'])->findOrFail($this->id)];
                return $data;
            }else{
                $data['orders'] = Order::orderBy('created_at','DESC')->with(['delivery_type:id,name','payment_method:id,name','items.item','user:id,first_name,last_name','branch:id,name'])->get();
                return $data;
            }
        });
       
    }
    public function view():string {
        return 'pdf.orders';
    }
    public function fileName():string {
        if($this->id){
            return "{$this->restaurant->restaurant_name} - order-$this->id ".Carbon::now()->format('d-m-Y h:i a').".pdf";
        }
        return "{$this->restaurant->restaurant_name} - orders ".Carbon::now()->format('d-m-Y h:i a').".pdf";
    }
}
