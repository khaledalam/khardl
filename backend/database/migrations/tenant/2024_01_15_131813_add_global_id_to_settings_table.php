<?php

use App\Models\Tenant\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    private function dropID() {
        Schema::table('settings', function (Blueprint $table) {
            if (Schema::hasColumn('settings', 'id')) {
                $table->dropPrimary();
            }
        });
    }
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('global_id')->unique();
            $table->timestamps();
        });
        try {
            $Cloning = Setting::first();
            if ($Cloning) {
                $oldSetting = $Cloning;
                $Cloning->delete();
                $this->dropID();
                Setting::create($oldSetting->toArray());
            } else {
                $this->dropID();
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
            $table->dropColumn('global_id');

        });
    }
};
