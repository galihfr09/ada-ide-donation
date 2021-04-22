<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('donator_name', 50)->nullable(false);
            $table->string('donator_email', 50)->nullable(true);
            $table->string('donator_number', 16)->nullable(true);
            $table->boolean('is_anonym')->default(false);
            $table->text('message')->nullable(true);
            $table->enum('payment_status', ['paid', 'waiting', 'expired']);
            $table->string('channel', 10)->nullable(false);
            $table->bigInteger('donation_amount')->nullable(false);
            $table->smallInteger('unique_digit')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donation_transactions');
    }
}
