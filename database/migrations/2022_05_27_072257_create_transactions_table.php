<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agent_id')->nullable()->index();

            $table->unsignedBigInteger('wallet_id')->nullable();
            $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('cascade');

            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');

            $table->string('payment_method')->nullable()->default(null);
            $table->bigInteger('amount')->nullable()->default(null);
            $table->boolean('verified')->default(false);
            $table->string('merchant_id')->nullable();
            $table->string('user_ip')->nullable()->default(null);
            $table->string('ref_id')->nullable()->default(null);
            $table->unsignedBigInteger('order_id')->nullable()->default(null);
            $table->string('sale_order_id')->nullable()->default(null);
            $table->string('sale_reference_id')->nullable()->default(null);
            $table->string('agent_share')->nullable()->default(null);
            $table->string('card_info')->nullable()->default(null);
            $table->string('card_pan')->nullable()->default(null);
            $table->integer('res_code')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->enum('status', ['success', 'failed', 'unpaid'])->default('unpaid');
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
        Schema::dropIfExists('transactions');
    }
};
