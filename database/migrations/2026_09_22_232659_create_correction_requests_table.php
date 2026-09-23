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
        // 修正申請テーブル
        Schema::create('correction_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attendance_id')->constrained('attendances')->cascadeOnDelete();
            // 修正する項目
            $table->string('type', 255)->required();
            // 修正後の時間、備考（修正理由）を記録
            $table->time('new_time')->nullable();
            $table->text('new_note', 255)->required();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('correction_requests');
    }
};
