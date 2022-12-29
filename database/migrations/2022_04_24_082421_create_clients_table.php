<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['legal', 'real'])->default('real');
            $table->string('name');
            $table->string('family')->nullable();
            $table->string('submit_number')->nullable();
            $table->string('full_name')->nullable()->index();
            $table->dateTime('birth')->nullable();
            $table->string('father_name')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('job')->nullable();
            $table->string('agent_username');

            $table->unsignedBigInteger('agent_id')->nullable()->index();

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
        Schema::dropIfExists('clients');
    }
};
