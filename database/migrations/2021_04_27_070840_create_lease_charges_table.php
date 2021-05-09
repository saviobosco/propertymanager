<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaseChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lease_charges', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('lease_id');
            $table->unsignedInteger('frequency')->nullable();
            $table->decimal('amount', 15, 2)->default(0);
            $table->unsignedInteger('account_id')->nullable();
            $table->date('next_due_date')->nullable();
            $table->string('memo')->nullable();
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
        Schema::dropIfExists('lease_charges');
    }
}
