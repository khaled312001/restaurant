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
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('price_seul', 8, 2)->nullable()->after('current_price')->comment('Prix pour version Seul');
            $table->decimal('price_menu', 8, 2)->nullable()->after('price_seul')->comment('Prix pour version Menu');
            $table->string('product_type')->nullable()->after('price_menu')->comment('Type de produit (panini, tacos, etc.)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['price_seul', 'price_menu', 'product_type']);
        });
    }
};
