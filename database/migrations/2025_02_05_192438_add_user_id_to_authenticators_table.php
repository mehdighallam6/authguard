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
        Schema::table('authenticators', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\User::class)->nullable()->after('tag_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('authenticators', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
};
