<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('restaurant_styles', function (Blueprint $table) {
            $table->string('menu_card_background_color')->default('#FFECD61A');
            $table->string('menu_card_text_font')->default('Inter');
            $table->string('menu_card_text_weight')->default('light');
            $table->integer('menu_card_text_size')->default(13);
            $table->string('menu_card_text_color')->default('#333');
            $table->integer('menu_card_radius')->default(20);

            $table->string('menu_name_background_color')->default('#FFFFFF');
            $table->string('menu_name_text_font')->default('Inter');
            $table->string('menu_name_text_weight')->default('light');
            $table->integer('menu_name_text_size')->default(12);
            $table->string('menu_name_text_color')->default('#000');

            $table->string('total_calories_background_color')->default('#FFFFFF');
            $table->string('total_calories_text_font')->default('Inter');
            $table->string('total_calories_text_weight')->default('light');
            $table->integer('total_calories_text_size')->default(10);
            $table->string('total_calories_text_color')->default('#000');

            $table->string('price_background_color')->default('#7D0A0A');
            $table->string('price_text_font')->default('Inter');
            $table->string('price_text_weight')->default('light');
            $table->integer('price_text_size')->default(12);
            $table->string('price_text_color')->default('#FFFFFF');

            $table->string('header_position')->default('relative');
            $table->string('header_color')->default('#ffffff')->change();
            $table->integer('header_radius')->default(50);

            $table->string('side_menu_position')->default('left');

            $table->string('order_cart_position')->default('center');
            $table->string('order_cart_color')->default('#ffffff');
            $table->integer('order_cart_radius')->default(50);

            $table->string('home_position')->default('right');
            $table->string('home_color')->default('#ffffff');
            $table->integer('home_radius')->default(50);

            $table->string('menu_section_background_color')->default('#ffffff');
            $table->integer('menu_section_radius')->default(50);

            $table->string('menu_category_background_color')->default('#ffffff');
            $table->string('menu_category_font')->default('Inter');
            $table->string('menu_category_weight')->default('light');
            $table->integer('menu_category_size')->default(13);
            $table->string('menu_category_color')->default('#000000');
            $table->string('menu_category_position')->default('center');
            $table->integer('menu_category_radius')->default(20);

            $table->string('page_color')->default('#eee')->change();
            $table->string('category_background_color')->default('#4466ff');
            $table->string('page_category_color')->default('#ffffff')->change();
            $table->string('product_background_color')->default('white')->change();
            $table->string('footer_color')->default('#ffffff')->change();
            $table->string('footer_alignment')->default('center');
            $table->string('footer_text_fontFamily')->default('Inter');
            $table->string('footer_text_fontWeight')->default('light');
            $table->integer('footer_text_fontSize')->default(10);
            $table->string('footer_text_color')->default('#000000');
            $table->string('price_color')->default('red')->change();

            $table->integer('logo_border_radius')->default(0);
            $table->string('logo_border_color')->default('white');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
