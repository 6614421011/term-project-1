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
    Schema::create('menu_items', function (Blueprint $table) {
        $table->id();
        $table->string('item_code')->unique();      // 1. รหัสเมนู
        $table->string('name_th');                 // 2. ชื่อไทย
        $table->string('name_en');                 // 3. ชื่ออังกฤษ
        $table->string('category');                // 4. หมวดหมู่ (Coffee, Tea, Cake)
        $table->text('description')->nullable();    // 5. รายละเอียด
        $table->decimal('price_hot', 8, 2)->default(0);  // 6. เมนูร้อน
        $table->decimal('price_iced', 8, 2)->default(0); // 7. เมนูเย็น
        $table->decimal('price_frappe', 8, 2)->default(0);// 8. เมนูปั่น
        $table->decimal('cost_price', 8, 2);       // 9. ราคาทุน
        $table->integer('calories')->nullable();    // 10. แคลอรี่
        $table->string('caffeine_level');          // 11. ระดับคาเฟอีน (None, Low, High)
        $table->integer('recommend_sweet');        // 12. ระดับความหวานแนะนำ (0-100)
        $table->string('image_path')->nullable();   // 13. รูปภาพ
        $table->boolean('is_available')->default(true); // 14. สถานะพร้อมขาย
        $table->string('note')->nullable();         // 15. หมายเหตุเพิ่มเติม
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
