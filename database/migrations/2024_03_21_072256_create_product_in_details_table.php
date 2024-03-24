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
        Schema::create('product_in_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_in_id')->nullable(false);
            $table->unsignedBigInteger('product_id')->nullable(false);
            $table->integer('qty');
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->constrained()->onDelete('cascade');
            $table->foreign('product_in_id')->references('id')->on('product_ins')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_in_details');
    }
};
