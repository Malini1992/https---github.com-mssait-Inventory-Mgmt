<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ForeignKeyDefinition;
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
        Schema::create('location', function (Blueprint $table) {
            $table->integer('location_id')->autoIncrement();
            $table->integer('company_id');
            $table->string('address');
            $table->string('country');
            $table->string('state');
            $table->string('district');
            $table->string('area');
            $table->string('zipcode');
            $table->timestamps();
            $table->foreign('company_id')->references('company_id')->on('company')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('location');
    }
};
