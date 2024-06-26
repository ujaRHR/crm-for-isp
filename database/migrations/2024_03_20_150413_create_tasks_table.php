<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up() : void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id');
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('ticket_id');
            $table->string('title');
            $table->string('description');
            $table->string('task_img')->nullable();
            $table->timestamps();

            $table->foreign('staff_id')->references('id')->on('staffs')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreign('admin_id')->references('id')->on('admins')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreign('ticket_id')->references('id')->on('tickets')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::dropIfExists('tasks');
    }
};
