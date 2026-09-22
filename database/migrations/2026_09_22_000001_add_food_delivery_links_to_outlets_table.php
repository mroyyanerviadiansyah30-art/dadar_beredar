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
        Schema::table('outlets', function (Blueprint $table) {
            $table->text('gofood_url')->nullable()->after('gmaps_place_id');
            $table->text('grabfood_url')->nullable()->after('gofood_url');
            $table->text('shopeefood_url')->nullable()->after('grabfood_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('outlets', function (Blueprint $table) {
            $table->dropColumn(['gofood_url', 'grabfood_url', 'shopeefood_url']);
        });
    }
};
