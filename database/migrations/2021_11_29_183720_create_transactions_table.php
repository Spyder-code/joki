<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
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
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('customer_id')->constrained('users');
            $table->foreignId('transaction_status_id')->constrained('transaction_statuses')->default(1);
            $table->string('code');
            $table->string('title');
            $table->text('note')->nullable();
            $table->string('price')->nullable();
            $table->date('deadline');
            $table->string('file_complete')->nullable();
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
}
