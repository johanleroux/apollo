<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
      Schema::create('sales', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('customer_id')->unsigned();

          $table->foreign('customer_id')->references('id')->on('customers');
          $table->timestamps();
      });

      DB::update("ALTER TABLE sales AUTO_INCREMENT = 10001;");
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
      Schema::dropIfExists('sales');
  }
}
