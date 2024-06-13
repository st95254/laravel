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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name', 100);
            $table->string('phone', 50);
            $table->string('address', 100);
            $table->integer('account');
            $table->string('remark', 100)->nullable();
            $table->string('trade_no', 100);
            $table->integer('total');
            $table->datetime('date');
            $table->integer('shipping_fee');
            $table->string('status', 50);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
