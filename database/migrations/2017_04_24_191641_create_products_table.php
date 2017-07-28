<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
      Schema::create('products', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('supplier_id')->unsigned();

          $table->string('sku');
          $table->text('description');
          $table->double('cost_price', 10, 2);
          $table->double('retail_price', 10, 2);
          $table->double('recommended_selling_price', 10, 2);

          $table->foreign('supplier_id')->references('id')->on('suppliers');
          $table->softDeletes();
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
      Schema::dropIfExists('products');
  }
}
