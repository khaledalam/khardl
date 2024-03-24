<?php

use App\Models\User;
use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Types\Type;
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
        Schema::table('users', function (Blueprint $table) {

            $table->string('status')->default(User::STATUS_ACTIVE)->change();
            $table->json('reject_reasons')->default(json_encode([]));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        try {
            Type::addType('enum', StringType::class);
        }catch(Throwable $e){}

        Schema::table('users', function (Blueprint $table) {
            $table->enum('status', [User::STATUS_ACTIVE, User::STATUS_BLOCKED, User::STATUS_INACTIVE])->default('active');
            $table->dropColumn('reject_reasons');
        });
    }
};
