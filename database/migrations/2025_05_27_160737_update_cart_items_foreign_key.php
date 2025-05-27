<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCartItemsForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            // Drop the existing foreign key
            $table->dropForeign(['cart_id']);

            // Add the foreign key with ON DELETE CASCADE
            $table->foreign('cart_id')
                ->references('id')
                ->on('carts')
                ->onDelete('cascade');
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
            // Drop the foreign key with cascade
            $table->dropForeign(['cart_id']);

            // Restore original foreign key without cascade
            $table->foreign('cart_id')
                ->references('id')
                ->on('carts');
        });
    }
}
