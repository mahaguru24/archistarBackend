<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateAnalyticTypesTable.
 */
class CreateAnalyticTypesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('analytic_types', function(Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('units');
            $table->boolean('is_numeric')->default(false);
            $table->integer('num_decimal_places');
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
		Schema::drop('analytic_types');
	}
}
