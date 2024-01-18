<?php

use App\Models\Tenant\DeliveryCompany;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('delivery_companies', function (Blueprint $table) {
            if (!Schema::hasColumn('delivery_companies', 'coverage_area')) {
                $table->json('coverage_area')->nullable();
            }
        });
        $yeswa = DeliveryCompany::where('module', 'Yeswa')->first();
        if ($yeswa && $yeswa?->coverage_area == null) {
            $yeswa->setTranslation('coverage_area', 'ar', ['الرياض', 'جده','مكه','الدمام','ٱلْحِسَى']);
            $yeswa->setTranslation('coverage_area', 'en', ['Riyadh', 'Jeddah','Mecca','Dammam','Al-Ahsa']);
            $yeswa->save();
        }
        $cervo = DeliveryCompany::where('module', 'Cervo')->first();
        if ($cervo && $cervo?->coverage_area == null) {
            $cervo->setTranslation('coverage_area', 'ar', ['الرياض', 'جده','مكه','الدمام','ٱلْحِسَى']);
            $cervo->setTranslation('coverage_area', 'en', ['Riyadh', 'Jeddah','Mecca','Dammam','Al-Ahsa']);
            $cervo->save();
        }
        $StreetLine = DeliveryCompany::where('module', 'StreetLine')->first();
        if ($StreetLine && $StreetLine?->coverage_area == null) {
            $StreetLine->setTranslation('coverage_area', 'ar', [
                'الرياض',
                'جده',
                'مكه',
                'الدمام',
                'ٱلْحِسَى',
                'الخبر',
                'الظهران',
                'الاحساء',
                'بريدة',
                'تبوك',
                'ينبع',
                'الطائف',
                'ابها',
                'الخرج',
                'المدينة',
                'خميس مشيط',
                'بلجرشي'
            ]);
            $StreetLine->setTranslation('coverage_area', 'en', [
                'Riyadh',
                'Jeddah',
                'Mecca',
                'Dammam',
                'Al-Ahsa',
                'Khobar',
                'Dahran',
                'Hassa',
                'Buridah',
                'Tabuk',
                'Al Madinah',
                'Yanbu',
                'Makkah',
                'Taif',
                'Abha',
                'Khamis Mashit',
                'Bulgrshi',
                'Kharj'
            ]);
            $StreetLine->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('delivery_companies', function (Blueprint $table) {
            //
        });
    }
};
