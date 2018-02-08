<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipCategoriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipcategories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->index('tipcategories_name');
            $table->text('description')->nullable();
            $table->string('uri', 50)->unique();
            $table->integer('parent_id')->unsigned()->default(0)->index('tipcategories_parent_id');
            $table->boolean('menu')->default(0);
            $table->boolean('special')->default(0);

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
        Schema::drop('tipcategories');
    }

}
