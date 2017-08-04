<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
      Schema::create('purchases', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('supplier_id')->unsigned();

          $table->string('ext_invoice')->nullable();
          $table->datetime('processed_at')->nullable();

          $table->foreign('supplier_id')->references('id')->on('suppliers');
          $table->timestamps();
      });

      if (env('APP_ENV') != 'testing') {
          DB::update("ALTER TABLE purchases AUTO_INCREMENT = 10001;");
      }
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
      Schema::dropIfExists('purchases');
  }
}
