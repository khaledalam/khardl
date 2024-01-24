<?php

use App\Models\Tenant\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            $Cloning = Setting::first();
            if ($Cloning) {
                $oldSetting = $Cloning;
                $Cloning->delete();
                Schema::table('settings', function (Blueprint $table) {
                    if (Schema::hasColumn('settings', 'id')) {
                        $table->dropPrimary();
                    }
                });
                Setting::create($oldSetting->toArray());
            } else {
                Schema::table('settings', function (Blueprint $table) {
                    if (Schema::hasColumn('settings', 'id')) {
                        $table->dropPrimary();
                    }
                });
            }
        } catch (\Exception $e) {
            throw $e;
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {

        });
    }
};
