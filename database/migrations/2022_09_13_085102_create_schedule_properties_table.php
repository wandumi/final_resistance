<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable()->unique();
            $table->string('property_use')->nullable();
            $table->string('vacancy')->nullable();
            $table->string('gla')->nullable();
            $table->string('parking')->nullable();
            $table->string('pro_rata_interest')->nullable();
            $table->string('address')->nullable();
            $table->string('valuation')->nullable();
            $table->date('date_of_accusion')->nullable();
            $table->string('country')->nullable();
            $table->integer('list')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('schedule_properties');
    }
}
