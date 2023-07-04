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
        Schema::create('profile', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->integer('type');
            $table->float('price_per_km', 12, 2);
            $table->float('zone1', 12, 2)->nullable();
            $table->float('zone2', 12, 2)->nullable();
            $table->float('zone3', 12, 2)->nullable();
            $table->float('zone4', 12, 2)->nullable();
            $table->float('zone5', 12, 2)->nullable();
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
        Schema::dropIfExists('profile');
    }
};
