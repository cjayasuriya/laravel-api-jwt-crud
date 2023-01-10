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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku');
            $table->string('name');
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('uom')->nullable();
            $table->text('prices')->nullable();
            $table->double('weight')->default(0);
            $table->string('weightUnit')->nullable();
            $table->text('sizes')->nullable();
            $table->string('sizeUnit')->nullable();
            $table->string('description')->nullable();
            $table->text('imgPath')->nullable();
            $table->text('meta')->nullable();
            $table->integer('statusID')->default(1);
            $table->string('status')->default('Active');
            $table->integer('cuid')->nullable();
            $table->integer('uuid')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
