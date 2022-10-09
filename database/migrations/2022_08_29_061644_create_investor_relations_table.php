<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestorRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investor_relations', function (Blueprint $table) {
            $table->id();
            $table->date('year');
            $table->string('dividend')->nullable();
            $table->string('shares_issue_ifrs')->nullable();	
            $table->string('shares_held_treasury')->nullable();
            $table->string('dividend_share_calculation')->nullable();
            $table->string('net_per_share')->nullable();
            $table->string('loan_to_ratio')->nullable();
            $table->string('gross_property_expense')->nullable(); 
            $table->string('percentage_property_offshore')->nullable(); 	 	 
            $table->string('value_per_share')->nullable();
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
        Schema::dropIfExists('investor_relations');
    }
}
