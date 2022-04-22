<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReminderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reminder', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('cat_id')->nullable();
            $table->unsignedBigInteger('assigned_by')->nullable();
            $table->unsignedBigInteger('reply_to')->nullable();
            $table->string('assign_date')->nullable();
            $table->text('note')->nullable();
            $table->string('due_time')->nullable();
            $table->string('due_date')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('cat_id')->references('id')->on('category')->onDelete('cascade')->nullable();
            $table->foreign('reply_to')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->foreign('assigned_by')->references('id')->on('users')->onDelete('cascade')->nullable();
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
        Schema::dropIfExists('reminder');
    }
}
