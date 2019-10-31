<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->tinyInteger('status')->default(1);
            $table->dateTime('verification_time')->nullable();
            $table->string('verification_code')->nullable();
            $table->tinyInteger('email_verify')->default(1);
            $table->tinyInteger('sms_verify')->default(1);
            $table->tinyInteger('two_step_verify')->default(0);
            $table->tinyInteger('two_step_verification')->default(1);
            $table->string('two_step_code')->nullable();
            $table->string('refer_by')->default('0');
            $table->string('api_key')->nullable();
            $table->string('sms')->default('0');
            $table->string('gateway')->default('0');
            $table->tinyInteger('roll')->default(0);
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
        Schema::dropIfExists('users');
    }
}
