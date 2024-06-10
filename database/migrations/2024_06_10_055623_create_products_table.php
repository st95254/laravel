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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_type', 5);  // 型別欄位定義為 varchar(5)
            $table->string('name', 50);         // 名稱欄位定義為 varchar(50)
            $table->integer('price');           // 價格欄位定義為 integer
            $table->string('image', 200);       // 圖片欄位定義為 varchar(200)
            $table->string('description', 50)->nullable();  // 描述欄位定義為 varchar(50)
            $table->timestamps();               // 自動生成創建和更新時間戳欄位
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
