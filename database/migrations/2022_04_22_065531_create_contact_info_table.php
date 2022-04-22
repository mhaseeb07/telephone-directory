<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_info', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('designation')->nullable();
            $table->string('company')->nullable();
            $table->unsignedBigInteger('dpt_id')->nullable();
            $table->string('city')->nullable();
            $table->string('business_phone')->nullable();
            $table->string('factory_phone')->nullable();
            $table->string('home_phone')->nullable();
            $table->string('fax_no')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('dpt_id')->references('id')->on('department')->onDelete('cascade')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->nullable();
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
        Schema::dropIfExists('contact_info');
    }
}
