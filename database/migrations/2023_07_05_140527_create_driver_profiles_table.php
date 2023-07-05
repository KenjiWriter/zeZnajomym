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
        Schema::create('drivers_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('postcode');
            $table->string('city');
            $table->string('street');
            $table->string('code');
            $table->integer('price_type');
            $table->float('avg_fuel_con')->nullable();
            $table->float('fuel_price')->nullable();
            $table->float('price_per_km', 12, 2)->nullable();
            $table->text('zones')->nullable();
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
