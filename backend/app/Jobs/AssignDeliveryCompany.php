<?php

namespace App\Jobs;

use App\Http\Controllers\API\Tenant\OrderController;
use App\Models\Tenant\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AssignDeliveryCompany implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $order;
    protected $status;
    protected $exceptJson;
    public function __construct($exceptJson,Order $order,$status)
    {
        $this->order = $order;
        $this->status = $status;
        $this->exceptJson = $exceptJson;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        /* Not assigned driver yet */
        if($this->order->refresh()->driver_id==null){
            $this->order->deliver_by = "Waiting delivery company";
            $this->order->save();
            $orderController = new OrderController();
            $orderController->assignOrderToDC($this->exceptJson,$this->order,$this->status);
        }
    }
}
