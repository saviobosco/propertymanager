<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('task_category_id')->nullable();
            $table->string('subject');
            $table->text('description')->nullable();
            $table->unsignedInteger('property_id')->nullable();
            $table->unsignedInteger('unit_id')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->enum('priority',['low','normal','high'])
                ->default('normal')
                ->comment('priority types are low, normal, high');

            $table->unsignedInteger('unit_id')->nullable();
            $table->unsignedInteger('tenant_id')->nullable();
            $table->date('due_date')->nullable();
            $table->unsignedTinyInteger('rental_owner_id')->nullable();
            $table->unsignedTinyInteger('assigned_to')->nullable();

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('mobile_phone_number')->nullable();
            $table->string('home_phone_number')->nullable();
            $table->string('work_phone_number')->nullable();
            $table->string('primary_email_address')->nullable();


            // create room for recurring tasks.
            $table->boolean('is_recurring')->default(0);
            $table->unsignedTinyInteger('due_after')->nullable();
            $table->enum('due_after_type',['days', 'weeks', 'months'])->nullable();
            $table->unsignedTinyInteger('repeat_frequency')->nullable()
                ->comment('The repeat frequency of the task.');
            $table->date('start_date')->nullable();
            $table->enum('end_type', ['never', 'after', 'on_date'])->nullable();
            $table->date('end_date')->nullable();

            $table->unsignedTinyInteger('type')->default(1)
                ->comment('The task type 1=>todo, 2=> resident_request,3=>rental_owner_request,4=>contact_request');
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
        Schema::dropIfExists('tasks');
    }
}
