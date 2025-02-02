<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id2')->nullable()->after('user_id');
        });

        DB::statement('UPDATE tags SET user_id2 = user_id');

        Schema::table('tags', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');

            $table->foreignIdFor(\App\Models\User::class)->nullable()->after('user_id2');
        });

        DB::statement('UPDATE tags SET user_id = user_id2');

        Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn('user_id2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
};
