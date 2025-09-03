<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addons', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // اسم الإضافة
            $table->string('name_ar')->nullable(); // الاسم بالعربية
            $table->string('name_fr')->nullable(); // الاسم بالفرنسية
            $table->string('category'); // فئة الإضافة (sauces, vegetables, drinks, meat, extras)
            $table->decimal('price', 8, 2)->default(0.00); // السعر الإضافي
            $table->string('icon')->nullable(); // أيقونة الإضافة
            $table->text('description')->nullable(); // وصف الإضافة
            $table->boolean('is_active')->default(true); // هل الإضافة متاحة
            $table->integer('sort_order')->default(0); // ترتيب الإضافة
            $table->timestamps();
            
            // Indexes
            $table->index(['category', 'is_active']);
            $table->index('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addons');
    }
};
