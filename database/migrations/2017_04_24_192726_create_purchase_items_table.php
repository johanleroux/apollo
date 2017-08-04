<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseItemsTable extends Migration
{
    /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
      Schema::create('purchase_items', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('purchase_id')->unsigned();
          $table->integer('product_id')->unsigned();

          $table->double('price', 10, 2);
          $table->integer('quantity');

          $table->foreign('purchase_id')
            ->references('id')->on('purchases')
            ->onDelete('cascade');
          $table->foreign('product_id')
            ->references('id')->on('products')
            ->onDelete('cascade');
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
      Schema::dropIfExists('purchase_items');
  }
}
