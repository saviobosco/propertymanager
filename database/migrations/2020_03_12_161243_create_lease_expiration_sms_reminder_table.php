<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaseExpirationSmsReminderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('lease_expiration_sms_reminder', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('unit_id');
            $table->unsignedInteger('property_id');
            $table->unsignedInteger('tenant_id');
            $table->string('phone_number', 20);
            $table->text('message');
            $table->date('lease_ends');
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('lease_expiration_sms_reminder');
    }
}
