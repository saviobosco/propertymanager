<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('company_name', 100)->nullable();
            $table->string('primary_email_address', 50)->nullable();
            $table->string('alternate_email_address', 50)->nullable();
            $table->string('mobile_phone_number', 15)->nullable();
            $table->string('work_phone_number', 15)->nullable();
            $table->string('home_phone_number', 15)->nullable();
            $table->string('fax_phone_number', 15)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->text('comment')->nullable();
            $table->string('profile_photo')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_relationship')->nullable();
            $table->string('emergency_contact_phone_number')->nullable();
            $table->string('emergency_contact_email_address')->nullable();
            $table->unsignedInteger('company_id');
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
        Schema::dropIfExists('tenants');
    }
}
