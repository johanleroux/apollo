<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
      Schema::create('orders', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('supplier_id')->unsigned();

          $table->foreign('supplier_id')->references('id')->on('suppliers');
          $table->datetime('process_date');
          $table->datetime('processed_at')->nullable();
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
      Schema::dropIfExists('orders');
  }
}
