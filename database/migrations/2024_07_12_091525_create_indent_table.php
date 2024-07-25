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
        Schema::create('indent', function (Blueprint $table) {
        $table->integer('indent_id')->autoIncrement();
        $table->integer('customer_id')->nullable(false);
        $table->integer('product_id')->nullable(false);
        $table->timestamp('issue_date')->nullable(false);
        $table->integer('no_of_cylinders')->nullable(false);
        $table->integer('status')->nullable(false);
        $table->timestamps(); // Creates 'created_at' and 'updated_at' columns

        // Define foreign key constraints
        $table->foreign('customer_id')->references('customer_id')->on('customer')->onDelete('cascade');
        $table->foreign('product_id')->references('product_id')->on('product')->onDelete('cascade');
        $table->foreign('status')->references('ID')->on('CYLINDER_CODE_LOOKUP')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indent');
    }
};
