<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leases', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('unit_id')->nullable();
            $table->unsignedInteger('property_id')->nullable();
            $table->unsignedInteger('lease_type');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->unsignedTinyInteger('rent_cycle');
            $table->unsignedTinyInteger('signature_status');
            $table->boolean('send_resident_welcome_email')->default(0);
            $table->decimal('security_deposit_amount', 15, 2)->nullable();
            $table->date('security_deposit_due_date')->nullable();
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
        Schema::dropIfExists('leases');
    }
}
