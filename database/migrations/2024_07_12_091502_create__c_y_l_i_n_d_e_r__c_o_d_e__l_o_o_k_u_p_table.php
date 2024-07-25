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
        Schema::create('CYLINDER_CODE_LOOKUP', function (Blueprint $table) {

            $table->integer('ID')->autoIncrement();
            $table->string('CODE_GROUP_ID', 20)->nullable(false);
            $table->string('CODE_ID', 20)->nullable(false);
            $table->string('DESCRIPTION', 200)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('CYLINDER_CODE_LOOKUP');
    }
};
