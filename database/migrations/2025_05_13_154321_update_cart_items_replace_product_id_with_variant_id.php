<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCartItemsReplaceProductIdWithVariantId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropForeign(['product_id']);

            $table->dropColumn('product_id');

            $table->unsignedBigInteger('product_variant_id')->after('id');

            $table->foreign('product_variant_id')->references('id')->on('product_variants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropForeign(['product_variant_id']);
            $table->dropColumn('product_variant_id');

            $table->unsignedBigInteger('product_id')->after('id');

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }
}
