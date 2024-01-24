<?php

use App\Models\Tenant\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    private function dropID() {

    }
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            if (Schema::hasColumn('settings', 'id')) {
                $table->dropPrimary();
                $table->unsignedInteger('id')->change();
                $table->dropColumn('id');
                $table->string('global_id')->primary()->unique()->index()->first();
                $table->timestamps();
            }
        });
        try {
            $Cloning = Setting::first();
            if ($Cloning) {
                $oldSetting = $Cloning;
                $Cloning->delete();
                Setting::create($oldSetting->toArray());
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
