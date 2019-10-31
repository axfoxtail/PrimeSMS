<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('base_color')->nullable();
            $table->string('currency_symbol')->nullable();
            $table->string('sms_charge')->nullable();
            $table->string('default_gateway')->nullable();
            $table->tinyInteger('email_verification')->nullable();
            $table->tinyInteger('sms_verification')->nullable();
            $table->tinyInteger('email_notification')->nullable();
            $table->tinyInteger('sms_notification')->nullable();
            $table->tinyInteger('recaptcha')->default(1);
            $table->string('site_key')->nullable();
            $table->string('secret_key')->nullable();
            $table->string('e_sender')->nullable();
            $table->longText('e_message')->nullable();
            $table->text('sms_api')->nullable();
            $table->longText('contact_address')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
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
        Schema::dropIfExists('general_settings');
    }
}
