<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantStyleAppResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'banner_background_color' => $this->banner_background_color,
            'category_hover_color' => $this->category_hover_color,
            'categoryDetail_cart_color' => $this->categoryDetail_cart_color,
            'page_color' => $this->page_color,
            'page_category_color' => $this->page_category_color,
            'header_color' => $this->header_color,
            'footer_color' => $this->footer_color,
            'price_color' => $this->price_color,
            'text_color' => $this->text_color,
            'product_background_color' => $this->product_background_color,
            'menu_card_background_color' => $this->menu_card_background_color,
            'menu_card_text_color' => $this->menu_card_text_color,
            'menu_name_background_color' => $this->menu_name_background_color,
            'menu_name_text_color' => $this->menu_name_text_color,
            'total_calories_background_color' => $this->total_calories_background_color,
            'total_calories_text_color' => $this->total_calories_text_color,
            'price_background_color' => $this->price_background_color,
            'price_text_color' => $this->price_text_color,
            'order_cart_color' => $this->order_cart_color,
            'home_color' => $this->home_color,
            'menu_section_background_color' => $this->menu_section_background_color,
            'menu_category_background_color' => $this->menu_category_background_color,
            'category_background_color' => $this->category_background_color,
            'menu_category_color' => $this->menu_category_color,
            'footer_text_color' => $this->footer_text_color,
            'logo_border_color' => $this->logo_border_color,
        ];
    }
}
