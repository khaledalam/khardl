<?php

namespace App\Repositories\PDF;

use App\Models\Tenant;
use App\Models\Tenant\Order;

class OrderPDF implements PdfPrintInterface
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
                return [Order::with(['payment_method:id,name','items.item','user:id,first_name,last_name','branch:id,name'])->findOrFail($this->id)];
            }else{
                return Order::orderBy('created_at','DESC')->with(['payment_method:id,name','items.item','user:id,first_name,last_name','branch:id,name'])->get();
            }
        });
       
    }
    public function view():string {
        return 'pdf.orders';
    }
    public function fileName():string {
        return 'orders.pdf';
    }
}
