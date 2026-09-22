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
        Schema::create('bridge_redirect_logs', function (Blueprint $table) {
            $table->id();
            $table->string('platform'); // 'shopeefood', 'grabfood', 'gofood'
            $table->foreignId('outlet_id')->nullable()->constrained('outlets')->nullOnDelete();
            $table->string('device_type')->default('desktop'); // 'mobile_android', 'mobile_ios', 'desktop', 'unknown'
            $table->text('user_agent')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('referrer')->nullable();
            $table->timestamps();

            $table->index(['platform', 'created_at']);
            $table->index(['outlet_id', 'platform']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bridge_redirect_logs');
    }
};
