<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customizations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_item_id')->nullable(); // For cart items
            $table->unsignedBigInteger('order_item_id')->nullable(); // For order items
            $table->string('product_name');
            $table->string('product_type');
            $table->decimal('price', 8, 2);
            $table->integer('quantity');
            $table->string('meat_choice')->nullable();
            $table->json('vegetables')->nullable();
            $table->string('drink_choice')->nullable();
            $table->json('sauces')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index(['cart_item_id']);
            $table->index(['order_item_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customizations');
    }
}
