<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::connection('mongodb')->create('tips', function($collection)
        {
            $collection->index('name');
            $collection->index('description');
            $collection->index('author');
            $collection->index('approved');
            $collection->index('link');
            $collection->index('tipcategory_id');
            $collection->timestamps();
            $collection->softDeletes();
        });


    
        
        // Schema::create('tips', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('name',100)->index('tips_name');
        //     $table->integer('user_id')->unsigned()->nullable();
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        //     $table->text('description');
        //     $table->integer('tipcategory_id')->unsigned()->nullable();
        //     $table->foreign('tipcategory_id')->references('id')->on('tipcategories')->onDelete('cascade');
        //     $table->boolean('menu')->default(1);
        //     $table->boolean('special')->default(1);
        //     $table->boolean('approved')->default(1);

        //     $table->boolean('new')->default(0)->index('tips_new');
        //     $table->timestamps();
        //     $table->softDeletes();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mongodb')->drop('tips');
        // Schema::drop('tips');    
    }

}
