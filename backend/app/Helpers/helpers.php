<?php
declare(strict_types=1);
use Illuminate\Support\Facades\Storage;



if (! function_exists('store_image')) {

    function store_image($image,$store_at,$name = null)
    {
        try {
        
            if($name){
                $filename = $name.'.'.$image->guessExtension();
                if (Storage::disk('public')->exists($store_at.'/'.$filename)) {
                    Storage::delete($store_at.'/'.$filename);
                }
            }else {
                $filename = uniqid().'.'.$image->guessExtension();
            }
            $image->storeAs($store_at, $filename, 'public');
            return  $store_at.'/'.$filename;
        }catch(Exception $e){
            return false;
        }
        
    }
}
