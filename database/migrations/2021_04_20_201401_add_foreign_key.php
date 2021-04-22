<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('donation_transactions', function (Blueprint $table) {
            $table->foreignId('donations_id')->constrained()->nullable(false);
        });
    
        Schema::table('donation_news', function (Blueprint $table) {
            $table->foreignId('donations_id')->constrained()->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('donation_transactions', function (Blueprint $table) {
            $table->dropForeign(['donations_id']);
        });
    
        Schema::table('donation_news', function (Blueprint $table) {
            $table->dropForeign(['donations_id']);
        });
    }
}
